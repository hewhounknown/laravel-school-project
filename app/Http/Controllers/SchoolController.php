<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Program;
use App\Models\Category;
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
        $category = Category::where('program_id', 1)->get();

        $courses = Courses::join('categories', 'courses.category_id', '=', 'categories.id')->get();
        //echo $languages;
       // $courses = Courses::leftjoin('languages', 'courses.language_id', '=', 'languages.id')->get();
        //echo $courses;
        //$lists = Languages::where('name', $name)->leftjoin('courses', 'languages.id', '=', 'courses.language_id')->get();
        return view('programmes.courses',['category'=>$category, 'courses'=>$courses]);
    }

    public function coursesDetail($title)
    {
        // $courses = Courses::where('title', $title)
        //                     ->leftjoin('languages', 'courses.language_id', '=', 'languages.id')
        //                     ->first();
        // echo $courses->name;
        return view('programmes.detail');
    }

    public function courseForm($id)
    {
       $category = Category::where('program_id', $id)->get();
       //echo $category;


       return view('teacher.coursecreate', ['category' => $category]);
    }

    // public function __construct() {
    //     $program = Program::all();
    //    // echo $program;
    //    return ['program' => $program];
    // }
}
