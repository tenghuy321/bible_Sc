<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Version;
use App\Models\Catalogues;
use Illuminate\Http\Request;
use App\Models\CatalogueBook;
use App\Http\Controllers\Controller;

class CataloguesController extends Controller
{
    public function index()
    {
        $data['catalogues'] = Catalogues::with('catabooks')->get();
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();


        return view('frontend.catalogues', $data);
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
