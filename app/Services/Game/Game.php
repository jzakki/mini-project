<?php

namespace App\Services\Game;

use App\Services\QuestionSelectionStrategy\QuestionSelection;
use App\Services\ScoringStrategy\Scoring;
use Illuminate\Database\Eloquent\Collection;

abstract class Game
{
    private int $id;
    private string $status;
    private string $gameMode;
    private array $players;
    private array $questions;
    private int $playerScore;
    private int $questionCount = 1;
    private QuestionSelection $questionSelection;
    private Scoring $scoring;

    public function setID(int $id){
        $this->id = $id;
    }
    public function getID(): string{
        return $this->id;
    }

    public function setStatus(string $status){
        $this->status = $status;
    }
    public function getStatus(): string{
        return $this->status;
    }

    public function setPlayerScore(int $playerScore){
        $this->playerScore = $playerScore;
    }
    public function getPlayerScore(): int{
        return $this->playerScore;
    }

    public function setGameMode(string $gameMode){
        $this->gameMode = $gameMode;
    }
    public function getGameMode(): string{
        return $this->gameMode;
    }

    public function setPlayers(array $players): void{
        $this->players = $players;
    }

    public function getPlayers(): array{
        return $this->players;
    }

    public function getQuestionCount(): int{
        return $this->questionCount;
    }

    public function getQuestions(): array{
        return $this->questions;
    }

    public function setQuestions(array $questions){
        $this->questions = $questions;
    }

    public abstract function selectQuestionSelectionStrategy(QuestionSelection $questionSelection);

    public abstract function selectScoringStrategy(Scoring $scoring);
    public function setQuestionSelectionStrategy(QuestionSelection $questionSelection) {
        $this->questionSelection = $questionSelection;
    }

    public function selectQuestions(array $conditions): array{
        return $this->questionSelection->selectQuestions($conditions);
    }

    public function setScoringStrategy(Scoring $scoring) {
        $this->scoring = $scoring;
    }

    public function calculateScore(Collection $answers): array{
        return $this->scoring->calculateScore($answers);
    }

}
