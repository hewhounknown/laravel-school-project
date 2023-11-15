<?php

namespace App\Http\Controllers;

use App\Models\Courses;
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
        $courses = Courses::get()->all();
        return view('programmes.courses', ['languages' => $languages, 'courses' => $courses]);
    }

    public function coursesDetail($title){
        $courses = Courses::where('title', $title)->first();

        return view('programmes.detail', compact('courses'));
    }
}
