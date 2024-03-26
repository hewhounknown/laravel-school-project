<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

        if (Course::where(['course_name' => $req->courseName, 'user_id' => Auth::user()->id])->exists()) {
            return back()->with(['status' => 'this course is already existed!']);
        } else {
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
        }
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

        $topic = Topic::create([
            'topic_name' => $req->topicName,
            'topic_description' => $req->topicDescription,
            'course_id' => $req->courseId
        ]);

        if($req->hasFile('contentBody')){
            $content = $req->file('contentBody');
            $fileName = time() . '_' . $content->getClientOriginalName();
            Storage::disk('public')->putFileAs('course/topic/content', $content, $fileName);

            Content::create([
                'title' => $req->contentTitle,
                'content_type' => $req->contentType,
                'content_path' => $fileName,
                'topic_id' => $topic->id
            ]);
        }else{
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
        $req->validate([
            'contentTitle' => 'required',
            'contentType' => 'required',
            'contentBody' => 'required'
        ]);

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
}
