<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $book_id)
    {
        $request->validate([
            'comment_body' . $book_id => 'required|max:150'
        ],
        [
            'comment_body' . $book_id . '.required' => 'You cannot submit an empty comment.',
            'comment_body' . $book_id . '.max' => 'The comment must not have more than 150 characters.'
        ]
    
        );

        $this->comment->body = $request->input('comment_body' . $book_id);
        $this->comment->user_id = Auth::user()->id;
        $this->comment->book_id = $book_id;
        $this->comment->save();

        return redirect()->route('book.show', $book_id);
    }

    public function destroy($comment_id)
    {
        $this->comment->destroy($comment_id);

        return redirect()->back();
    }
}
