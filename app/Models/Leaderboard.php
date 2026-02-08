<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Leaderboard extends Model
{
    use HasFactory;

    protected $table = 'leaderboards';

    protected $guarded = [];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(Player::class, 'leaderboard_players', 'leaderboard_id', 'player_id');
    }
}
