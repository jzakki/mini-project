<?php

namespace App\Services\QuestionSelectionStrategy;

class DifficultyBasedQuestion implements QuestionSelection
{
    public function selectQuestions(array $conditions): array
    {
        return [];
    }
}
