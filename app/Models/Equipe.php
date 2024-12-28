<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipe extends Model
{
    protected $fillable = ['name', 'logo_path', 'activite'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_equipe');
    }
}
