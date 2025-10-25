<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::get();
        return view('admin.board.index', compact('boards'));
    }

    public function create()
    {
        return view('admin.board.create');
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
            $path = $imageFile->store("boards/{$folderName}", 'custom');
            $imagePaths[] = $path;
        }

        Board::create([
            'title_en' => $validated['title_en'],
            'title_kh' => $validated['title_kh'],
            'content_en' => $validated['content_en'],
            'content_kh' => $validated['content_kh'],
            'image' => json_encode($imagePaths),
        ]);

        return redirect()->route('board.index')
            ->with('success', 'Created Successfully!');
    }

    public function edit(string $id)
    {
        $board = Board::findOrFail($id);
        return view('admin.board.edit', compact('board'));
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

        $board = Board::findOrFail($id);
        $folderName = strtolower(str_replace(' ', '_', $validated["title_en"]));

        $imagePaths = json_decode($board->image, true) ?? [];

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
                $path = $imageFile->store("boards/{$folderName}", 'custom');
                $imagePaths[] = $path;
            }
        }

        $board->update([
            'title_en' => $validated['title_en'],
            'title_kh' => $validated['title_kh'],
            'content_en' => $validated['content_en'],
            'content_kh' => $validated['content_kh'],
            'image' => json_encode(array_values($imagePaths))
        ]);

        return redirect()->route('board.index')
            ->with('success', 'Updated successfully!');
    }

    public function delete(string $id)
    {
        $board = Board::findOrFail($id);
        $imagePaths = json_decode($board->image, true) ?? [];

        foreach ($imagePaths as $image) {
            if (Storage::disk('custom')->exists($image)) {
                Storage::disk('custom')->delete($image);
            }
        }
        $board->delete();

        return redirect()->route('board.index')
            ->with('success', 'Deleted successfully!');
    }
}
