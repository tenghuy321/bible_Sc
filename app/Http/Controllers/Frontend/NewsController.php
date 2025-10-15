<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $data['news'] = News::get();
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();

        return view('frontend.news', $data);
    }
}
