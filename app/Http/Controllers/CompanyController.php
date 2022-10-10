<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Asset;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        $this->authorize('viewAny', Company::class);

        $currentPage = $_GET['page'] ?? '1';
        $maxPage = ceil(Company::all()->count() / self::COMPANIES_PER_PAGE);

        // redirect user to first page if requested page is not valid
        if ($currentPage < 1 || $currentPage > $maxPage) {
            return redirect(action([self::class, 'index']));
        }

        $companies = Company::with('icon.blob')
            ->orderBy('name', 'asc')
            ->offset(($currentPage - 1) * self::COMPANIES_PER_PAGE)
            ->limit(self::COMPANIES_PER_PAGE)
            ->get();

        return response()->view('companies.list', [
            'companies' => $companies,
            'currentPage' => $currentPage,
            'maxPage' => $maxPage,
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
                return redirect()->route('companies.edit', ['company' => $company->id]);
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
            $owner = Auth::user();

            $company = Company::create([
                'name' => $validated['name'],
                'location' => $validated['location'],
                'description' => $validated['description'],
            ]);
            $company->owner()->save($owner);

            $owner->company()->associate($company);
            $owner->save();

            if ($request->hasFile('icon')) {
                $icon = Asset::factory()->storeFile($request->file('icon'), "company_$company->id")->create();
                $company->icon()->save($icon);
                Log::info("Created icon (#$icon->id) of company #$company->id");
            }

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
     */
    public function update(UpdateCompanyRequest $request, Company $company): Response
    {
        $this->authorize('update', $company);
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $company->delete();

        return redirect()->route('companies.index');
    }
}
