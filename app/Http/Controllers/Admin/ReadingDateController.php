<?php

namespace App\Http\Controllers\Admin;

use App\Models\ReadingDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'title_en' => 'required',
            'title_km' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
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
            'title_en' => 'nullable',
            'title_km' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->except('_token', 'image', '_method');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('reading', 'custom');

            if ($reading->image && Storage::disk('custom')->exists($reading->image)) {
                Storage::disk('custom')->delete($reading->image);
            }
        }

        // $reading->update($request->all());
        $i = $reading->update($data);
        if ($i) {
            return redirect()->route('readingdate.index')->with('success', 'Updated Successfully!');
        } else {
            return redirect()->route('readingdate.edit')
                ->with('error', 'Failed to updated Product.')
                ->withInput();
        }

        // return redirect()->route('readingdate.index')->with('success', 'Updated successfully.');
    }

    public function delete(ReadingDate $reading)
    {
        $reading->delete();
        return redirect()->route('readingdate.index')->with('success', 'Deleted successfully.');
    }
}
