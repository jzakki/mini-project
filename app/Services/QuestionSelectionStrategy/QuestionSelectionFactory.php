<?php

namespace App\Services\QuestionSelectionStrategy;

use App\Enums\GameMode;
use App\Enums\QuestionStrategy;
use App\Services\Game\Game;
use App\Services\Game\MultiplayerGame;
use App\Services\Game\SinglePlayerGame;

abstract class QuestionSelectionFactory
{
    public static function create($type):QuestionSelection {
        switch ($type) {
            case QuestionStrategy::Random->value:
                return new RandomQuestion();
            case QuestionStrategy::DIFFICULTY_BASED->value:
                return new DifficultyBasedQuestion();
            case QuestionStrategy::CATEGORY_BASED->value:
                return new CategoryBasedQuestion();
            case QuestionStrategy::PLAYER_INPUT->value:
                return new PlayerInputQuestion();
            default:
                throw new \InvalidArgumentException("Invalid question strategy");
        }
    }
}
