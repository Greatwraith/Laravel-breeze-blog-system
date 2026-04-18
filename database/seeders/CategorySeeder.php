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

       $colors = [
    'bg-blue-100 text-gray-600',
    'bg-red-100 text-gray-600',
    'bg-green-100 text-gray-600',
    'bg-yellow-100 text-gray-600',
    'bg-purple-100 text-gray-600',
    'bg-pink-100 text-gray-600',
    'bg-indigo-100 text-gray-600',
    'bg-gray-100 text-gray-600',
    'bg-teal-100 text-gray-600',
    'bg-orange-100 text-gray-600',
];


        foreach ($categories as $index => $name) {
            Category::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'color' => $colors[array_rand($colors)]]
            );
        }
    }
}
