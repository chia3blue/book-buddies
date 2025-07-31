<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    # To get the ownew of the book post
    public function user()
    {
        // return $this->belongsTo(User::class);
        return $this->belongsTo(User::class)->withTrashed();
    }

    # 各本の育成中モンスターの記録に紐づけるため
    public function userCreature()
    {
        return $this->belongsTo(UserCreature::class);
    }

    #To get all the comments of a book
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    # Like feature
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    # Returns TRUE if the Auth user already liked the book post
    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
