<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use App\Models\Advert;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdvertController extends Controller
{
    const ADVERTS_PER_PAGE = 5;

    public function __construct()
    {
        // require authentification except for index and show, because adverts are public
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];

        // Search query Filter
        $searchQuery = $request->string('query');
        if ($searchQuery->isNotEmpty()) {
            $adverts = Advert::querySearch($searchQuery);
            $filters['query'] = $searchQuery;
        } else {
            $adverts = Advert::query();
        }

        // Location Filter
        $location = $request->string('location');
        if ($location->isNotEmpty()) {
            $escaped = $location->replace('%', '\\%')->replace('_', '\\_');
            $adverts = $adverts->where('location', 'like', "%$escaped%");
            $filters['location'] = $location->toString();
        }

        // Company Filter
        $companyId = $request->query('company');
        if ($companyId !== null) {
            $company = Company::find($companyId);
            if ($company !== null) {
                $filters['company'] = $company;
                $adverts = $adverts->where('company_id', $companyId);
            }
        }

        /** @var \Illuminate\Pagination\LengthAwarePaginator */
        $adverts = $adverts->paginate(self::ADVERTS_PER_PAGE);
        $adverts = $adverts->withQueryString();

        // If page number is out-of-bounds, redirect user to page 1
        $currentPage = $request->query('page', '1');
        if ($currentPage < 1 || $currentPage > $adverts->lastPage()) {
            return redirect($request->fullUrlWithoutQuery('page'));
        }

        return response()->view('jobs.list', [
            'request' => $request,
            'adverts' => $adverts,
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Company $company)
    {
        return response()->view('jobs.create', ['company' => $company]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvertRequest $request, Company $company)
    {
        $advert = DB::transaction(function () use ($request, $company) {
            $fields = $this->getUpdateFields($request->validated());
            $fields['company_id'] = $company->id;
            $advert = Advert::create($fields);
            $advert->save();
            Log::info("Advert #$advert->id was created");

            return $advert;
        });

        return $this->redirectToAdvert($advert, $request);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $advert)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $advert)
    {
        $this->authorize('update', $advert);

        return response()->view('jobs.edit', ['advert' => $advert]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertRequest $request, Advert $advert)
    {
        $this->authorize('update', $advert);

        DB::transaction(function () use ($request, $advert) {
            $advert->fill($this->getUpdateFields($request->validated()));
            $advert->save();
            Log::info("Advert #$advert->id was modified");
        });

        return $this->redirectToAdvert($advert->refresh(), $request);
    }

    private function getUpdateFields(mixed $validated): array
    {
        return [
            'title' => $validated['title'],
            'location' => $validated['location'],
            'short_description' => $validated['short-description'],
            'salary_min' => $validated['salary-min'] <= 0 ? null : $validated['salary-min'],
            'salary_max' => $validated['salary-max'] <= 0 ? null : $validated['salary-max'],
            'salary_currency' => $validated['salary-currency'],
            'salary_type' => $validated['salary-type'],
            'job_type' => $validated['job-type'],
            'full_description' => $validated['full-description'],
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $advert)
    {
        $this->authorize('delete', $advert);

        $id = $advert->id;
        $company = $advert->company;
        $advert->delete();
        Log::info("Deleted advert #$id");

        return redirect()->route('company.show', $company);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    private function redirectToAdvert(Advert $advert, Request $request)
    {
        $request->user()->refresh();
        $advert->refresh();

        if ($request->user()->can('update', $advert)) {
            return redirect()->route('jobs.edit', $advert);
        }

        return redirect()->route('jobs.index');
    }
}
