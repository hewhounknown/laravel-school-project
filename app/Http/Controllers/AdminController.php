<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
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
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', ['users' => $users]);
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

    public function manageLibrary()
    {
        $newbooks = Library::where('public_status', false)->get();
        $books = Library::where('public_status', true)
            ->inRandomOrder()->take(8)->get();
        return view('admin.library', ['newbooks' => $newbooks, 'books' => $books]);
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
        Library::where('id', $bookId)->update([
            'public_status' => true,
        ]);
        return back()->with(['status' => 'you confirmed a book to the public successfully!']);
    }

    public function booksList()
    {
        $books = Library::where('public_status', true)->get();
        return view('admin.bookslist', ['books'=>$books]);
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
        return view('admin.program');
    }

    public function createProgram(Request $req)
    {
        // dd($req);
        $req->validate(['programName' => 'required|unique:programs,name']);

        $program = Program::create(['name'=>$req->programName]);

        if(in_array('cat1', array_keys($req->all()))){
            //dd($req->all());
            $cats = array_filter($req->all(), function($key){
                return strpos($key, 'cat') === 0;
            }, ARRAY_FILTER_USE_KEY);
            // dd($cats);

            foreach($cats as $key => $value){
                Category::firstOrCreate([
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
        return view('admin.courses', ['newCourses' => $newCourses,'courses' => $courses]);
    }

    public function takeCategories(Request $req)
    {
        $cats = Category::where('program_id', $req->selectProgramId)->get();
        return $cats;
    }

    public function createCourse(Request $req)
    {
        $req->validate([
            'programSelected' => 'required',
            'catId' => 'required',
            'courseName' => 'required|unique:courses,course_name',
            'description' => 'required'
        ]);

        if (Course::where(['course_name' => $req->courseName, 'teacher_id' => Auth::user()->id])->exists()) {
            return back()->with(['status' => 'this course is already existed!']);
        } else{

            $image = null;
            if($req->hasFile('courseImage')){
                $image = $req->file('courseImage');
                $imageName = time() . '_' . $image->getClientOriginalName();    // give a name combination with time
                Storage::disk('public')->putFileAs('course', $image, $imageName); // store in storage / app / public / uploads
            }

            Course::create([
                'course_name' => $req->courseName,
                'course_description' => $req->description,
                'course_image' => $imageName,
                'category_id' => $req->catId,
                'teacher_id' => Auth::user()->id
            ]);

            return back()->with(['status' => 'created course successfully!']);
        }

    }
}
