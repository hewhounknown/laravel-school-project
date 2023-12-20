<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Content;
use App\Models\Courses;
use App\Models\Program;
use App\Models\Category;
use App\Models\Languages;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    //
    public function home()
    {
        return view('index');
    }

    public function courseList($programName)
    {
        //dd($programName);
        $program = Program::where('name', $programName)->first();
        //dd($program->id);
        $category = Category::where('program_id', $program->id)->get();
        //dd($category);
        foreach($category as $cat){
           // dd($cat->id);
            $courses = Courses::where('category_id', $cat->id)->get();
        }
        //dd($courses);
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
        $breadcrumbs = Breadcrumbs::generate(); // for using breadcrumbs

        return view('programmes.coursedetail', ['course' => $course, 'topic' => $topic, 'breadcrumbs' => $breadcrumbs]);
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
            //dd($req->all());
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

    public function content($topicId, $contentId)
    {
        //dd($contentId);
        $content = Content::where('id', $contentId)->first();
        $topic = Topic::where('id', $topicId)->first();
        // print_r($topic);
        //dd($content);
        // $breadcrumbs = Breadcrumbs::render('contentView', $topic, $content); // for using breadcrumbs
        // dd($breadcrumbs);
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

    public function editContent($topicId, $contentId, Request $req)
    {
       // $content = $req->except('_token');
       // dd($content);
        if($req->fileContent == null){
            $req->validate([
                'contentTitle' => 'required',
                'textContent' => 'required',
            ]);

            Content::where('id', $contentId)->update([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_body' => $req->textContent,
                'topic_id' => $contentId
            ]);
        } else {
            //dd($req->all());
            $req->validate([
                'contentTitle' => 'required',
                'fileContent' => 'required'
            ]);

            $file = $req->file('fileContent');

            $fileInDB = Content::where('id',$contentId)->first();
            $fileInDB = $fileInDB->content_path;

            if($fileInDB != null){
                Storage::disk('public')->delete('course/topic/content'. $fileInDB);  // Storage == storage/app
            }

            $fileName = time() . '_' . $file->getClientOriginalName();  // give a name combination with time

            Storage::disk('public')->putFileAs('course/topic/content', $file, $fileName); // store in storage / app / public / course/topic/content

            Content::where('id', $contentId)->update([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_path' => $fileName,
                'topic_id' => $topicId
            ]);
        }

        return back()->with(['success' => 'you updated '. $req->contentTitle . ' successfully.']);
    }

    public function deleteContent($topicId, $contentId)
    {
        Content::where('id', $contentId)->delete();

        $topic = Topic::where('id', $topicId)->first();
        return redirect()->route('courseDetail', $topic->course->course_name)->with(['success' => 'you deleted one content']);
    }

    public function enrollCourse($courseId)
    {
        if(Enrollment::where('user_id', Auth::user()->id)->exists()){
            return redirect()->back()->with(['status' => "sorry, you've already enrolled!"]);
        }

        Enrollment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $courseId,
        ]);

        return redirect()->route('profile')->with(['success' => 'you enrolled successfully!']);
    }
}
