<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class EloquentCategoryRepository implements CategoryRepository
{
    /**
     * Create a new category.
     *
     * @param array $data
     * @return \App\Models\Category
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Return all categories
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Category::all();
    }

    /**
     * Return a category by name
     *
     * @return \App\Models\Category
     */
    public function findByName(string $name): Category
    {
        return Category::where('category_name', $name)->first();
    }
}
