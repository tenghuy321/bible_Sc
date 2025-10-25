<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;
use App\Models\Stuff;

class AboutController extends Controller
{
    public function index()
    {
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();
        $data["stuffs"] = Stuff::get();
        $data["boards"] = Board::get();

        return view('frontend.about', $data);
    }
}
