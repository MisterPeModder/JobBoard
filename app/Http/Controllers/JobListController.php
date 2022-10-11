<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;

class JobListController extends Controller
{
    const ADVERTS_PER_PAGE = 5;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $adverts = Advert::paginate(self::ADVERTS_PER_PAGE);
        $currentPage = $_GET['page'] ?? '1';

        if ($currentPage < 1 || $currentPage > $adverts->lastPage()) {
            return redirect($request->fullUrlWithoutQuery('page'));
        }

        return response()->view('jobs.list', [
            'adverts' => $adverts,
        ]);
    }
}
