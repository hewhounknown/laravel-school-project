<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Course;
use App\Models\Content;
use App\Models\Library;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $admins = User::where('role', 'admin')->get();
        $teachers = User::where('role', 'teacher')->get();
        $students = User::where('role', 'student')->get();
        $books = Library::all();
        return view('admin.dashboard', ['admins'=>$admins, 'teachers'=>$teachers, 'students'=>$students, 'books'=>$books]);
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.user.index', ['users' => $users]);
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['status' => 'deleted user account successfully!']);
    }

    public function changeRole($id, $role)
    {
        $user = User::where('id', $id)->first();
        User::where('id', $id)->update(['role' => $role]);
        return back()->with(['status' => 'successfully, changed ' . $user->name . ' role to ' . $role]);
    }

    public function changeStatus($id, $status)
    {
        $user = User::where('id', $id)->first();
        User::where('id', $id)->update(['account_status' => $status]);
        return back()->with(['status' => 'successfully, changed ' . $user->name . "'s account to " . $status]);
    }

    // ajax search bar for userManagement
    public function searchUsers(Request $req)
    {
        $users = User::where('name', 'like', '%' . $req->search . '%')
                        ->orwhere('email', 'like', '%' . $req->search . '%')
                        ->orwhere('role', 'like', '%' . $req->search . '%')->get();
        return $users;
    }

    public function detailUser($userId)
    {
        $user = User::where('id', $userId)->first();
        //dd($user->courses);
        return view('admin.user.userdetail', ['user'=> $user]);
    }

    public function manageLibrary()
    {
        $newbooks = Library::where('public_status', false)->get();
        $books = Library::where('public_status', true)
            ->inRandomOrder()->take(8)->get();
        return view('admin.library.index', ['newbooks' => $newbooks, 'books' => $books]);
    }

    public function addBook(Request $req)
    {
        $req->validate([
            'bookName' => 'required',
            'authorName' => 'required',
            'book' => 'required|mimes:pdf',
        ]);

        $coverPath = null;
        if($req->hasFile('bookCover')){
            $req->validate([
                'bookCover' => 'mimes:jpg,png,jpeg,svg'
            ]);
            $cover = $req->file('bookCover');
            $coverPath = time() . "_" . $cover->getClientOriginalName();
            Storage::disk('public')->putFileAs('library/cover', $cover, $coverPath);
        }

        $book = $req->file('book');
        $bookPath = time() . "_" . $book->getClientOriginalName();
        Storage::disk('public')->putFileAs('library/books', $book, $bookPath);

        Library::create([
            'book_name' => $req->bookName,
            'author_name' => $req->authorName,
            'cover' => $coverPath,
            'book_path' => $bookPath,
            'posted_by' => Auth::user()->id
        ]);

        return back()->with(['status' => 'you added book in library successfully!']);
    }

    public function publicBook($bookId)
    {
        Library::where('id', $bookId)->update(['public_status' => true]);
        return back()->with(['status' => 'you confirmed a book to the public successfully!']);
    }

    public function unpublicBook($bookId)
    {
        Library::where('id', $bookId)->update(['public_status' => false]);
        return back()->with(['status' => 'you confirmed a book to the private successfully!']);
    }

    public function deleteBook($bookId)
    {
        Library::where('id', $bookId)->delete();
        return redirect()->route('book.list')->with(['status' => 'you deleted one book successfully']);
    }

    public function booksList()
    {
        $books = Library::where('public_status', true)->get();
        return view('admin.library.bookslist', ['books'=>$books]);
    }

    // ajax search bar for booklist
    public function searchBook(Request $req)
    {
        $books = Library::where('book_name', 'like', '%'. $req->item .'%')
            ->orwhere('author_name', 'like', '%'. $req->item .'%')
            ->orwhere('posted_by', 'like', '%'. $req->item .'%')->with('user')->get();
        return $books;
    }

    public function managePrograms()
    {
        return view('admin.program.index');
    }

    public function createProgram(Request $req)
    {
        // dd($req);
        $req->validate([
            'programName' => 'required|unique:programs,name',
            'cat1' => 'required|unique:categories,category_name',
            'cat2' => 'required|unique:categories,category_name',
            'cat3' => 'required|unique:categories,category_name',
        ]);

        if(in_array('cat1', array_keys($req->all()))){
            //dd($req->all());
            $cats = array_filter($req->all(), function($key){
                return strpos($key, 'cat') === 0;
            }, ARRAY_FILTER_USE_KEY);
             //dd($cats);

           $program = Program::create(['name'=>$req->programName]);
            foreach($cats as $key => $value){
               // dd($value);
                Category::create([
                    'category_name' => $value,
                    'program_id' => $program->id
                ]);
            }
        }

        return back()->with(['status' => 'created new program successfully!']);
    }

    public function editProgram($programId, Request $req)
    {
        $req->validate(['programName' => 'required']);
        //dd($req->all());
        Program::where('id', $programId)->update(['name' => $req->programName]);

        if($req->has('cat1')){
            $inputData = $req->all();

            $cats = array_filter($req->all(), function($key){
                return strpos($key, 'cat') === 0 && strpos($key, 'catId') !== 0;
            }, ARRAY_FILTER_USE_KEY);

            $updateCats = [];
            $newCats = [];
            for ($i=0; $i < count($cats); $i++) {
                if ($req->has('catId'.$i)) {
                    $updateCats[] = ['id' => $req->input('catId'.$i), 'name' => $req->input('cat'.$i)];
                } else {
                    $newCats[] = ['name' => $req->input('cat'.$i)];
                }
            }
            //dd($updateCats);
            foreach($updateCats as $updateCat){
                Category::where('id', $updateCat['id'])->update(['category_name'=>$updateCat['name']]);
            }

            if(count($newCats)>0){
                foreach($newCats as $new){
                    Category::create([
                        'category_name' => $new['name'],
                        'program_id' => $programId
                    ]);
                }
            }
        }

        return back()->with(['status' => 'updated program successfully1']);
    }

    public function manageCourses()
    {
        $newCourses = Course::where('course_status', false)->get();
        $courses = Course::where('course_status', true)->get();
        return view('admin.program.courses', ['newCourses' => $newCourses,'courses' => $courses]);
    }

    public function searchCourse(Request $req)
    {
        $courses = Course::where('course_status', true)->where('course_name', 'like', '%' . $req->searchData . '%')
                            ->with('category', 'category.program', 'teacher')->get();
        return $courses;
    }

    public function publicCourse($courseId)
    {
        Course::where('id', $courseId)->update(['course_status' => true]);
        return back()->with(['status' => 'confirmed course to the public successfully']);
    }

    public function unpublicCourse($courseId)
    {
        Course::where('id', $courseId)->update(['course_status' => false]);
        return back()->with(['status' => 'blocked course successfully']);
    }

    public function detailCourse($courseId)
    {
        $course = Course::where('id', $courseId)->first();
        return view('admin.program.coursedetail', ['course'=>$course]);
    }

    public function viewContent($contentId)
    {
        $content = Content::where('id', $contentId)->first();
        return view('admin.program.content', ['content'=>$content]);
    }

    public function deleteContent($contentId, $topicId)
    {
        Content::where('id', $contentId)->delete();
        $topic = Topic::where('id', $topicId)->first();
        return redirect()->route('admin.course.detail', $topic->course->id)->with(['status' => 'you delete content successfully!']);
    }
}
