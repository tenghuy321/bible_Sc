<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Mission;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MissionController extends Controller
{
    public function index()
    {
        $data['missions'] = Mission::get();
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();

        return view('frontend.mission', $data);
    }
}
