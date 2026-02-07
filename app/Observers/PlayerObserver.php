<?php

namespace App\Observers;

use App\Models\Player;
use App\Traits\Players\PlayerTrait;

class PlayerObserver
{
    use PlayerTrait;

    /**
     * Handle the Player "creating" event.
     */
    public function creating(Player $player): void
    {
        $player->player_id = $this->generatePlayerId();
    }

    /**
     * Handle the Player "created" event.
     */
    public function created(Player $player): void
    {
        //
    }

    /**
     * Handle the Player "updated" event.
     */
    public function updated(Player $player): void
    {
        //
    }

    /**
     * Handle the Player "deleted" event.
     */
    public function deleted(Player $player): void
    {
        //
    }

    /**
     * Handle the Player "restored" event.
     */
    public function restored(Player $player): void
    {
        //
    }

    /**
     * Handle the Player "force deleted" event.
     */
    public function forceDeleted(Player $player): void
    {
        //
    }
}
