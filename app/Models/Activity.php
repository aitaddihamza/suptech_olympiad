<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Notifications\Notifiable;

class Activity extends Model
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['name', 'description', 'user_id', 'date_debut', 'date_fin'];

    // Relation entre Activity et User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'participant_activity', 'activity_id', 'user_id');
    }
}
