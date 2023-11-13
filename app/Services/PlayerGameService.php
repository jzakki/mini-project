<?php

namespace App\Services;

use App\Models\PlayerGame;
use App\Repositories\PlayerGame\PlayerGameRepository;
use App\Services\Game\Game;

class PlayerGameService
{
    private PlayerGameRepository $playerGameRepository;

    public function __construct(
        PlayerGameRepository $playerGameRepository,
    ){
        $this->playerGameRepository = $playerGameRepository;
    }

    public function createNewPlayerGames(int $gameID, array $players):void {
        foreach ($players as $player){
            $this->playerGameRepository->create([
                'player_id' => $player->id,
                'game_id' => $gameID,
            ]);
        }
    }

}
