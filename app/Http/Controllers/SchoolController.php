<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Course;
use App\Models\Comment;
use App\Models\Content;
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
        return view('school.index');
    }

    public function courseList($programId)
    {
        $program = Program::where('id', $programId)->first();
        $categories = Category::where('program_id', $programId)->get();
        return view('school.programmes.courses',['program'=>$program, 'categories'=>$categories]);
    }

    public function filterCourses(Request $req)
    {
        $courses = Course::where(['category_id' => $req->categoryId, 'course_status' => true])
                    ->with('enrollments')->get();
        return $courses;
    }

    public function takeCats(Request $req)
    {
        $cats = Category::where('program_id', $req->selectProgramId)->get();
        return $cats;
    }

    public function selectChoices(Request $req)
    {
        if($req->userChoice == 'Students') {

            $courses = Course::where('user_id', Auth::user()->id)->get();

            $students = [];
            if($courses->isNotEmpty()) {

                foreach($courses as $c){

                    if($c->enrollments->isNotEmpty()){

                        foreach($c->enrollments as $e){

                            $students[$c->course_name][] = [
                                'enrollStatus' => $e->status,
                                'stuInfo' => $e->user
                            ];

                        }

                    }

                }

            }
            //dd($students);
            return ['students' => $students];

        } elseif($req->userChoice == 'Reports') {
            $reports = 'cc';
            return ['reports' => $reports];
        }
    }

    public function detailCourse($id)
    {
        if(!Auth::check()){
            return back()->with(['status' => 'You need to login first!']);
        }
        $course = Course::where('id', $id)->first();

        $enrollStatus = false;
        if(Enrollment::where(['user_id' => Auth::user()->id, 'course_id' => $id ])->exists()){
            $enroll = Enrollment::where(['user_id' => Auth::user()->id, 'course_id' => $id ])->first();
            //dd($enroll->status);
            $enrollStatus = $enroll->status;
        }
        //dd($enrollStatus);
        return view('school.programmes.coursedetail', ['course' => $course, 'enrollStatus' => $enrollStatus]);
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
        return view('school.programmes.content', ['content' => $content, 'topic' => $topic]);
    }

    public function downloadFile($fileName)
    {
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
                'topic_id' => $topicId
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

        return back()->with(['status' => 'you updated '. $req->contentTitle . ' successfully.']);
    }

    public function deleteContent($topicId, $contentId)
    {
        Content::where('id', $contentId)->delete();

        $topic = Topic::where('id', $topicId)->first();
        return redirect()->route('courseDetail', $topic->course->course_name)->with(['success' => 'you deleted one content']);
    }

    public function enrollCourse($courseId)
    {
        if(Enrollment::where(['user_id'=>Auth::user()->id, 'course_id'=>$courseId])->exists()){
            return redirect()->back()->with(['status' => "sorry, you've already enrolled!"]);
        }

        Enrollment::create([
            'user_id' => Auth::user()->id,
            'course_id' => $courseId,
        ]);

        Course::where('id', $courseId)->increment('enroll_count');

        return redirect()->route('profile')->with(['status' => 'you enrolled successfully!']);
    }

    public function unenrollCourse($courseId)
    {
        Enrollment::where(['user_id' => Auth::user()->id, 'course_id' => $courseId])->delete();

        Course::where('id', $courseId)->decrement('enroll_count');

        return back()->with(['status' => 'you unenroll this course successfully!']);
    }

    public function studentTable()
    {
        $course = Course::where('user_id', Auth::user()->id)->get();

        foreach ($course as $c) {
            $enroll = Enrollment::where('course_id', $c->id)->get();

            $students = User::whereIn('id', $enroll->pluck('user_id'))->get();

            $enrollCourses = Course::whereIn('id', $enroll->pluck('course_id'))->get();

            $lists[] = [
                'course' => $enrollCourses,
                'student' => $students,
                'enroll' => $enroll,
            ];

            $enro[] = $enroll;
        }
        //dd($lists);
        for ($i=0; $i < count($enro) ; $i++) {
            // dd($enro[1][0]->id);
            $stu[] = User::where('id', $enro[$i][0]->user_id)->get();
            //dd($stu);
        }
        return view('school.teacher.studentcontrol', ['lists'=>$lists]);
    }

    public function acceptEnroll($studentId, $courseName)
    {
        $course = Course::where('course_name', $courseName)->first();

        Enrollment::where(['user_id' => $studentId, 'course_id' => $course->id])
                        ->update(['status' => true]);

        return back()->with(['status' => 'you accepted!']);
    }

    public function kickStudent($studentId, $courseName)
    {
        $course = Course::where('course_name', $courseName)->first();

        Enrollment::where(['user_id' => $studentId, 'course_id' => $course->id])
        ->update(['status' => false]);

        Course::where('id', $course->id)->decrement('enroll_count');

        return back()->with(['status' => 'you kicked student successfully!']);
    }

    public function writeComment(Request $req)
    {
        $req->validate(['commentBody' => 'required']);
        Comment::create([
            'body' => $req->commentBody,
            'user_id' => Auth::user()->id,
            'content_id' => $req->contentId
        ]);
        return back()->with(['status' => 'you wrote comment successfully']);
    }

    public function deleteComment($commentId)
    {
        Comment::where('id', $commentId)->delete();
        return back()->with(['status' => 'you deleted your comment successfully!']);
    }
}
