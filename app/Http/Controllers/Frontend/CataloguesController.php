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
        $data['catalogue'] = Catalogues::get();

        return view('frontend.catalogues', $data);
    }

    public function show($cataslug)
    {
        $catalogue = Catalogues::where('slug', $cataslug)
            ->with('catabooks')
            ->firstOrFail();

        return view('frontend.catalogueShow', [
            'catalogue' => $catalogue,
            'catabooks' => $catalogue->catabooks,
        ]);
    }
}
