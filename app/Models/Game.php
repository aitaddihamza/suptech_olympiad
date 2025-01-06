<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Game extends Model
{
    use HasFactory;
    use Notifiable;
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
            return 'À venir';
        } elseif ($this->schedule_date->isToday()) {
            return 'En cours';
        } else {
            return 'Terminé';
        }
    }
}
