<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::join('version', 'book.versionId', '=', 'version.slug')
            ->select('book.*', 'version.titleEn');

        // filter by version slug if provided
        if ($request->filled('versionId')) {
            $query->where('book.versionId', $request->versionId);
        }

        $books = $query->paginate(10)->withQueryString(); // ✅ keep query string

        $versions = Version::all();

        return view('admin.book.index', compact('books', 'versions'));
    }


    public function create()
    {
        $versions = Version::all(); // dropdown of versions
        return view('admin.book.create', compact('versions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameEn'    => 'required|string|max:255',
            'nameKm'    => 'required|string|max:255',
            'versionId' => 'required|exists:version,slug', // ✅ must be a valid version slug
        ]);

        Book::create([
            'nameEn'    => $request->nameEn,
            'nameKm'    => $request->nameKm,
            'versionId' => $request->versionId, // ✅ store version.slug
            'slug'      => Str::slug($request->nameEn . '-' . $request->versionId), // ✅ auto slug from English name
        ]);

        return redirect()->route('book.index')->with('success', 'Book created successfully!');
    }

    public function edit(Book $book)
    {
        $versions = Version::all();
        return view('admin.book.edit', compact('book', 'versions'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'nameEn'    => 'required|string|max:255',
            'nameKm'    => 'required|string|max:255',
            'versionId' => 'required|exists:version,slug',
        ]);

        $book->update([
            'nameEn'    => $request->nameEn,
            'nameKm'    => $request->nameKm,
            'versionId' => $request->versionId,
            'slug'      => Str::slug($request->nameEn . '-' . $request->versionId), // ✅ regenerate slug if nameEn changes
        ]);

        return redirect()->route('book.index')->with('success', 'Book updated successfully!');
    }

    public function delete(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success', 'Book deleted successfully!');
    }
}
