<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Technology',
            'Health',
            'Travel',
            'Food',
            'Lifestyle',
            'Education',
            'Finance',
            'Entertainment',
            'Sports',
            'Science',
        ];

        foreach ($categories as $categories_name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($categories_name)],
                ['name' => $categories_name]
            );
        }
    }
}
