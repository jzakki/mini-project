<?php

namespace App\Repositories\Player;

use App\Models\Player;

interface PlayerRepository
{
    public function create(array $data): Player;

    public function firstOrCreate(array $data): Player;
}

