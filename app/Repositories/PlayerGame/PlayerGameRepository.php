<?php

namespace App\Repositories\PlayerGame;

use App\Models\PlayerGame;

interface PlayerGameRepository
{
    public function create(array $data): PlayerGame;
}

