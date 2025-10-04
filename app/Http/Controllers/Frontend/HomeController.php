<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Version;
use App\Models\ReadingDate;
use Illuminate\Http\Request;
use App\Helpers\PayWayApiCheckout;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['versions'] = Version::all();
        $data['readings'] = ReadingDate::all();
        return view('frontend.home', $data);
    }

    public function show($locale, $versionSlug)
    {
        $version = Version::where('slug', $versionSlug)->firstOrFail();
        $versions = Version::all();
        // Get all books for this version
        $books = Book::where('versionId', $version->slug) // use ID, not slug
            ->with('chapters') // eager load chapters
            ->get();

        return view('frontend.reading', [
            'version' => $version,
            'books' => $books,
            'locale' => $locale,
            'versions' => $versions
        ]);
    }
}
