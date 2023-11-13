<?php

namespace App\Repositories\Score;

use App\Models\Score;

class EloquentScoreRepository implements ScoreRepository
{
    /**
     * Create a new score.
     *
     * @param array $data
     * @return \App\Models\Score
     */
    public function create(array $data): Score
    {
        return Score::create($data);
    }

}
