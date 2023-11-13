<?php

namespace App\Services\ScoringStrategy;

use App\Enums\ScoringStrategy;

abstract class ScoringFactory
{
    public static function create($type):Scoring {
        switch ($type) {
            case ScoringStrategy::Basic->value:
                return new BasicScoring();
            default:
                throw new \InvalidArgumentException("Invalid scoring strategy");
        }
    }
}
