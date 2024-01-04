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


        // foreach($books as $book){
        //     $filePath =public_path('storage/library/books/'.$book->book_path);

        //     $pdf = new Pdf($filePath);

        //     $image = $pdf->setOutputFormat('png');

        //     $imagePath = storage_path('app/public/library/cover/') . basename($book->book_path, '.pdf') . '.png';

        //     dd($pdf->setPage(1));;

        //     Storage::disk('public')->putFileAs('library/cover', $image, $imagePath);
        // }
        return view('library.center', ['books' => $books]);
    }

    public function viewBook()
    {
        return view('library.book');
    }

    public function addBook(Request $req)
    {
        $req->validate([
            'bookName' => 'required',
            'authorName' => 'required',
            'book' => 'required|mimes:pdf',
        ]);

        // dd($req->all());
        $book = $req->file('book');
        $bookPath = time() . "_" . $book->getClientOriginalName();
        Storage::disk('public')->putFileAs('library/books', $book, $bookPath);

        Library::create([
            'book_name' => $req->bookName,
            'author_name' => $req->authorName,
            'book_path' => $bookPath,
            'post_by' => Auth::user()->id
        ]);

        return back()->with(['status' => 'you added book in library successfully!']);
    }
}

