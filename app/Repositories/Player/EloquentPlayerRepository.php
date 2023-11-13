<?php

namespace App\Repositories\Player;

use App\Models\Player;

class EloquentPlayerRepository implements PlayerRepository
{
    /**
     * Create a new player.
     *
     * @param array $data
     * @return \App\Models\Player
     */
    public function create(array $data): Player
    {
        return Player::create($data);
    }

    /**
     * Find or create a player by name
     *
     * @param array $data
     * @return \App\Models\Player
     */
    public function firstOrCreate(array $data): Player
    {
        return Player::firstOrCreate($data);
    }

}
