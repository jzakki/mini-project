<?php

namespace App\Services\QuestionSelectionStrategy;

use App\Services\QuestionService;

class PlayerInputQuestion implements QuestionSelection
{
    private QuestionService $questionService;

    public function __construct(){
        $this->questionService = app(QuestionService::class);
    }

    public function selectQuestions($conditions): array
    {
        $questions = [];

        foreach ($conditions as $condition){
            $questions [] = $this->questionService->findQuestionById($condition);
        }

        return $questions;
    }
}
