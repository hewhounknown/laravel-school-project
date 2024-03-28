<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Spatie\PdfToImage\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    //
    public function center()
    {
        $books = Library::all();

        return view('school.library.center', ['books' => $books]);
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

    public function viewBook($bookId)
    {
        $book = Library::where('id', $bookId)->first();
        //$book = $book->book_path;
        return view('school.library.book', ['book' => $book]);
    }

    public function readBook($bookId)
    {
        if(!Auth::check()){
            return back()->with(['status' => 'You need to login first!']);
        }

        $book = Library::where('id', $bookId)->first();

        if(Auth::user()->role == 'admin'){
            return view('admin.library.book', compact('book'));
        } else{
            return Pdf::view('school.library.book', ['book'=>$book])->format('a4')->name($book->book_name);
        }
    }
}

