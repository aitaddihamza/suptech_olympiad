<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['player1_id', 'player2_id', 'activity_id', 'score1', 'score2', 'schedule_date'];
    protected $casts = [
        'schedule_date' => 'datetime',
    ];
    // Define the relationships
    public function player1()
    {
        return $this->belongsTo(User::class, 'player1_id');
    }

    public function player2()
    {
        return $this->belongsTo(User::class, 'player2_id');
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'game_user', 'game_id', 'user_id')
                    ->withTimestamps();
    }

    public function getStatusAttribute()
    {
        if ($this->schedule_date->isFuture()) {
            return 'Upcoming';
        } elseif ($this->schedule_date->isToday()) {
            return 'Ongoing';
        } else {
            return 'Completed';
        }
    }
}
