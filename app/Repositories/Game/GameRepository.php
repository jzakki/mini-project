<?php

namespace App\Repositories\Game;

use App\Models\Game;

interface GameRepository
{
    public function create(array $data): Game;

    public function find(int $id): ?Game;
}

