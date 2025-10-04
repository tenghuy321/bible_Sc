<?php

namespace App\Http\Controllers\Admin;

use App\Models\Catalogues;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CataloguesBackendController extends Controller
{
    public function index()
    {
        $catalogues = Catalogues::all();
        return view('admin.catalogues.index', compact('catalogues'));
    }

    public function create()
    {
        return view('admin.catalogues.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'nullable|string|max:255',
            'image'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name_en', 'name_km']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('catalogues', 'custom');
        }

        $data['slug'] = Str::slug($data['name_en']);

        Catalogues::create($data);

        return redirect()->route('catalogues-backend.index')
            ->with('success', 'Created successfully.');
    }

    public function edit(Catalogues $catalogues)
    {
        return view('admin.catalogues.edit', compact('catalogues'));
    }

    public function update(Request $request, Catalogues $catalogues)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_km' => 'nullable|string|max:255',
            'image'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name_en', 'name_km']);

        if ($request->hasFile('image')) {
            if ($catalogues->image && Storage::disk('custom')->exists($catalogues->image)) {
                Storage::disk('custom')->delete($catalogues->image);
            }

            $data['image'] = $request->file('image')->store('catalogues', 'custom');
        }

        $data['slug'] = $catalogues->slug;

        $catalogues->update($data);

        return redirect()->route('catalogues-backend.index')
            ->with('success', 'Updated successfully.');
    }

    public function delete(Catalogues $catalogues)
    {
        if ($catalogues->image && Storage::disk('custom')->exists($catalogues->image)) {
            Storage::disk('custom')->delete($catalogues->image);
        }

        $catalogues->delete();

        return redirect()->route('catalogues-backend.index')
            ->with('success', 'Deleted successfully.');
    }
}
