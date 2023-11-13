<?php

namespace App\Services;

use App\Models\Player;
use App\Repositories\Player\PlayerRepository;

class PlayerService
{
    private PlayerRepository $playerRepository;

    public function __construct(
        PlayerRepository $playerRepository,
    ){
        $this->playerRepository = $playerRepository;
    }

    public function createPlayers(array $players):array {
        foreach ($players as $key => $player){
            $players [$key] = $this->playerRepository->firstOrCreate(['name' => $player]);
        }

        return $players;
    }

}
