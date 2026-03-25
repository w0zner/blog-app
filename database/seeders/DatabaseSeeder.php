<?php

namespace Database\Seeders;

use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Rodrigo Ramirez',
            'email' => 'cesarrodrigoramirez@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        Category::factory(7)->create();

        Post::factory(50)->create();
    }
}
