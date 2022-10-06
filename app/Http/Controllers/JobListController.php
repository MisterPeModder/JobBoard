<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Response;

class JobListController extends Controller
{
    const ADVERTS_PER_PAGE = 5;

    public function index(): Response
    {
        $currentPage = $_GET['page'] ?? '1';
        $maxPage = Advert::all()->count() / self::ADVERTS_PER_PAGE;

        // redirect user to first page if requested page is not valid
        if ($currentPage < 1 || $currentPage > $maxPage) {
            return redirect(action([self::class, 'show']));
        }

        $adverts = Advert::with('company.icon.blob')
            ->where('id', '>=', $currentPage * self::ADVERTS_PER_PAGE)
            ->limit(self::ADVERTS_PER_PAGE)
            ->get();

        return response()->view('job-list', [
            'adverts' => $adverts,
            'currentPage' => $currentPage,
            'maxPage' => $maxPage,
        ]);
    }
}
