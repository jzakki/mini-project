<?php

namespace App\Repositories\PlayerAnswer;

use App\Models\PlayerAnswer;
use Illuminate\Database\Eloquent\Collection;

interface PlayerAnswerRepository
{
    public function create(array $data): PlayerAnswer;
    public function getPlayerAnswers(int $gameID, int $playerID): Collection;
}

