<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Post;

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
