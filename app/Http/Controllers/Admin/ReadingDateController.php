<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReadingDate;
use Illuminate\Http\Request;

class ReadingDateController extends Controller
{
    public function index()
    {
        $readings = ReadingDate::get();
        return view('admin.readingdate.index', compact('readings'));
    }

    public function create()
    {
        return view('admin.readingdate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
        ]);

        ReadingDate::create($request->all());

        return redirect()->route('readingdate.index')->with('success', 'Created successfully.');
    }

    public function edit(ReadingDate $reading)
    {
        return view('admin.readingdate.edit', compact('reading'));
    }

    public function update(Request $request, ReadingDate $reading)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_km' => 'nullable|string|max:255',
        ]);

        $reading->update($request->all());

        return redirect()->route('readingdate.index')->with('success', 'Updated successfully.');
    }

    public function delete(ReadingDate $reading)
    {
        $reading->delete();
        return redirect()->route('readingdate.index')->with('success', 'Deleted successfully.');
    }
}
