<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
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
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'image_path' => null,
            'excerpt' => $this->faker->paragraph(2),
            'content' => $this->faker->paragraphs(5, true),
            'is_published' => $this->faker->boolean(60), // 60% chance of being published
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => \App\Models\User::all()->random()->id,
            'category_id' => \App\Models\Category::all()->random()->id,
        ];
    }
}
