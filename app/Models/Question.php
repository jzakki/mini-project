<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'question_text',
        'difficulty_level',
        'question_type',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function playerAnswers()
    {
        return $this->hasMany(PlayerAnswer::class);
    }
}
