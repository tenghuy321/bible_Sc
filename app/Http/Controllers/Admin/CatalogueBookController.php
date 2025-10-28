<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalogues;
use Illuminate\Http\Request;
use App\Models\CatalogueBook;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CatalogueBookController extends Controller
{
    public function index(Request $request)
    {
        $query = CatalogueBook::join('catalogue', 'cataloguebook.catalogueId', '=', 'catalogue.id')
            ->select('cataloguebook.*', 'catalogue.name_en as cname');

        if ($request->filled('catalogue_id')) {
            $query->where('cataloguebook.catalogueId', $request->catalogue_id);
        }

        $cata_books = $query->paginate(10);
        $catalogues = Catalogues::select('id', 'name_en')->get();

        return view('admin.cataloguesBook.index', compact('cata_books', 'catalogues'));
    }



    public function create()
    {
        $data['cata'] = Catalogues::get();
        return view('admin.cataloguesBook.create', $data);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_km' => 'required|string',
            'type_en' => 'nullable|string',
            'type_km' => 'nullable|string',
            'size_en' => 'nullable|string',
            'size_km' => 'nullable|string',
            'code' => 'nullable|string',
            'isbn' => 'nullable|string',
            'catalogueId' => 'nullable',
            'version' => 'nullable|string',
            'default_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('default_image')) {
            $validated['default_image'] = $request->file('default_image')->store('catabooks', 'custom');
        }

        $folderName = strtolower(str_replace(' ', '_', $validated['name_en']));

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store("catabooks/{$folderName}", 'custom');
                $imagePaths[] = $path;
            }
        }

        $validated['images'] = json_encode($imagePaths);

        $created = CatalogueBook::create($validated);

        if ($created) {
            return redirect()
                ->route('catabook-backend.index')
                ->with('success', 'Created successfully!');
        }

        return redirect()
            ->route('catabook-backend.create')
            ->with('error', 'Failed to create.')
            ->withInput();
    }


    public function edit(CatalogueBook $catabook)
    {
        $cata = Catalogues::get();

        return view('admin.cataloguesBook.edit', compact('cata', 'catabook'));
    }

    public function update(Request $request, CatalogueBook $catabook)
    {
        $validated = $request->validate([
            'name_en' => 'required|string',
            'name_km' => 'required|string',
            'type_en' => 'nullable|string',
            'type_km' => 'nullable|string',
            'size_en' => 'nullable|string',
            'size_km' => 'nullable|string',
            'code' => 'nullable|string',
            'isbn' => 'nullable|string',
            'catalogueId' => 'nullable',
            'version' => 'nullable|string',
            'default_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'existing_images' => 'nullable|array',
        ]);

        // Handle default image
        if ($request->hasFile('default_image')) {
            $validated['default_image'] = $request->file('default_image')->store('catabooks', 'custom');

            if ($catabook->default_image && Storage::disk('custom')->exists($catabook->default_image)) {
                Storage::disk('custom')->delete($catabook->default_image);
            }
        } else {
            $validated['default_image'] = $catabook->default_image;
        }

        // Existing images to keep
        $existingImages = $request->existing_images ?? [];

        // Remove deleted images from storage
        $oldImages = $catabook->images ? json_decode($catabook->images, true) : [];
        $imagesToDelete = array_diff($oldImages, $existingImages);

        foreach ($imagesToDelete as $img) {
            if (Storage::disk('custom')->exists($img)) {
                Storage::disk('custom')->delete($img);
            }

            // Delete the folder if empty
            $folder = dirname($img);
            if (Storage::disk('custom')->exists($folder) && count(Storage::disk('custom')->files($folder)) === 0) {
                Storage::disk('custom')->deleteDirectory($folder);
            }
        }

        // Handle new uploaded images
        $folderName = strtolower(str_replace(' ', '_', $validated['name_en']));
        $newImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store("catabooks/{$folderName}", 'custom');
                $newImages[] = $path;
            }
        }

        $validated['images'] = json_encode(array_merge($existingImages, $newImages));

        $catabook->update($validated);

        return redirect()->route('catabook-backend.index', ['page' => $request->query('page', 1)])
            ->with('success', 'Updated Successfully!');
    }

    public function delete(CatalogueBook $catabook)
    {
        // Delete default image
        if ($catabook->default_image && Storage::disk('custom')->exists($catabook->default_image)) {
            Storage::disk('custom')->delete($catabook->default_image);
        }

        // Delete all other images
        if ($catabook->images) {
            $images = json_decode($catabook->images, true);
            foreach ($images as $img) {
                if (Storage::disk('custom')->exists($img)) {
                    Storage::disk('custom')->delete($img);
                }
            }
        }

        // Delete the catalogue book record
        $deleted = $catabook->delete();

        if ($deleted) {
            return redirect()->route('catabook-backend.index')->with('success', 'Deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete.');
        }
    }
}
