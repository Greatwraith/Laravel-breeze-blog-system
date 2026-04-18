<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        fake()->unique(true);


        $this->call([CategorySeeder::class, UserSeeder::class, PostSeeder::class]); 

 
    }
}
