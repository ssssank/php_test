<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    TaskStatus,
    User
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => fake()->words(2, true),
            'description' => fake()->sentence(),
            'status_id' => TaskStatus::factory()->create()->id,
            'created_by_id' => User::factory()->create()->id,
            'assigned_to_id' => User::factory()->create()->id
        ];
    }
}
