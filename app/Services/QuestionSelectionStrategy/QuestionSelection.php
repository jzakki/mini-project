<?php

namespace App\Services\QuestionSelectionStrategy;

interface QuestionSelection
{
    public function selectQuestions(array $conditions): array;

}
