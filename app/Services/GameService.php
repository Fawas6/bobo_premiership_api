<?php

namespace App\Services;

use App\Models\Game;

class GameService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getGames($request)
    {
        $games = Game::query()->when($request->q, function ($q) use ($request) {
            $q->whereRelation('player', 'name', 'like', "%{$request->q}%")
                ->orWhereRelation('player', 'player_id', 'like', "%{$request->q}%");
        })
            ->when($request->gameweek_id, function ($q) use ($request) {
                $q->where('gameweek_id', $request->gameweek_id);
            })
            ->with(['player', 'gameweek'])
            ->orderBy('points', 'desc')
            ->paginate(10);

        $games->getCollection()->transform(function ($game) {
            return [
                'id' => $game->id,
                'player' => $game->player?->name,
                'player_id' => $game->player?->player_id,
                'gameweek' => $game->gameweek?->name,
                'points' => $game->points . "pts",
                'created_at' => $game->created_at->format('M d, Y g:i A')
            ];
        });

        return $games;
    }
}
