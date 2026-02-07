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
        return Response::api("Football gameweeks retrieved successfully", Gameweek::select('id', 'name')->where('season_id', $season->id)->get(), code: 200);
    }
}
