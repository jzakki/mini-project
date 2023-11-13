<?php

namespace App\Console\Commands;

use App\Enums\GameMode;
use App\Enums\QuestionStrategy;
use App\Enums\QuestionType;
use App\Enums\ScoringStrategy;
use App\Models\Question;
use App\Services\CategoryService;
use App\Services\GameService;
use App\Services\PlayerAnswerService;
use App\Services\PlayerGameService;
use App\Services\PlayerService;
use App\Services\QuestionService;
use App\Services\ScoreService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class PlayGameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trivia:play';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts a new trivia game';

    private GameService $gameService;
    private PlayerService $playerService;
    private PlayerGameService $playerGameService;
    private QuestionService $questionService;
    private CategoryService $categoryService;
    private PlayerAnswerService $playerAnswerService;
    private ScoreService $scoreService;

    public function __construct(
        GameService $gameService,
        PlayerService $playerService,
        PlayerGameService $playerGameService,
        QuestionService $questionService,
        CategoryService $categoryService,
        PlayerAnswerService $playerAnswerService,
        ScoreService $scoreService,
    )
    {
        parent::__construct();
        $this->gameService = $gameService;
        $this->playerService = $playerService;
        $this->playerGameService = $playerGameService;
        $this->questionService = $questionService;
        $this->categoryService = $categoryService;
        $this->playerAnswerService = $playerAnswerService;
        $this->scoreService = $scoreService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Welcome to the Trivia Game!');

        $gameMode = $this->getGameMode();

        match ($gameMode) {
            GameMode::SINGLE_PLAYER->value => $this->startSinglePlayerGame(),
            GameMode::MULTIPLAYER->value => $this->startMultiplayerGame(),
            'Or bye bye' => $this->exitGame()
        };

    }

    private function getGameMode(): string{
        return $this->choice(
            'Choose your game mode',
            [
                GameMode::SINGLE_PLAYER->value,
                GameMode::MULTIPLAYER->value,
                'Or bye bye'
            ],
            0
        );
    }

    private function startSinglePlayerGame(): void{
        $this->info('Maybe later ;)');
        $this->getGameMode();
    }

    private function startMultiplayerGame(): void{
        $multiplayerGame = $this->gameService->startNewGame(GameMode::MULTIPLAYER->value);

        $playersInfo = $this->getPlayersInfo(2);

        $players = $this->playerService->createPlayers($playersInfo);

        $this->gameService->joinPlayersToGame($multiplayerGame, $players);

        $this->playerGameService->createNewPlayerGames($multiplayerGame->getID(), $multiplayerGame->getPlayers());

        $questionStrategy = $this->getQuestionStrategy([
            QuestionStrategy::PLAYER_INPUT->value,
        ]);

        $conditions = (match ($questionStrategy) {
            QuestionStrategy::PLAYER_INPUT->value => fn() => $this->getPlayerQuestions($multiplayerGame->getQuestionCount()),
        })();

        $questions = $this->gameService->selectGameQuestionsBasedOnStrategy($questionStrategy, $multiplayerGame, $conditions);

        $multiplayerGame->setQuestions($questions);

        $this->retrievePlayerQuestions(
            $multiplayerGame->getQuestions(),
            $multiplayerGame->getID(),
            $multiplayerGame->getPlayers()[1]->id);

        $playerAnswers = $this->getPlayerAnswers($multiplayerGame->getID(), $multiplayerGame->getPlayers()[1]->id);

        $result = $this->gameService->selectScoringStrategy(ScoringStrategy::Basic->value, $multiplayerGame, $playerAnswers);

        $multiplayerGame->setPlayerScore($result['score']);

        $this->updatePlayerScore($multiplayerGame->getPlayers()[1]->id, $multiplayerGame->getID(), $result['score']);

        $this->printResult($result);
    }

    private function updatePlayerScore($playerID, $gameID, $playerScore){
        $this->scoreService->createScore([
            'player_id' => $playerID,
            'game_id' => $gameID,
            'score_value' => $playerScore,
        ]);
    }

    private function printResult($result) {
        $this->info("Total Questions: " . $result['total_questions']);
        $this->info("Correct Answers: " . $result['correct_answers']);
        $this->info("Wrong Answers: " . $result['wrong_answers']);
        $this->info("Rate: %" . $result['rate']);
        $this->info("Score:" . $result['score']);
    }

    private function getPlayerAnswers($gameID, $playerID): Collection{
        return $this->playerAnswerService->getPlayerAnswers($gameID, $playerID);
    }

    private function retrievePlayerQuestions(array $questions, int $gameID, int $playerID): void{
        $this->info('Quiz started! Please answer the following questions:');

        foreach ($questions as $question) {
            $answerTextsArray = $question->answers->pluck('answer_text')->toArray();
            $playerAnswer = $this->getPlayerAnswer($question->question_text, $answerTextsArray);

            $isCorrect = $this->isAnswerCorrect($question->answers, $playerAnswer);

            $this->playerAnswerService->createPlayerAnswer([
                'player_id' => $playerID,
                'game_id' => $gameID,
                'question_id' => $question->id,
                'given_answer' => $playerAnswer,
                'is_correct' => $isCorrect,
            ]);

        }
    }

    private function getPlayerAnswer($questionText, $answers): string {
        return $this->choice($questionText, $answers);
    }

    private function isAnswerCorrect($answers, $playerAnswer): bool {
        foreach ($answers as $answer){
            if ($answer->answer_text === $playerAnswer && $answer->is_correct) {
                return true;
            }
        }

        return false;
    }

    private function getPlayersInfo(int $playerCount): array {
        $players = [];

        for ($i = 1; $i <= $playerCount; $i++) {
            $playerName = $this->ask("Enter Player $i Name");
            $players[] = $playerName;
        }

        return $players;
    }

    private function getQuestionStrategy(array $strategies): string{
        return $this->choice(
            'Choose your question strategy',
            $strategies,
            0
        );
    }

    public function getPlayerQuestions($questionCount){
        $questions = [];

        while ($questionCount > 0){
            $questions [] = $this->addQuestion();
            $questionCount--;
        }

        return $questions;
    }

    private function addQuestion()
    {
        $type = $this->getQuestionType();
        $questionInfo = [
            'question_type' => $this->getQuestionTypeValue($type),
            'difficulty_level' => $this->getQuestionDifficulty(),
            'question_category' => $this->getQuestionCategory(),
            'question_text' => $this->ask('Enter question text'),
            'answers' => $this->getAnswersByType($type),
        ];

        $questionInfo['correct_answer'] = $this->askCorrectAnswer($questionInfo['answers']);

        $question = $this->submitQuestion($questionInfo);
        $this->info('Question created.');

        return $question->id;
    }

    private function askCorrectAnswer($questionAnswers): string
    {
        return $this->choice('Select the correct answer', $questionAnswers);
    }

    private function getQuestionDifficulty(): string
    {
        return $this->choice('Enter question difficulty',
            $this->questionService->getDifficultyLevels(), 0);
    }

    private function getQuestionCategory(): string
    {
        return $this->choice('Enter question category',
            $this->categoryService->getAllCategories(), 0);
    }

    private function getQuestionType(): string
    {
        return $this->choice('Enter question type', [
            0 => QuestionType::MULTIPLE_CHOICE->value,
            1 => QuestionType::TRUE_FALSE->value,
        ], 0);
    }

    private function getAnswersByType(string $type): array|null
    {
        return match($type) {
            QuestionType::MULTIPLE_CHOICE->value => $this->askAnswers(),
            QuestionType::TRUE_FALSE->value => ['true', 'false'],
        };
    }

    private function getQuestionTypeValue(string $type): string
    {
        return match($type) {
            QuestionType::MULTIPLE_CHOICE->value => QuestionType::MULTIPLE_CHOICE->value,
            QuestionType::TRUE_FALSE->value => QuestionType::TRUE_FALSE->value,
        };
    }

    private function submitQuestion(array $questionInfo): Question
    {
        return $this->questionService->createQuestion($questionInfo);
    }


    private function askAnswers(): array
    {
        $answers = [];

        for ($i = 1; $i <= 4; $i++) {
            $answer = $this->ask("Enter option $i");
            $answers [] = $answer;
        }

        return $answers;
    }

    protected function exitGame(){
        if ($this->confirm('Are you sure you want to exit the game?')) {
            $this->info('Exiting the game. Goodbye!');
            return false;
        }

        return true;
    }
}
