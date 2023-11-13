<?php

namespace App\Services;

use App\Enums\DifficultyLevel;
use App\Models\Question;
use App\Repositories\Question\QuestionRepository;
use Illuminate\Database\Eloquent\Collection;

class QuestionService
{
    private QuestionRepository $questionRepository;
    private CategoryService $categoryService;

    public function __construct(
        QuestionRepository $questionRepository,
        CategoryService $categoryService,
    ){
        $this->questionRepository = $questionRepository;
        $this->categoryService = $categoryService;
    }

    public function createQuestion($data) {
        $category = $this->categoryService->findByName($data['question_category']);

        $question = $this->questionRepository->create([
            'category_id' => $category->id,
            'question_text' => $data['question_text'],
            'difficulty_level' => $data['difficulty_level'],
            'question_type' => $data['question_type'],
        ]);

        foreach ($data['answers'] as $answer){
            $isCorrect = ($answer === $data['correct_answer']);
            $question->answers()->create([
                'question_id' => $question->id,
                'answer_text' => $answer,
                'is_correct' => $isCorrect
            ]);
        }

        return $question;
    }

    public function getQuestion($id) {
        return Question::with('answers')->find($id);
    }

    public function getDifficultyLevels(): array{
        return [
            DifficultyLevel::EASY->value,
            DifficultyLevel::MEDIUM->value,
            DifficultyLevel::HARD->value,
        ];
    }

    public function findQuestionById(int $id): Question{
        return $this->questionRepository->find($id);
    }
}
