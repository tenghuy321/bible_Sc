<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalogues;
use Illuminate\Http\Request;
use App\Models\CatalogueBook;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CatalogueBookController extends Controller
{
    public function index()
    {
        $cata_books = CatalogueBook::join('catalogue', 'cataloguebook.catalogueId', 'catalogue.id')
            ->select('cataloguebook.*', 'catalogue.name_en as cname')
            ->paginate(10);
        // $cata_books->getCollection()->transform(function ($item, $index) use ($cata_books) {
        //     // Calculate the auto number based on the current page
        //     $item->auto_number = $index + 1 + ($cata_books->currentPage() - 1) * $cata_books->perPage();
        //     return $item;
        // });
        return view('admin.cataloguesBook.index', compact('cata_books'));
    }

    public function create()
    {
        $data['cata'] = Catalogues::get();
        return view('admin.cataloguesBook.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required',
            'name_km' => 'required',
            'type_en' => 'nullable',
            'type_km' => 'required',
            'size_en' => 'required',
            'size_km' => 'required',
            'code' => 'required',
            'isbn' => 'required',
            'catalogueId' => 'required',
            'version' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->except('_token', 'image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('catabooks', 'custom');
        }

        $i = CatalogueBook::create($data);

        if ($i) {
            return redirect()->route('catabook-backend.index')->with('success', 'Created successfully!');
        } else {
            return redirect()->route('catabook-backend.create')
                ->with('error', 'Failed to created.')
                ->withInput();
        }
    }

    public function edit(CatalogueBook $catabook)
    {
        $cata = Catalogues::get();

        return view('admin.cataloguesBook.edit', compact('cata', 'catabook'));
    }

    public function update(Request $request, CatalogueBook $catabook)
    {
        $request->validate([
            'name_en' => 'nullable',
            'name_km' => 'nullable',
            'type_en' => 'nullable',
            'type_km' => 'nullable',
            'size_en' => 'nullable',
            'size_km' => 'nullable',
            'code' => 'nullable',
            'isbn' => 'nullable',
            'catalogueId' => 'nullable',
            'version' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->except('_token', 'image', '_method');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('catabooks', 'custom');

            if ($catabook->image && Storage::disk('custom')->exists($catabook->image)) {
                Storage::disk('custom')->delete($catabook->image);
            }
        }

        $i = $catabook->update($data);

        if ($i) {
            return redirect()->route('catabook-backend.index')->with('success', 'Updated Successfully!');
        } else {
            return redirect()->route('catabook-backend.edit')
                ->with('error', 'Failed to updated Product.')
                ->withInput();
        }
    }

    public function delete(CatalogueBook $catabook)
    {
        if ($catabook->image && Storage::disk('custom')->exists($catabook->image)) {
            Storage::disk('custom')->delete($catabook->image);
        }

        $i = $catabook->delete();

        if ($i) {
            return redirect()->route('catabook-backend.index')->with('success', 'Deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete.');
        }
    }
}
