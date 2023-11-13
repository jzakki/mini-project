<?php

namespace App\Services\ScoringStrategy;

interface Scoring
{
    public function calculateScore($answers);
}
