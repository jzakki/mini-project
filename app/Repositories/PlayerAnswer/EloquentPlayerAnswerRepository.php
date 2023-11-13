<?php

namespace App\Repositories\PlayerAnswer;

use App\Models\PlayerAnswer;
use Illuminate\Database\Eloquent\Collection;

class EloquentPlayerAnswerRepository implements PlayerAnswerRepository
{
    /**
     * Create a new playerAnswer.
     *
     * @param array $data
     * @return \App\Models\PlayerAnswer
     */
    public function create(array $data): PlayerAnswer
    {
        return PlayerAnswer::create($data);
    }

    /**
     * Get Player Answers.
     *
     * @param int $gameID
     * @param int $playerID
     * @return Collection
     */
    public function getPlayerAnswers(int $gameID, int $playerID): Collection
    {
        return PlayerAnswer::with('question')
            ->where('game_id', $gameID)
            ->where('player_id', $playerID)
            ->get();
    }

}
