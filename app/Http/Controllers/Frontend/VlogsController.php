<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Vlog;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VlogsController extends Controller
{
    public function index()
    {
        $vlogs = Vlog::get();
        $versions_item = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();

        return view('frontend.vlogs', [
            'vlogs' => $vlogs,
            'versions_item' => $versions_item,
            'locale' => app()->getLocale(),
        ]);
    }
}
