<?php

namespace App\Services\ScoringStrategy;

class BasicScoring implements Scoring {
    public function calculateScore($answers) {

        $totalQuestions = $answers->count();
        $correctAnswers = 0;
        $wrongAnswers = 0;

        foreach ($answers as $answer){
            ($answer->is_correct) ? $correctAnswers++ : $wrongAnswers++;
        }

        $percentage = round((($correctAnswers / $totalQuestions) * 100), 2);

        return [
            'total_questions' => $totalQuestions,
            'correct_answers' => $correctAnswers,
            'wrong_answers' => $wrongAnswers,
            'rate' => $percentage,
            'score' => $correctAnswers,
        ];
    }
}
