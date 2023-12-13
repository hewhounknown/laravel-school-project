<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Content;
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
         if (Courses::where(['course_name' => $req->title, 'teacher' => Auth::user()->name])->exists()) {
            return redirect()->back()->with(['fails' => 'this course is already existed!']);
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

    public function detailCourse($courseName)
    {
        $course = Courses::where('course_name', $courseName)->first();
        $topic = Topic::where('course_id', $course->id)->get();
        //print_r($topic);

        return view('teacher.coursedetail', ['course' => $course, 'topic' => $topic]);
    }

    public function addTopic($courseName, Request $req)
    {
        $req->validate(['topicTitle' => 'required|unique:topics,topic_name']);

        Topic::create([
            'topic_name' => $req->topicTitle,
            'topic_description' => $req->topicDescription,
            'course_id' => $req->courseId,
        ]);

        return redirect()->back()->with(['success' => 'you created ' . $req->topicTitle . ' successfully.']);
    }

    public function addContent($topicName, Request $req)
    {

        //dd($req->all());
        if ($req->fileContent == null) {
            $req->validate([
                'contentTitle' => 'required|unique:contents,title,'.$req->topicId,
                'textContent' => 'required'
            ]);

            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_body' => $req->textContent,
                'topic_id' => $req->topicId
            ]);

        } else{
            dd($req->all());
            $req->validate([
                'contentTitle' => 'required|unique:contents,title'.$req->topicId,
                'fileContent' => 'required'
            ]);
            //dd($req->all());

            $content = $req->file('fileContent');
            $fileName = time() . '_' . $content->getClientOriginalName();
            Storage::disk('public')->putFileAs('course/topic/content', $content, $fileName);

            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_path' => $fileName,
                'topic_id' => $req->topicId
            ]);

        }

        return back()->with(['success' => 'you created '. $req->contentTitle . ' successfully.']);
    }

    public function content($name, $title){
        $content = Content::where('title', $title)->first();
        $topic = Topic::where('topic_name', $name)->first();
        // print_r($topic);
        return view('programmes.content', ['content' => $content, 'topic' => $topic]);
    }

    public function downloadFile($fileName){
        //dd($fileName);
        $filePath = public_path('storage/course/topic/content/'.$fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName);
        }

        abort(404, 'File not found');
    }
}
