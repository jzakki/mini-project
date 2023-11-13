<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'game_mode',
    ];

    public function players()
    {
        return $this->belongsToMany(Player::class)->using(PlayerGame::class);
    }

    public function playerAnswers()
    {
        return $this->hasManyThrough(PlayerAnswer::class, Player::class);
    }
}
