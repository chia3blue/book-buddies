<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
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
        // $all_books = $this->book->latest()->get();
        $home_books = $this->getHomeBooks();
        $suggested_users = $this->getSuggestUsers();

        // return view('users.home')->with('all_books', $all_books);
        return view('users.home')
                        ->with('home_books', $home_books)
                        ->with('suggested_users', $suggested_users);
    }

    # Get the book posts of the users that the Auth user is following
    private function getHomeBooks()
    {
        $all_books = $this->book->latest()->get();
        $home_books = []; // In case the $home_books is empty, it will not return null, but empty instead

        foreach($all_books as $book)
            {
                if($book->user->isFollowed() || $book->user->id === Auth::user()->id){
                    $home_books[] = $book;
                }
            }
        return $home_books;
    }

    # Get the users that the Auth user is not following
    private function getSuggestUsers()
    {
        $all_users = $this->user->all()->except(Auth::user()->id);
        $suggested_users = [];

        foreach($all_users as $user)
            {
                if(!$user->isFollowed()){
                    $suggested_users[] = $user;
                }
            }
            return array_slice($suggested_users, 0, 5);
            // array_slice(x,y,z)
            // x - array_name
            // y - offset/ index number
            // z - length/ how many
    }

    // Search feature
    public function search(Request $request)
    {
        $users = $this->user->where('name', 'like', '%' . $request->search . '%')->get();
        return view('users.search')->with('users', $users)->with('search', $request->search);
    }
}
