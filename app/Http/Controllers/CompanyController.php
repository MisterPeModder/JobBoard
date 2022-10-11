<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Asset;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class CompanyController extends Controller
{
    const COMPANIES_PER_PAGE = 10;

    public function __construct()
    {
        // require authentification except for index and show, because company info is public
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Company::class);

        $companies = Company::paginate(self::COMPANIES_PER_PAGE);
        $currentPage = $_GET['page'] ?? '1';

        if ($currentPage < 1 || $currentPage > $companies->lastPage()) {
            return redirect($request->fullUrlWithoutQuery('page'));
        }

        return response()->view('companies.list', [
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $response = Gate::inspect('create', Company::class);

        if ($response->denied()) {
            // if user already belongs to a company, redirect them to the edit menu
            $company = $request->user()->company;
            if ($company !== null) {
                return redirect()->route('companies.edit', $company->id);
            }

            return $response;
        }

        return response()->view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $this->authorize('create', Company::class);

        $companyId = DB::transaction(function () use ($request) {
            $validated = $request->validated();
            /** @var User */
            $owner = $request->user();

            $company = Company::create([
                'name' => $validated['name'],
                'location' => $validated['location'],
                'description' => $validated['description'],
                'owner_id' => $owner->id,
            ]);
            $company->owner()->save($owner);

            $owner->company()->associate($company);
            $owner->save();

            if ($request->hasFile('icon')) {
                $icon = Asset::factory()->storeFile($request->file('icon'), "company_$company->id")->create();
                $company->icon_id = $icon->id;
                $company->icon()->save($icon);
                $icon->company()->associate($company);
                $icon->save();
                Log::info("Created icon (#$icon->id) of company #$company->id");
            }

            $company->save();

            Log::info("Company (#$company->id) created by user #$owner->id");

            return $company->id;
        });

        return redirect()->route('companies.show', ['company' => $companyId]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): Response
    {
        $this->authorize('view', $company);

        return response()->view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): Response
    {
        $this->authorize('update', $company);

        return response()->view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $this->authorize('update', $company);

        DB::transaction(function () use ($request, $company) {
            $validated = $request->validated();
            /** @var User */
            $owner = $request->user();

            $company->fill([
                'name' => $validated['name'],
                'location' => $validated['location'],
                'description' => $validated['description'],
            ]);
            $company->save();

            if ($request->hasFile('icon')) {
                $oldIcon = $company->icon;
                if ($oldIcon !== null) {
                    $company->icon()->delete();
                }

                $icon = Asset::factory()->storeFile($request->file('icon'), "company_$company->id")->create();
                $company->icon_id = $icon->id;
                $company->icon()->save($icon);
                $icon->company()->associate($company);
                $icon->save();
                Log::info("Created icon (#$icon->id) of company #$company->id");
            }

            $company->save();
            $company->refresh();

            Log::info("Company (#$company->id) updated by user #$owner->id");

            return $company->id;
        });

        return $this->redirectToCompany($company, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $id = $company->id;
        $company->delete();
        Log::info("Deleted company #$id");

        return redirect()->route('companies.index');
    }

    /**
     * Adds a new member to the company.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMember(Company $company, Request $request)
    {
        $validated = $request->validate([
            'new-member' => ['required', 'email', 'exists:users,email'],
        ]);

        $candidate = User::where('email', $validated['new-member'])->first();

        $request->validate([
            'new-member' => [
                function ($attribute, $value, $fail) use ($candidate, $company) {
                    if ($candidate->company_id === $company->id) {
                        $fail(__('form.field.new_member.in_company'));
                    } elseif ($candidate->company_id !== null) {
                        $fail(__('form.field.new_member.exists'));
                    }
                },
            ],
        ]);

        DB::transaction(function () use ($company, $candidate) {
            $candidate->company()->associate($company);
            $candidate->save();
        });
        Log::info("Added member #$candidate->id to company #$company->id");

        return $this->redirectToCompany($company, $request);
    }

    /**
     * Removes an existing member from the company.
     *
     * @return \Illuminate\Http\Response
     */
    public function removeMember(Company $company, User $member, Request $request)
    {
        DB::transaction(function () use ($company, $member) {
            $member->company()->dissociate($company);
            $member->save();
        });
        Log::info("Removed member #$member->id from company #$company->id");

        return $this->redirectToCompany($company, $request);
    }

    /**
     * Transfers ownership of the company
     *
     * @return \Illuminate\Http\Response
     */
    public function setOwner(Company $company, User $owner, Request $request)
    {
        DB::transaction(function () use ($company, $owner) {
            if ($company->owner !== null) {
                $company->update(['owner_id' => null]);
            }

            $company->owner()->save($owner);
            $company->update(['owner_id' => $owner->id]);
            $company->save();
        });
        Log::info("Changed owner of company #$company->id to #$owner->id");

        return $this->redirectToCompany($company, $request);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    private function redirectToCompany(Company $company, Request $request)
    {
        $request->user()->refresh();
        $company->refresh();

        if ($request->user()->can('update', $company)) {
            return redirect()->route('companies.edit', $company);
        }

        return redirect()->route('companies.show', $company);
    }
}
