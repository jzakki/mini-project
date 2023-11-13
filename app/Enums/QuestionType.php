<?php

namespace App\Enums;

enum QuestionType: string
{
    case MULTIPLE_CHOICE = 'multiple-choice';
    case TRUE_FALSE = 'true-false';
}
