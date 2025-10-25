<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Stuff;
use Illuminate\Support\Facades\Storage;

class StuffController extends Controller
{
    public function index()
    {
        $stuffs = Stuff::get();
        return view('admin.stuff.index', compact('stuffs'));
    }

    public function create()
    {
        return view('admin.stuff.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string',
            'title_kh' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_kh' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $folderName = strtolower(str_replace(' ', '_', $validated['title_en']));
        $imagePaths = [];

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store("stuffs/{$folderName}", 'custom');
            $imagePaths[] = $path;
        }

        Stuff::create([
            'title_en' => $validated['title_en'],
            'title_kh' => $validated['title_kh'],
            'content_en' => $validated['content_en'],
            'content_kh' => $validated['content_kh'],
            'image' => json_encode($imagePaths),
        ]);

        return redirect()->route('stuff.index')
            ->with('success', 'Created Successfully!');
    }

    public function edit(string $id)
    {
        $stuff = Stuff::findOrFail($id);
        return view('admin.stuff.edit', compact('stuff'));
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'title_en' => 'nullable|string',
            'title_kh' => 'nullable|string',
            'content_en' => 'nullable|string',
            'content_kh' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $stuff = Stuff::findOrFail($id);
        $folderName = strtolower(str_replace(' ', '_', $validated["title_en"]));

        $imagePaths = json_decode($stuff->image, true) ?? [];

        if ($request->filled('removed_images')) {
            $removedImages = json_decode($request->removed_images, true);

            foreach ($removedImages as $removedImage) {
                if (Storage::disk('custom')->exists($removedImage)) {
                    Storage::disk('custom')->delete($removedImage);
                }
                $imagePaths = array_filter($imagePaths, fn($img) => $img !== $removedImage);
            }
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store("stuffs/{$folderName}", 'custom');
                $imagePaths[] = $path;
            }
        }

        $stuff->update([
            'title_en' => $validated['title_en'],
            'title_kh' => $validated['title_kh'],
            'content_en' => $validated['content_en'],
            'content_kh' => $validated['content_kh'],
            'image' => json_encode(array_values($imagePaths))
        ]);

        return redirect()->route('stuff.index')
            ->with('success', 'Updated successfully!');
    }

    public function delete(string $id)
    {
        $stuff = Stuff::findOrFail($id);
        $imagePaths = json_decode($stuff->image, true) ?? [];

        foreach ($imagePaths as $image) {
            if (Storage::disk('custom')->exists($image)) {
                Storage::disk('custom')->delete($image);
            }
        }
        $stuff->delete();

        return redirect()->route('stuff.index')
            ->with('success', 'Deleted successfully!');
    }
}
