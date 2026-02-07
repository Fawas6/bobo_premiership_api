<?php

namespace App\Services;

use App\Models\Gameweek;
use App\Models\Season;
use Illuminate\Support\Facades\DB;

class FootballSeasonService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Create new season with 38 gameweeks
     */
    public static function createNewSeason()
    {
        return DB::transaction(function () {
            $now = now();
            $currentYear = $now->year;

            if ($now->month < 8) {
                $seasonYear = ($currentYear - 1) . "/" . $currentYear;
            } else {
                $seasonYear = $currentYear . "/" . ($currentYear + 1);
            }

            $season = Season::updateOrCreate(
                ['year' => $seasonYear],
                [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            for ($i = 1; $i <= 38; $i++) {
                Gameweek::updateOrCreate(
                    [
                        'season_id' => $season->id,
                        'name' => 'Gameweek ' . $i
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        });
    }
}
