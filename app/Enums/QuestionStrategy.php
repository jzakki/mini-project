<?php

namespace App\Enums;

enum QuestionStrategy: string
{
    case Random = 'random';
    case DIFFICULTY_BASED = 'difficulty_based';
    case CATEGORY_BASED = 'category_based';
    case PLAYER_INPUT = 'player-input';
}
