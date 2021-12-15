<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
//use App\Http\Controllers\DB;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function getCreatePage()
    {
        return view('create');
    }

    public function createBook(Request $request)
    {
        // Book::create([
        // 'title' => $request->title,
        // 'author' => $request->author,
        // 'release' => $request->release,
        // 'price' => $request->price,
        // ]);

        DB::table('books')->insert([
            'title' => $request->title,
            'author' => $request->author,
            'release' => $request->release,
            'price' => $request->price,
        ]);

        return redirect(route('getCreatePage'));
    }
    public function getBooks()
    {
        $books = Book::all();
        //dd($books); //menampilkan dalam datanya
        return view('view', ['books' => $books]);
    }


    public function getBookById($id)
    {
        $book = Book::find($id);
        //dd($book);
        return view('update', ['book' => $book]);
    }
    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);

        //  $books->title = $request->title;
        //  $books->author = $request->author;
        //  $books->release = $request->release;
        //  $books->price = $request->price;
        //  $book->save();

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'release' => $request->release,
            'price' => $request->price,
        ]);

        return redirect(route('getBooks'));
    }

    public function deleteBook($id)
    {
        Book::destroy($id);
        return redirect(route('getBooks'));
    }
}
