<?php

namespace App\Http\Controllers;

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
        return view('programmes.courses');
    }
}
