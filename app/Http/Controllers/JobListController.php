<?php

namespace App\Http\Controllers;

use App\Models\Advert;

class JobListController extends Controller
{
    const ADVERTS_PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = $_GET['page'] ?? '1';
        $maxPage = ceil(Advert::all()->count() / self::ADVERTS_PER_PAGE);

        // redirect user to first page if requested page is not valid
        if ($currentPage < 1 || $currentPage > $maxPage) {
            return redirect(action([self::class, 'index']));
        }

        $adverts = Advert::with('company.icon.blob')
            ->where('id', '>', ($currentPage - 1) * self::ADVERTS_PER_PAGE)
            ->limit(self::ADVERTS_PER_PAGE)
            ->get();

        return response()->view('job-list', [
            'adverts' => $adverts,
            'currentPage' => $currentPage,
            'maxPage' => $maxPage,
        ]);
    }
}
