<?php

namespace App\Http\Controllers\Admin;

use App\Models\Version;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VersionBackendController extends Controller
{
    public function index()
    {
        $versions = Version::get();
        return view('admin.versions.index', compact('versions'));
    }

    public function create()
    {
        return view('admin.versions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titleEn' => 'required|string|max:255',
            'titleKm' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Generate slug only on create
        $data['slug'] = Str::slug($data['titleEn']);

        Version::create($data);

        return redirect()->route('version-backend.index')->with('success', 'Created successfully.');
    }


    public function edit(Version $version)
    {
        return view('admin.versions.edit', compact('version'));
    }

    public function update(Request $request, Version $version)
    {
        $request->validate([
            'titleEn' => 'required|string|max:255',
            'titleKm' => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        // Keep the old slug
        $data['slug'] = $version->slug;

        $version->update($data);

        return redirect()->route('version-backend.index')->with('success', 'Updated successfully.');
    }


    public function delete(Version $version)
    {
        $version->delete();
        return redirect()->route('vlog-backend.index')->with('success', 'Deleted successfully.');
    }
}
