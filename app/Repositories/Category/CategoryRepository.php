<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepository
{
    public function create(array $data): Category;

    public function all(): Collection;

    public function findByName(string $name): Category;
}

