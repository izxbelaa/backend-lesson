<?php

namespace Database\Factories;

use App\Models\Matter;
use app\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Matter>
 */
class MatterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement([Status::OPEN, Status::CLOSED, Status::PENDING]),
        ];
    }
}
