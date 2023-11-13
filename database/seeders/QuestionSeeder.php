<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'category_id' => 1,
                'question_text' => 'What is the capital of France?',
                'difficulty_level' => 'easy',
                'question_type' => 'multiple-choice',
                'answers' => [
                    ['answer_text' => 'Paris', 'is_correct' => true],
                    ['answer_text' => 'Berlin', 'is_correct' => false],
                    ['answer_text' => 'London', 'is_correct' => false],
                    ['answer_text' => 'Madrid', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 2,
                'question_text' => 'Water boils at 100 degrees Celsius.',
                'difficulty_level' => 'easy',
                'question_type' => 'true-false',
                'answers' => [
                    ['answer_text' => 'True', 'is_correct' => true],
                    ['answer_text' => 'False', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 3,
                'question_text' => 'Which planet is known as the Red Planet?',
                'difficulty_level' => 'medium',
                'question_type' => 'multiple-choice',
                'answers' => [
                    ['answer_text' => 'Mars', 'is_correct' => true],
                    ['answer_text' => 'Jupiter', 'is_correct' => false],
                    ['answer_text' => 'Saturn', 'is_correct' => false],
                    ['answer_text' => 'Venus', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 4,
                'question_text' => 'The Great Pyramid of Giza was built by King Tut.',
                'difficulty_level' => 'medium',
                'question_type' => 'true-false',
                'answers' => [
                    ['answer_text' => 'True', 'is_correct' => false],
                    ['answer_text' => 'False', 'is_correct' => true],
                ],
            ],
            [
                'category_id' => 5,
                'question_text' => 'What is the smallest prime number?',
                'difficulty_level' => 'easy',
                'question_type' => 'multiple-choice',
                'answers' => [
                    ['answer_text' => '1', 'is_correct' => false],
                    ['answer_text' => '2', 'is_correct' => true],
                    ['answer_text' => '3', 'is_correct' => false],
                    ['answer_text' => '5', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 6,
                'question_text' => 'Shakespeare wrote the novel "War and Peace".',
                'difficulty_level' => 'easy',
                'question_type' => 'true-false',
                'answers' => [
                    ['answer_text' => 'True', 'is_correct' => false],
                    ['answer_text' => 'False', 'is_correct' => true],
                ],
            ],
            [
                'category_id' => 7,
                'question_text' => 'What is the capital of Australia?',
                'difficulty_level' => 'medium',
                'question_type' => 'multiple-choice',
                'answers' => [
                    ['answer_text' => 'Sydney', 'is_correct' => false],
                    ['answer_text' => 'Melbourne', 'is_correct' => false],
                    ['answer_text' => 'Canberra', 'is_correct' => true],
                    ['answer_text' => 'Perth', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 8,
                'question_text' => 'In computer science, RAM stands for Random Access Memory.',
                'difficulty_level' => 'medium',
                'question_type' => 'true-false',
                'answers' => [
                    ['answer_text' => 'True', 'is_correct' => true],
                    ['answer_text' => 'False', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 9,
                'question_text' => 'The first man to step on the Moon was Neil Armstrong.',
                'difficulty_level' => 'easy',
                'question_type' => 'multiple-choice',
                'answers' => [
                    ['answer_text' => 'Buzz Aldrin', 'is_correct' => false],
                    ['answer_text' => 'Yuri Gagarin', 'is_correct' => false],
                    ['answer_text' => 'Neil Armstrong', 'is_correct' => true],
                    ['answer_text' => 'John Glenn', 'is_correct' => false],
                ],
            ],
            [
                'category_id' => 10,
                'question_text' => 'Photosynthesis occurs in animal cells.',
                'difficulty_level' => 'hard',
                'question_type' => 'true-false',
                'answers' => [
                    ['answer_text' => 'True', 'is_correct' => false],
                    ['answer_text' => 'False', 'is_correct' => true],
                ],
            ],
        ];

        foreach ($questions as $questionData) {
            $question = Question::create([
                'category_id' => $questionData['category_id'],
                'question_text' => $questionData['question_text'],
                'difficulty_level' => $questionData['difficulty_level'],
                'question_type' => $questionData['question_type'],
            ]);

            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'answer_text' => $answerData['answer_text'],
                    'is_correct' => $answerData['is_correct'],
                ]);
            }
        }
    }
}
