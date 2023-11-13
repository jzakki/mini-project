<?php

namespace App\Repositories\Score;

use App\Models\Score;

interface ScoreRepository
{
    public function create(array $data): Score;
}

