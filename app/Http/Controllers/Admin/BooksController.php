<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BooksController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        // $all_books = $this->book->latest()->paginate(10);
        $all_books = $this->book->withTrashed()->latest()->paginate(10);

        return view('admin.books.index')->with('all_books', $all_books);
    }

    public function hide($id)
    {
        $this->book->destroy($id);

        return redirect()->back();
    }

        public function unhide($id)
    {
        $this->book->onlyTrashed()->findOrFail($id)->restore();

        return redirect()->back();
    }

}
