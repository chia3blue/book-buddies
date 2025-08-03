<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

# creature feature用
# modelでは不要
// use App\Models\Creature;
// use App\Models\User;

class UserCreature extends Model
{

    use HasFactory;

    // 対応するテーブル名（Laravelの規則通りなので省略可能）
    protected $table = 'user_creatures';

    // ホワイトリスト：保存を許可するカラム
    protected $fillable = [
        'user_id',
        'creature_id',
        'stage',
        'current',
    ];

    // 型変換（bool や int に明示）
    protected $casts = [
        'current' => 'boolean',
        'stage' => 'integer',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creature()
    {
        return $this->belongsTo(Creature::class);
    }

    /**
     *  現在のステージの画像URLを取得する
     */
    public function getCurrentImageUrlAttribute()
    {
        // 通常のモンスターが存在すれば、それを使う
    if ($this->creature) {
        $field = 'image_stage_' . $this->stage;
        return asset($this->creature->$field ?? 'images/default_creature.png');
    }

    // creature_id が null の場合 → デフォルト画像を段階別に出し分け
    $defaultImages = [
        1 => 'images/default/stage_1.png',
        2 => 'images/default/stage_2.png',
        3 => 'images/default/stage_3.png',
        4 => 'images/default/stage_4.png',
        5 => 'images/default/stage_5.png',
        6 => 'images/default/stage_6.png',
    ];

    return asset($defaultImages[$this->stage] ?? 'images/default_creature.png');
    }

    # 各本の育成中モンスターの記録に紐づけるため
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
