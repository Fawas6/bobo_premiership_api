<?php

namespace App\Http\Controllers\Season;

use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GetFootballSeasonController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Response::api("Football seasons retrieved successfully", Season::select('id', 'year')->get(), code: 200);
    }
}
