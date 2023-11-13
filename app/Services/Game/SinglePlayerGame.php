<?php

namespace App\Services\Game;

use App\Enums\GameMode;
use App\Enums\GameStatus;
use App\Models\Player;
use App\Services\QuestionSelectionStrategy\QuestionSelection;
use App\Services\ScoringStrategy\Scoring;

class SinglePlayerGame extends Game
{
    public function __construct(){
        $this->setStatus(GameStatus::IN_PROGRESS->value);
        $this->setGameMode(GameMode::SINGLE_PLAYER->value);
    }

    public function selectQuestionSelectionStrategy(QuestionSelection $questionSelection)
    {
        $this->setQuestionSelectionStrategy($questionSelection);
    }

    public function selectScoringStrategy(Scoring $scoring)
    {
        $this->setScoringStrategy($scoring);
    }

}
