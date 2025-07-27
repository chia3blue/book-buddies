<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
// use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    private $book;
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Book $book, User $user)
    {
        // $this->middleware('auth');
        $this->book = $book;
        $this->user = $user;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_books = $this->book->latest()->get();

        return view('users.home')->with('all_books', $all_books);
    }
}
