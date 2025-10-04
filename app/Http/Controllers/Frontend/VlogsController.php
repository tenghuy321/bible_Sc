<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Vlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VlogsController extends Controller
{
    public function index()
    {
        $vlogs = Vlog::get();
        return view('frontend.vlogs', [
            'vlogs' => $vlogs,
            'locale' => app()->getLocale(),
        ]);
    }
}
