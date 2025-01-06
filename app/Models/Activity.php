<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Game;

class Activity extends Model
{
    protected $casts = [
       'date_debut' => 'date',
       'date_fin' => 'date',
    ];
    //
    // Activity.php
    public function participants()
    {
        return $this->belongsToMany(User::class, 'activity_user');  // Inverse of the 'activities' relationship
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
