<?php

namespace App\Repositories\Question;

use App\Models\Question;

interface QuestionRepository
{
    public function create(array $data): Question;
    public function find(int $id): ?Question;
}

