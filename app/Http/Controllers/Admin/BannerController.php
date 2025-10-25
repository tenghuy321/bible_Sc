<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string',
            'title_kh' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $folderName = strtolower(str_replace(' ', '_', $validated['title_en']));
        $imagePaths = [];

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store("banners/{$folderName}", 'custom');
            $imagePaths[] = $path;
        }

        Banner::create([
            'title_en' => $validated['title_en'],
            'title_kh' => $validated['title_kh'],
            'image' => json_encode($imagePaths),
        ]);

        return redirect()->route('banner.index')
            ->with('success', 'Created Successfully!');
    }

    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'title_en' => 'nullable|string',
            'title_kh' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $banner = Banner::findOrFail($id);
        $folderName = strtolower(str_replace(' ', '_', $validated["title_en"]));

        $imagePaths = json_decode($banner->image, true) ?? [];

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
                $path = $imageFile->store("banners/{$folderName}", 'custom');
                $imagePaths[] = $path;
            }
        }

        $banner->update([
            'title_en' => $validated['title_en'],
            'title_kh' => $validated['title_kh'],
            'image' => json_encode(array_values($imagePaths))
        ]);

        return redirect()->route('banner.index')
            ->with('success', 'Updated successfully!');
    }

    public function delete(string $id)
    {
        $banner = Banner::findOrFail($id);
        $imagePaths = json_decode($banner->image, true) ?? [];

        foreach ($imagePaths as $image) {
            if (Storage::disk('custom')->exists($image)) {
                Storage::disk('custom')->delete($image);
            }
        }
        $banner->delete();

        return redirect()->route('banner.index')
            ->with('success', 'Deleted successfully!');
    }
}
