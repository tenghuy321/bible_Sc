<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Version;
use App\Models\ReadingDate;
use Illuminate\Http\Request;
use App\Helpers\PayWayApiCheckout;
use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\News;
use App\Models\Vlog;

class HomeController extends Controller
{
    public function index()
    {
        $data['versions'] = Version::all();
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();
        $data['readings'] = ReadingDate::all();
        // Get the latest news item
        $data['latestNews'] = News::latest()->first();
        $data['latestMission'] = Mission::latest()->first();
        $data['latestVlog'] = Vlog::latest('id')->first();

        return view('frontend.home', $data);
    }

    public function show($locale, $versionSlug)
    {
        $version = Version::where('slug', $versionSlug)->firstOrFail();
        $versions_item = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();

        $versions = Version::all();
        // Get all books for this version
        $books = Book::where('versionId', $version->slug) // use ID, not slug
            ->with('chapters') // eager load chapters
            ->get();

        return view('frontend.reading', [
            'version' => $version,
            'books' => $books,
            'locale' => $locale,
            'versions' => $versions,
            'versions_item' => $versions_item,
        ]);
    }
}
