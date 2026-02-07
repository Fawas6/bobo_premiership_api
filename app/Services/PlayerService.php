<?php

namespace App\Services;

use App\Models\Player;

class PlayerService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getPlayers($request)
    {
        $playersQuery = match ($request->sort_by) {
            'newest' => Player::latest(),
            'oldest' => Player::oldest(),
            default => Player::latest()
        };

        $players = $playersQuery->when($request->q, function ($q) use ($request) {
            $q->whereAny(['name', 'player_id'], 'like', "%{$request->q}%");
        })
            ->paginate(10);

        $players->getCollection()->transform(function ($player) {
            return [
                'id' => $player->id,
                'name' => $player->name,
                'player_id' => $player->player_id,
                'created_at' => $player->created_at->format('M d, Y g:i A')
            ];
        });

        return $players;
    }
}
