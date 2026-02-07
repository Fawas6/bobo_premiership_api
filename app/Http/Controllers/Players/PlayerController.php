<?php

namespace App\Http\Controllers\Players;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayerRequest;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = PlayerService::getPlayers($request);

        if ($data->isEmpty()) {
            return Response::api("No player found", [], code: 200);
        }

        return Response::api("Players retrieved successfully", $data, code: 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlayerRequest $request)
    {
        Gate::authorize('manage-players', Player::class);
        Player::create($request->validated());
        return Response::api("New player created successfully", code: 200);
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
