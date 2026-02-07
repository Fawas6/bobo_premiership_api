<?php

namespace App\Http\Controllers\Season;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Services\FootballSeasonService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CreateNewFootballSeasonController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        Gate::authorize('manage-seasons', Season::class);
        FootballSeasonService::createNewSeason();
        return Response::api("New football season created successfully", code: 200);
    }
}
