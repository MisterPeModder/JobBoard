<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdvertRequest;
use App\Http\Requests\UpdateAdvertRequest;
use App\Models\Advert;
use App\Models\Company;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    const ADVERTS_PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = [];

        if (isset($_GET['company'])) {
            $companyId = $_GET['company'];
            $company = Company::find($companyId);
            $adverts = Advert::where('company_id', $companyId)->paginate(self::ADVERTS_PER_PAGE)->withQueryString();
            if ($company !== null) {
                $filters['company'] = $company->name;
            }
        } else {
            $adverts = Advert::paginate(self::ADVERTS_PER_PAGE)->withQueryString();
        }

        $currentPage = $_GET['page'] ?? '1';

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
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Advert $advert, StoreAdvertRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Advert $application)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Advert $application)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdvertRequest $request, Advert $application)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advert $application)
    {
        abort(404);
    }
}
