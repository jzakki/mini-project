<?php

namespace App\Services\Game;

use App\Enums\GameMode;
use App\Enums\GameStatus;
use App\Enums\QuestionStrategy;
use App\Services\QuestionSelectionStrategy\QuestionSelection;
use App\Services\ScoringStrategy\Scoring;

class MultiplayerGame extends Game
{

    public function __construct(){
        $this->setStatus(GameStatus::IN_PROGRESS->value);
        $this->setGameMode(GameMode::MULTIPLAYER->value);
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
