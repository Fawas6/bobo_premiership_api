<?php

namespace App\Http\Controllers\Leaderboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeaderboardRequest;
use App\Models\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class LeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaderboardRequest $request)
    {
        Gate::authorize('manage-leader-boards', Leaderboard::class);

        $leaderboard = Leaderboard::create($request->validated());

        return Response::api("New leaderboard created successfully", code: 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
