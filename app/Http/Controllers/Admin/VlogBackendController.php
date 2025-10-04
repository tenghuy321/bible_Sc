<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VlogBackendController extends Controller
{
    public function index()
    {
        $vlogs = Vlog::get();
        return view('admin.vlogs.index', compact('vlogs'));
    }

    public function create()
    {
        return view('admin.vlogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_Url' => 'required|url',
            'title_en' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
            'paragraph_en' => 'nullable|string',
            'paragraph_km' => 'nullable|string',
        ]);

        Vlog::create($request->all());

        return redirect()->route('vlog-backend.index')->with('success', 'Vlog created successfully.');
    }

    public function edit(Vlog $vlog)
    {
        return view('admin.vlogs.edit', compact('vlog'));
    }

    public function update(Request $request, Vlog $vlog)
    {
        $request->validate([
            'video_Url' => 'required|url',
            'title_en' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
            'paragraph_en' => 'nullable|string',
            'paragraph_km' => 'nullable|string',
        ]);

        $vlog->update($request->all());

        return redirect()->route('vlog-backend.index')->with('success', 'Vlog updated successfully.');
    }

    public function delete(Vlog $vlog)
    {
        $vlog->delete();
        return redirect()->route('vlog-backend.index')->with('success', 'Vlog deleted successfully.');
    }
}
