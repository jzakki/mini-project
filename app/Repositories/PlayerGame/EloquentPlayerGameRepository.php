<?php

namespace App\Repositories\PlayerGame;

use App\Models\PlayerGame;

class EloquentPlayerGameRepository implements PlayerGameRepository
{
    /**
     * Create a new playerGame.
     *
     * @param array $data
     * @return \App\Models\PlayerGame
     */
    public function create(array $data): PlayerGame
    {
        return PlayerGame::create($data);
    }

}
