<?php

namespace App\Repositories\Game;

use App\Models\Game;

class EloquentGameRepository implements GameRepository
{
    /**
     * Create a new game.
     *
     * @param array $data
     * @return \App\Models\Game
     */
    public function create(array $data): Game
    {
        return Game::create($data);
    }

    /**
     * Retrieve a specific game by its ID.
     *
     * @param int $id
     * @return \App\Models\Game|null
     */
    public function find(int $id): ?Game
    {
        return Game::find($id);
    }

}
