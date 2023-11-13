<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    private CategoryRepository $categoryRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
    ){
        $this->categoryRepository = $categoryRepository;
    }
    public function getAllCategories(): array{
        return $this->categoryRepository->all()->pluck('category_name')->toArray();
    }

    public function findByName(string $name): Category{
        return $this->categoryRepository->findByName($name);
    }
}
