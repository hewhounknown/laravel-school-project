<?php

namespace App\Http\Controllers;

use App\Models\Languages;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    public function home()
    {
        return view('index');
    }

    public function languagesPage()
    {
        $languages = Languages::select('name')->get();
        return view('programmes.courses', ['languages' => $languages]);
    }
}
