<?php

namespace App\Services\QuestionSelectionStrategy;

class RandomQuestion implements QuestionSelection
{
    public function selectQuestions(array $conditions): array
    {
        return [];
    }
}
