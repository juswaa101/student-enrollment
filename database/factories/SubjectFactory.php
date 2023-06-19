<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Haruncpi\LaravelIdGenerator\IdGenerator;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->numberBetween(1, 50),
            'title' => fake()->text(20),
            'description' => fake()->paragraph()
        ];
    }
}
