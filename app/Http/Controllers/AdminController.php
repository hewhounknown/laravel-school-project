<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Library;
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
}
