<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CatalogueBook;
use App\Models\Catalogues;
use Illuminate\Http\Request;

class CataloguesController extends Controller
{
    public function index()
    {
        $catalogues = Catalogues::with('catabooks')->get();

        return view('frontend.catalogues', compact('catalogues'));
    }


    // public function show($cataslug)
    // {
    //     $catalogue = Catalogues::where('slug', $cataslug)
    //         ->with('catabooks')
    //         ->firstOrFail();

    //     return view('frontend.catalogueShow', [
    //         'catalogue' => $catalogue,
    //         'catabooks' => $catalogue->catabooks,
    //     ]);
    // }
}
