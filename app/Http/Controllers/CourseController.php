<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Course;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    //
    public function createCourse(Request $req)
    {
        $req->validate([
            'programSelected' => 'required',
            'catId' => 'required',
            'courseName' => 'required|unique:courses,course_name',
            'description' => 'required'
        ]);

        if (Course::where(['course_name' => $req->courseName, 'user_id' => Auth::user()->id])->exists()) {
            return back()->with(['status' => 'this course is already existed!']);
        } else{

            $image = null;
            //$imageName = null;
            if($req->hasFile('courseImage')){
                $image = $req->file('courseImage');
                $imageName = time() . '_' . $image->getClientOriginalName();    // give a name combination with time
                //dd($imageName);
                Storage::disk('public')->putFileAs('course', $image, $imageName); // store in storage / app / public / uploads
                Course::create(['course_image' => $imageName]);
            }

            Course::create([
                'course_name' => $req->courseName,
                'course_description' => $req->description,
                'category_id' => $req->catId,
                'user_id' => Auth::user()->id
            ]);

            return back()->with(['status' => 'created course successfully!']);
        }

    }

    public function editCourse(Request $req)
    {
        $req->validate([
            'programSelected' => 'required',
            'catId' => 'required',
            'courseName' => 'required',
            'description' => 'required'
        ]);

        // if (Course::where(['course_name' => $req->courseName, 'user_id' => Auth::user()->id])->exists()) {
        //     return back()->with(['status' => 'this course is already existed!']);
        // } else {
            $image = null;
            if($req->hasFile('courseImage')){
                $image = $req->file('courseImage');

                $dbImage = Course::where('id', $req->courseId)->first();
                $dbImage = $dbImage->course_image;
                if($dbImage != null){
                    Storage::disk('public')->delete('course/'. $dbImage);
                }

                $imageName = time() . '_' . $image->getClientOriginalName();
                Storage::disk('public')->putFileAs('course', $image, $imageName);
                Course::where('id', $req->courseId)->update(['course_image' => $imageName]);
            }

            Course::where('id', $req->courseId)->update([
                'course_name' => $req->courseName,
                'course_description' => $req->description,
                'category_id' => $req->catId,
                'user_id' => Auth::user()->id
            ]);

            return back()->with(['status' => 'updated course successfully!']);
        // }
    }

    public function createTopic(Request $req)
    {
       // dd($req->all());
        $req->validate([
            'topicName' => 'required',
            'topicDescription' => 'required',
            'contentTitle' => 'required',
            'contentType' => 'required',
            'contentBody' => 'required'
        ]);

        if($req->contentType == 'video'){
            $req->validate(['contentBody' => 'mimetypes:video/mp4,video/avi,video/quicktim']);
        } elseif($req->contentType == 'image'){
            $req->validate(['contentBody' => 'mimes:jpeg,png,gif']);
        } elseif($req->contentType == 'file') {
            $req->validate(['contentBody' => 'mimes:pdf,docx,txt']);
        }

        if($req->hasFile('contentBody')){
            //dd($req->contentType);
            $content = $req->file('contentBody');
            $fileName = time() . '_' . $content->getClientOriginalName();
            Storage::disk('public')->putFileAs('course/topic/content', $content, $fileName);

            $topic = Topic::create([
                'topic_name' => $req->topicName,
                'topic_description' => $req->topicDescription,
                'course_id' => $req->courseId
            ]);

            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_path' => $fileName,
                'topic_id' => $topic->id
            ]);
        }else{
            $topic = Topic::create([
                'topic_name' => $req->topicName,
                'topic_description' => $req->topicDescription,
                'course_id' => $req->courseId
            ]);

            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_body' => $req->contentBody,
                'topic_id' => $topic->id
            ]);
        }
        return back()->with(['status' => 'created new topic successfully']);
    }

    public function addContent(Request $req)
    {
        //dd($req->all());
        $req->validate([
            'contentTitle' => 'required',
            'contentType' => 'required',
            'contentBody' => 'required'
        ]);

        if($req->contentType == 'video'){
            $req->validate(['contentBody' => 'mimetypes:video/mp4,video/avi,video/quicktim']);
        } elseif($req->contentType == 'image'){
            $req->validate(['contentBody' => 'mimes:jpeg,png,gif']);
        } elseif($req->contentType == 'file') {
            $req->validate(['contentBody' => 'mimes:pdf,docx,txt']);
        }

        if($req->hasFile('contentBody')){
            $content = $req->file('contentBody');
            $fileName = time() . '_' . $content->getClientOriginalName();
            Storage::disk('public')->putFileAs('course/topic/content', $content, $fileName);

            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_path' => $fileName,
                'topic_id' => $req->topicId
            ]);
        }else{
            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_body' => $req->contentBody,
                'topic_id' => $req->topicId
            ]);
        }
        return back()->with(['status' => 'added new content successfully']);
    }

    public function takeCategories(Request $req)
    {
        $cats = Category::where('program_id', $req->selectProgramId)->get();
        return $cats;
    }

    public function editContent($contentId, Request $req)
    {
        //dd($req->all());
        $text = null;
        $fileName = null;
        if($req->fileContent == null){
            $req->validate([
                'contentTitle' => 'required',
                'textContent' => 'required',
            ]);

            $text = $req->textContent;
        } else{
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
        }
        //dd($text);
        Content::where('id', $contentId)->update([
            'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_body' => $text,
                'content_path' => $fileName,
                'topic_id' => $req->topicId
        ]);

        return back()->with(['status' => 'you updated '. $req->contentTitle . ' successfully.']);
    }

    public function deleteCourse($courseId)
    {
        $course = Course::where('id', $courseId)->first();

        if($course->topics->isNotEmpty()){
            return back()->with(['status' => "this course has one or more topic, you can't delete!"]);
        } else{
            Course::where('id', $courseId)->delete();

            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin.courses.manage')->with(['status' => 'you delete one course successfully']);
            } else{
                return redirect()->route('profile')->with(['status' => 'you delete one course successfully']);
            }
        }
    }
}
