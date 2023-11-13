<?php

namespace App\Services;

use App\Models\PlayerAnswer;
use App\Repositories\PlayerAnswer\PlayerAnswerRepository;
use Illuminate\Database\Eloquent\Collection;

class PlayerAnswerService
{

    private PlayerAnswerRepository $playerAnswerRepository;

    public function __construct(
        PlayerAnswerRepository $playerAnswerRepository,
    ){
        $this->playerAnswerRepository = $playerAnswerRepository;
    }

    public function createPlayerAnswer(array $data): PlayerAnswer{
        $playerAnswer = $this->playerAnswerRepository->create([
            'player_id' => $data['player_id'],
            'game_id' => $data['game_id'],
            'question_id' => $data['question_id'],
            'given_answer' => $data['given_answer'],
            'is_correct' => $data['is_correct'],
        ]);

        return $playerAnswer;
    }

    public function getPlayerAnswers($gameID, $playerID): Collection{
        return $this->playerAnswerRepository->getPlayerAnswers($gameID, $playerID);
    }

}
