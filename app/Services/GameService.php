<?php

namespace App\Services;

use App\Enums\QuestionStrategy;
use App\Repositories\Game\GameRepository;
use App\Services\Game\Game;
use App\Services\Game\GameFactory;
use App\Services\QuestionSelectionStrategy\QuestionSelectionFactory;
use App\Services\ScoringStrategy\ScoringFactory;
use Illuminate\Database\Eloquent\Collection;

class GameService
{
    private GameRepository $gameRepository;

    public function __construct(
        GameRepository $gameRepository,
    ){
        $this->gameRepository = $gameRepository;
    }

    public function startNewGame($type):Game {
        $game = GameFactory::create($type);

        $gameRepository = $this->gameRepository->create([
            'status' => $game->getStatus(),
            'game_mode' => $game->getGameMode(),
        ]);

        $game->setID($gameRepository->id);

        return $game;
    }

    public function joinPlayersToGame(Game $game, array $players): void{
        $game->setPlayers($players);
    }

    public function selectGameQuestionsBasedOnStrategy(string $strategy, Game $game, array $conditions){
        $questionSelection = QuestionSelectionFactory::create($strategy);
        $game->setQuestionSelectionStrategy($questionSelection);

        return $game->selectQuestions($conditions);
    }

    public function selectScoringStrategy(string $strategy, Game $game, Collection $answers){
        $scoring = ScoringFactory::create($strategy);
        $game->setScoringStrategy($scoring);

        return $game->calculateScore($answers);
    }

}
