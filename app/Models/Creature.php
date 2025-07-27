<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

# creature feature用
# modelでは不要
// use App\Models\User;
// use App\Models\UserCreature;

class Creature extends Model
{

    public const STAGES = [
        1 => 'egg',
        2 => 'hatchling',
        3 => 'juvenile',
        4 => 'young',
        5 => 'adult',
        6 => 'legendary',
    ];


    # creature feature用
    public function userCreatures()
    {
        return $this->hasMany(UserCreature::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_creatures')
                    ->withPivot('stage', 'current')
                    ->withTimestamps();
    }

}
