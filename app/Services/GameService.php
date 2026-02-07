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
        $gamesQuery = match ($request->sort_by) {
            'newest' => Game::latest(),
            'oldest' => Game::oldest(),
            default => Game::latest()
        };

        $games = $gamesQuery->when($request->q, function ($q) use ($request) {
            $q->whereRelation('player', 'name', 'like', "%{$request->q}%")
                ->orWhereRelation('player', 'player_id', 'like', "%{$request->q}%");
        })
            ->when($request->season_id, function ($q) use ($request) {
                $q->whereRelation('gameweek', 'season_id', $request->season_id);
            })
            ->when($request->gameweek_id, function ($q) use ($request) {
                $q->where('gameweek_id', $request->gameweek_id);
            })
            ->with(['player', 'gameweek'])
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
