<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryController extends Controller
{
    //
    public function center()
    {
        return view('library.center');
    }

    public function viewBook()
    {
        return view('library.book');
    }
}