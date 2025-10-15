<?php

namespace App\Http\Controllers\Frontend;

use App\Models\News;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsDetailController extends Controller
{
    public function show($id)
    {
        $data['news'] = News::findOrFail($id);
        $data['newsItem'] = News::where('id', '!=', $id)->latest()->get();
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();

        return view('frontend.show', $data);
    }
}
