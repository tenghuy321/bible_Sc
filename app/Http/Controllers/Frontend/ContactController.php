<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $data['versions_item'] = Version::where('slug', '=', 'khmer-standard-version-khsv')->first();

        return view('frontend.contact', $data);
    }
}
