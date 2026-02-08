<?php

namespace App\Http\Controllers\Season;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetSeasonCurrentGameweekRequest;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class SetSeasonCurrentGameweekController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SetSeasonCurrentGameweekRequest $request, Season $season)
    {
        Gate::authorize('manage-seasons', Season::class);

        $season->update(['current_gameweek_id' => $request->validated()['current_gameweek_id']]);

        return Response::api("Current gameweek set successfully", code: 200);
    }
}
