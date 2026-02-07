<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    use HasFactory;

    protected $table = 'players';

    protected $guarded = [];

    public function games(): HasMany
    {
        return $this->hasMany(Game::class, 'player_id');
    }
}
