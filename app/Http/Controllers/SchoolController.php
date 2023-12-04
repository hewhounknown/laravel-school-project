<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Program;
use App\Models\Category;
use App\Models\Languages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function createCourse(Request $req)
    {
        $req->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required'
        ]);
        //dd($req->teacher);
         if (Courses::where(['course_name' => $req->title, 'teacher' => $req->teacher])->exists()) {
            print_r($req->all());
        } else{
        //dd($req->category);
            $categoryId = Category::where('category_name', $req->category)->first();
            $categoryId = $categoryId->id;

            $image = $req->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();    // give a name combination with time
            Storage::disk('public')->putFileAs('course', $image, $imageName); // store in storage / app / public / uploads

            Courses::create([
                'course_name' => $req->title,
                'course_description' => $req->description,
                'course_image' => $imageName,
                'category_id' => $categoryId,
                'teacher' => Auth::user()->name
            ]);

            return redirect()->route('profile')->with(['success' => 'you created new course']);
        }
    }
}
