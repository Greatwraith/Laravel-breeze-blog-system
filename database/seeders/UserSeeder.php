<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'ardhanthend@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('adminweb123'),
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ]);

        // Your personal user account
        User::factory()->create([
            'name' => 'Muhammad Ardhan Rahman',
            'username' => 'ardhan',
            'email' => 'm.ardhanrahman@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ardhan123'), // your password
            'remember_token' => Str::random(10),
            'role' => 'user',
        ]);

        // Normal users
        $normalUsers = User::factory(3)->create([
            'role' => 'user',
        ]);

        // Assign posts only to normal users (including your personal account)
        $allNormalUsers = User::where('role', 'user')->get();
        foreach ($allNormalUsers as $user) {
            Post::factory(rand(1, 3))->create([
                'author_id' => $user->id
            ]);
        }
    }
}
