<?php

namespace App\Http\Controllers\Gameweek;

use App\Http\Controllers\Controller;
use App\Models\Gameweek;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetFootballGameweekController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Season $season)
    {
        $data = Gameweek::select('id', 'name')
        ->where('season_id', $season->id)
        ->where('id', '<=', $season->current_gameweek_id)
        ->orderBy('id', 'desc')
        ->get();

        return Response::api("Football gameweeks retrieved successfully", $data, code: 200);
    }
}
