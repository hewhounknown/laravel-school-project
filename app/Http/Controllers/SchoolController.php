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
        //$lists = Languages::where('name', $name)->leftjoin('courses', 'languages.id', '=', 'courses.language_id')->get();
        return view('programmes.courses', ['languages' => $languages, 'courses' => $courses]);
    }

    public function coursesGroup($name){
        $lists = Languages::where('name', $name)->leftjoin('courses', 'languages.id', '=', 'courses.language_id')->get();
        echo $lists;
       return redirect()->route('languages')->with(['lists' => $lists]);
    }

    public function coursesDetail($title){
        $courses = Courses::where('title', $title)
                            ->leftjoin('languages', 'courses.language_id', '=', 'languages.id')
                            ->first();
        // echo $courses->name;
        return view('programmes.detail', ['courses' => $courses]);
    }
}
