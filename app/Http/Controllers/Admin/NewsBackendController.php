<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsBackendController extends Controller
{
    public function index()
    {
        $news = News::get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_kh' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'content_kh' => 'nullable|string',
            'middle_content_en' => 'nullable|string',
            'middle_content_kh' => 'nullable|string',
            'end_content_en' => 'nullable|string',
            'end_content_kh' => 'nullable|string',

            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',

            'middle_image' => 'nullable|array',
            'middle_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',

            'end_image' => 'nullable|array',
            'end_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        // Create a clean folder name
        $folderName = $validated['title_en']
            ? Str::slug($validated['title_en'])
            : 'news_' . now()->timestamp;

        // Helper to handle image upload for each section
        $uploadImages = function ($files, $section) use ($folderName) {
            $paths = [];
            if ($files) {
                foreach ($files as $file) {
                    $paths[] = $file->store("news/{$folderName}/{$section}", 'custom');
                }
            }
            return $paths;
        };

        // Upload images for each section
        $mainImages = $uploadImages($request->file('image'), 'main');
        $middleImages = $uploadImages($request->file('middle_image'), 'middle');
        $endImages = $uploadImages($request->file('end_image'), 'end');

        // Store to database
        News::create([
            'title_en' => $validated['title_en'] ?? null,
            'title_kh' => $validated['title_kh'] ?? null,
            'content_en' => $validated['content_en'] ?? null,
            'content_kh' => $validated['content_kh'] ?? null,
            'middle_content_en' => $validated['middle_content_en'] ?? null,
            'middle_content_kh' => $validated['middle_content_kh'] ?? null,
            'end_content_en' => $validated['end_content_en'] ?? null,
            'end_content_kh' => $validated['end_content_kh'] ?? null,
            'image' => $mainImages,
            'middle_image' => $middleImages,
            'end_image' => $endImages,
        ]);

        return redirect()->route('news_backend.index')
            ->with('success', 'News created successfully!');
    }

    public function edit(string $id)
    {
        $new = News::findOrFail($id);
        return view('admin.news.edit', compact('new'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title_en' => 'nullable|string|max:255',
            'title_kh' => 'nullable|string|max:255',
            'content_en' => 'nullable|string',
            'content_kh' => 'nullable|string',
            'middle_content_en' => 'nullable|string',
            'middle_content_kh' => 'nullable|string',
            'end_content_en' => 'nullable|string',
            'end_content_kh' => 'nullable|string',
            'image' => 'nullable|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'middle_image' => 'nullable|array',
            'middle_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'end_image' => 'nullable|array',
            'end_image.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        $news = News::findOrFail($id);
        $folderName = $validated['title_en'] ? Str::slug($validated['title_en']) : 'news_' . now()->timestamp;

        // Helper to process image sections
        $handleImages = function ($section, $existingImages) use ($request, $folderName) {
            $images = is_array($existingImages) ? $existingImages : [];

            // Match input: removed_image, removed_middle_image, removed_end_image
            $removedKey = 'removed_' . $section;
            if ($request->filled($removedKey)) {
                $removedImages = json_decode($request->$removedKey, true);
                foreach ($removedImages as $img) {
                    if (Storage::disk('custom')->exists($img)) {
                        Storage::disk('custom')->delete($img);
                    }
                    $images = array_filter($images, fn($i) => $i !== $img);
                }
            }

            // Handle uploaded files
            if ($request->hasFile($section)) {
                foreach ($request->file($section) as $file) {
                    $images[] = $file->store("news/{$folderName}/{$section}", 'custom');
                }
            }

            return array_values($images); // reindex
        };

        $news->update([
            'title_en' => $validated['title_en'] ?? $news->title_en,
            'title_kh' => $validated['title_kh'] ?? $news->title_kh,
            'content_en' => $validated['content_en'] ?? $news->content_en,
            'content_kh' => $validated['content_kh'] ?? $news->content_kh,
            'middle_content_en' => $validated['middle_content_en'] ?? $news->middle_content_en,
            'middle_content_kh' => $validated['middle_content_kh'] ?? $news->middle_content_kh,
            'end_content_en' => $validated['end_content_en'] ?? $news->end_content_en,
            'end_content_kh' => $validated['end_content_kh'] ?? $news->end_content_kh,
            'image' => $handleImages('image', $news->image),
            'middle_image' => $handleImages('middle_image', $news->middle_image),
            'end_image' => $handleImages('end_image', $news->end_image),
        ]);

        return redirect()->route('news_backend.index')->with('success', 'News updated successfully!');
    }




    public function delete(string $id)
    {
        $news = News::findOrFail($id);

        // Decode all image fields
        $mainImages = $news->image ?? [];
        $middleImages = $news->middle_image ?? [];
        $endImages = $news->end_image ?? [];

        // Combine all image paths
        $allImages = array_merge($mainImages, $middleImages, $endImages);

        // Delete all image files from storage
        foreach ($allImages as $imagePath) {
            if (Storage::disk('custom')->exists($imagePath)) {
                Storage::disk('custom')->delete($imagePath);
            }
        }

        // Optionally, clean up empty folder (if you want)
        $baseFolder = 'news/' . strtolower(str_replace(' ', '_', $news->title_en ?? ''));
        if (Storage::disk('custom')->exists($baseFolder)) {
            $files = Storage::disk('custom')->allFiles($baseFolder);
            if (empty($files)) {
                Storage::disk('custom')->deleteDirectory($baseFolder);
            }
        }

        // Delete the database record
        $news->delete();

        return redirect()->route('news_backend.index')
            ->with('success', 'News deleted successfully!');
    }
}
