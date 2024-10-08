<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug,
            'title' => $this->faker->sentence(),
            'tagline' => $this->faker->sentence(),
            'image_name' => 'images/image.png',
            'learnings' => ['Learn A', 'Learn B', 'Learn C'],
            'description' => $this->faker->paragraph()
        ];
    }

    public function released(Carbon $date = null): self
    {
        return $this->state(
            fn($attributes) => ['released_at' => $date ?? Carbon::now()]
        );
    }
}
