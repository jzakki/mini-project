<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\QuestionType;
use App\Enums\DifficultyLevel;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('question_text');
            $table->enum('difficulty_level', [
                DifficultyLevel::EASY->value,
                DifficultyLevel::MEDIUM->value,
                DifficultyLevel::HARD->value
            ]);
            $table->enum('question_type', [
                QuestionType::MULTIPLE_CHOICE->value,
                QuestionType::TRUE_FALSE->value
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
