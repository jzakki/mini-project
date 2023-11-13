<?php

namespace App\Repositories\Question;

use App\Models\Question;

class EloquentQuestionRepository implements QuestionRepository
{
    /**
     * Create a new question.
     *
     * @param array $data
     * @return \App\Models\Question
     */
    public function create(array $data): Question
    {
        return Question::create($data);
    }

    /**
     * Find a question by its ID, along with its answers.
     *
     * @param int $id The ID of the question.
     * @return \App\Models\Question|null Returns the Question model instance or null if not found.
     */
    public function find(int $id): ?Question
    {
        return Question::with('answers')->find($id);
    }


}
