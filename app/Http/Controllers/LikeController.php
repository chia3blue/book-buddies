<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth; 

class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }

    public function store($book_id)
    {
        $this->like->user_id = Auth::user()->id;
        $this->like->book_id = $book_id;

        $this->like->save();

        return redirect()->back();
    }

    public function destroy($book_id)
    {
        $this->like
                ->where('user_id', Auth::user()->id)
                ->where('book_id', $book_id)
                ->delete();

        return redirect()->back();
    }
}
