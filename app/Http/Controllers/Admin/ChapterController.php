<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChapterController extends Controller
{
    public function index(Request $request)
    {
        $query = Chapter::join('book', 'chapter.bookId', '=', 'book.id')
            ->join('version', 'book.versionId', '=', 'version.slug')
            ->select('chapter.*', 'book.nameEn as ename', 'version.titleEn as versionTitle');

        if ($request->filled('versionId')) {
            $query->where('book.versionId', $request->versionId);
        }

        if ($request->filled('bookId')) {
            $query->where('chapter.bookId', $request->bookId);
        }

        // Numeric sort by nameEn
        $chapters = $query
            ->orderByRaw('CAST(chapter.nameEn AS UNSIGNED) ASC')
            ->paginate(10)
            ->withQueryString();

        $versions = Version::all();
        $books = $request->filled('versionId')
            ? Book::where('versionId', $request->versionId)->get()
            : Book::all();

        return view('admin.chapter.index', compact('chapters', 'versions', 'books'));
    }


    public function create(Request $request)
    {
        $versions = Version::all();
        $books = $request->filled('versionId')
            ? Book::where('versionId', $request->versionId)->get()
            : Book::all();

        $selectedVersion = $request->versionId ?? '';
        $selectedBook    = $request->bookId ?? '';

        return view('admin.chapter.create', compact('versions', 'books', 'selectedVersion', 'selectedBook'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameEn'       => 'required',
            'nameKm'       => 'required',
            'titleEn'      => 'nullable',
            'titleKm'      => 'nullable',
            'contentEn'  => 'nullable|string',
            'contentKm'  => 'nullable|string',
            'paragraphEn'  => 'nullable',
            'paragraphKm'  => 'nullable',
            'bookId'       => 'required|exists:book,id',
        ]);

        Chapter::create($request->only([
            'nameEn',
            'nameKm',
            'titleEn',
            'titleKm',
            'contentEn',
            'contentKm',
            'paragraphEn',
            'paragraphKm',
            'bookId'
        ]));

        return redirect()
            ->route('chapter.index', [
                'versionId' => $request->versionId,
                'bookId'    => $request->bookId,
                'page'      => $request->page, // preserve current page
            ])
            ->with('success', 'Created successfully!');
    }

    public function edit(Request $request, Chapter $chapter)
    {
        $versions = Version::all();
        $books = Book::where('versionId', $chapter->book->versionId)->get();

        $selectedVersion = $chapter->book->versionId;
        $selectedBook    = $request->bookId ?? $chapter->bookId;

        return view('admin.chapter.edit', compact('chapter', 'versions', 'books', 'selectedVersion', 'selectedBook'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $request->validate([
            'nameEn'       => 'required',
            'nameKm'       => 'required',
            'titleEn'      => 'nullable|string',
            'titleKm'      => 'nullable|string',
            'contentEn'  => 'nullable|string',
            'contentKm'  => 'nullable|string',
            'paragraphEn'  => 'nullable|string',
            'paragraphKm'  => 'nullable|string',
            'bookId'       => 'required|exists:book,id',
        ]);

        $chapter->update($request->only([
            'nameEn',
            'nameKm',
            'titleEn',
            'titleKm',
            'contentEn',
            'contentKm',
            'paragraphEn',
            'paragraphKm',
            'bookId',
        ]));

        return redirect()
            ->route('chapter.index', [
                'versionId' => $request->versionId,
                'bookId'    => $request->bookId,
                'page'      => $request->page, // preserve current page
            ])
            ->with('success', 'Updated successfully!');
    }


    public function delete(Request $request, Chapter $chapter)
    {
        $chapter->delete();

        return redirect()
            ->route('chapter.index', [
                'versionId' => $request->versionId,
                'bookId'    => $request->bookId,
                'page'      => $request->page,
            ])
            ->with('success', 'Deleted successfully!');
    }
}
