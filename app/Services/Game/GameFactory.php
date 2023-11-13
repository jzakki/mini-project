<?php

namespace App\Services\Game;

use App\Enums\GameMode;

abstract class GameFactory
{
    public static function create($type):Game {
        switch ($type) {
            case GameMode::SINGLE_PLAYER->value:
                return new SinglePlayerGame();
            case GameMode::MULTIPLAYER->value:
                return new MultiplayerGame();
            default:
                throw new \InvalidArgumentException("Invalid game type");
        }
    }
}
