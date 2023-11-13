<?php

namespace App\Services;

use App\Repositories\Score\ScoreRepository;

class ScoreService
{
    private ScoreRepository $scoreRepository;

    public function __construct(
        ScoreRepository $scoreRepository,
    ){
        $this->scoreRepository = $scoreRepository;
    }

    public function createScore(array $data){
        $score = $this->scoreRepository->create([
            'player_id' => $data['player_id'],
            'game_id' => $data['game_id'],
            'score_value' => $data['score_value']
        ]);

        return $score;
    }

}
