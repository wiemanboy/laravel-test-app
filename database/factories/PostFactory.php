<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Webmozart\Assert\Tests\StaticAnalysis\lengthBetween;

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
        return [
            'caption' => fake()->sentence(),
            'message' => fake()->paragraph(10),
            'is_private' => fake()->boolean(),
            'status' => fake()->randomElement(['active', 'inactive', 'archived']),
        ];
    }
}
