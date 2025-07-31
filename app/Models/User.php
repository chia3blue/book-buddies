<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

# creature feature用
# modelでは不要
// use App\Models\Creature;
// use App\Models\UserCreature;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    # To get all the book posts of a user
    public function books()
    {
        return $this->hasMany(Book::class)->latest();
    }


    #creatures feature用
    public function userCreatures()
    {
        return $this->hasMany(UserCreature::class);
    }

    public function creatures()
    {
        return $this->belongsToMany(Creature::class, 'user_creatures')
                    ->withPivot('stage', 'current')
                    ->withTimestamps();
    }

    // 今育てているモンスター（1体だけ想定）
    // リレーションメソッド
    public function currentCreature()
    {
        return $this->hasOne(UserCreature::class)
                    ->where('current', true);
    }

    // 「現在育成中のモンスター」を取得する
    // アクセサ（カスタム属性）
    //  Laravelが「get＋StudlyCase名＋Attribute」という関数名を自動的に読み取る
    // この関数は自動的に：$user->current_creatureとして呼び出される
public function getCurrentCreatureAttribute()
{
    return $this->userCreatures()
                ->where('current', true)
                ->with('books') // ← eager load で高速化
                ->first();
}

    // 現在育成中のモンスターとは別に、stage = 6（最終ステージ）かつ current = false のモンスターを表示させる
    public function finishedCreatures()
    {
        return $this->userCreatures()
            ->where('stage', 6)
            ->where('current', false)
            ->with('creature');
    }

    // public function likes()
    // {
    //     return $this->hasMany(Like::class);
    // }

    // Follow Feature
    # To get all the followers of user
    public function followers()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    # To get all the users that the user is following
    public function following()
    {
        return $this->hasMany(Follow::class, 'follower_id');
    }

    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        // Auth::user()->id is the follower_id
        // Firstly, get all the followers of the user ($this->followers()), Then, from that list, search for the auth user
        // from the follower column.
    }
}
