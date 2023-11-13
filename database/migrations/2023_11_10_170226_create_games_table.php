<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\GameStatus;
use App\Enums\GameMode;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [
                GameStatus::IN_PROGRESS->value,
                GameStatus::CANCELED->value,
                GameStatus::COMPLETED->value,
            ]);
            $table->enum('game_mode', [
                GameMode::SINGLE_PLAYER->value,
                GameMode::MULTIPLAYER->value,
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
