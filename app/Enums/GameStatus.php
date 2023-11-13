<?php

namespace App\Enums;

enum GameStatus: string
{
    case IN_PROGRESS = 'in-progress';
    case CANCELED = 'canceled';
    case COMPLETED = 'completed';
}
