<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    const COMPANIES_PER_PAGE = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        return response()->view('company-list', [
            'companies' => $companies,
            'currentPage' => $currentPage,
            'maxPage' => $maxPage,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request): Response
    {
        abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company): Response
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company): Response
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): Response
    {
        abort(404);
    }
}
