<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'History'
            ],
            [
                'category_name' => 'Science and Nature'
            ],
            [
                'category_name' => 'Pop Culture'
            ],
            [
                'category_name' => 'Geography'
            ],
            [
                'category_name' => 'Literature'
            ],
            [
                'category_name' => 'Sports'
            ],
            [
                'category_name' => 'Food and Drink'
            ],
            [
                'category_name' => 'Technology'
            ],
            [
                'category_name' => 'Mythology'
            ],
            [
                'category_name' => 'General Knowledge'
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create([
                'category_name' => $categoryData['category_name'],
            ]);
        }
    }
}
