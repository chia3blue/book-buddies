<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    # To get the ownew of the book post
    public function user()
    {
        return $this->belongsTo(User::class);
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
}
