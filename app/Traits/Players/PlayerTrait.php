<?php

namespace App\Traits\Players;

use App\Models\Player;

trait PlayerTrait
{
    /**
     * Generate a unique player ID
     * Format: Bobo-XXX (e.g., Bobo-001, Bobo-002)
     */
    public function generatePlayerId(): string
    {
        do {
            $lastPlayer = Player::orderBy('id', 'desc')->first();

            if ($lastPlayer && preg_match('/Bobo-(\d+)/', $lastPlayer->player_id, $matches)) {
                $nextNumber = (int)$matches[1] + 1;
            } else {
                $nextNumber = 1;
            }

            $playerId = 'Bobo-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            $exists = Player::where('player_id', $playerId)->exists();

        } while ($exists);

        return $playerId;
    }
}
