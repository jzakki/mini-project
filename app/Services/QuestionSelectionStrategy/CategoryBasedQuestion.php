<?php

namespace App\Services\QuestionSelectionStrategy;

class CategoryBasedQuestion implements QuestionSelection
{
    public function selectQuestions(array $conditions): array
    {
        return [];
    }
}
