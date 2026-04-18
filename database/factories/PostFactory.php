<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    $title = fake()->sentence(rand(8, 15));

    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'body' => fake()->text(),

        'author_id' => function () {
            return \App\Models\User::where('role', 'user')->inRandomOrder()->first()->id;
        },

        'category_id' => Category::query()->inRandomOrder()->first()?->id,
    ];
}

}
