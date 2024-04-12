<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Course;
use App\Models\Review;
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
        $teachers = User::where('role', 'teacher')->inRandomOrder()->take(5)->get();
        $popularCourses = Course::where('course_status', true)
                                ->orderBy('enroll_count', 'desc')->take(3)->get();
        $newCourses = Course::where('course_status', true)->orderBy('id', 'desc')->take(4)->get();
        return view('school.index', ['teachers' => $teachers, 'popularCourses' => $popularCourses, 'newCourses' => $newCourses]);
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
            return ['students' => $students];
        } elseif($req->userChoice == 'Reports') {
            $reports = 'cc';
            return ['reports' => $reports];
        }
    }

    public function detailCourse($id)
    {
        $course = Course::where('id', $id)->first();
        $enrollStatus = false;
        if(Enrollment::where(['user_id' => Auth::user()->id, 'course_id' => $id ])->exists()){
            $enroll = Enrollment::where(['user_id' => Auth::user()->id, 'course_id' => $id ])->first();
            $enrollStatus = $enroll->status;
        }
        return view('school.programmes.coursedetail', ['course' => $course, 'enrollStatus' => $enrollStatus]);
    }

    public function content($contentId)
    {
        $content = Content::where('id', $contentId)->first();
        return view('school.programmes.content', ['content' => $content]);
    }

    public function downloadFile($fileName)
    {
        $filePath = public_path('storage/course/topic/content/'.$fileName);
        if (file_exists($filePath)) {
            return response()->download($filePath, $fileName);
        }
        abort(404, 'File not found');
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

    public function createReview(Request $req)
    {
        $req->validate([
            'rating' => 'required',
            'comment' => 'required'
        ]);
        Review::create([
            'rating' => $req->rating,
            'comment' => $req->comment,
            'course_id' => $req->courseId,
            'user_id' => Auth::user()->id
        ]);
        return back()->with(['status' => 'you created review for this course successfully']);
    }

    public function deleteReview($reviewId)
    {
        Review::where('id', $reviewId)->delete();
        return back()->with(['status' => 'you deleted your review for this course']);
    }

    public function viewProfile($userId)
    {
        $user = User::where('id', $userId)->first();
        $list = [];
        if(Enrollment::where('user_id', $user->id)->exists()){
            $enroll = Enrollment::where('user_id', $user->id)->get();
            foreach($enroll as $e){
                $course = Course::where('id', $e->course_id)->get();
                $list[] = [
                    'course' => $course,
                    'enroll' => $e
                ];
            }
        }
        return view('school.acc.user', ['user' => $user, 'list' => $list]);
    }
}
