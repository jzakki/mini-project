<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function answers()
    {
        return $this->hasMany(PlayerAnswer::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class)->using(PlayerGame::class);
    }
}
