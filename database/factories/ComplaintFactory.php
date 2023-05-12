<?php

namespace Database\Factories;

use App\Models\Pasta;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->sentence(),
            'user_id' => User::get()->random()->id,
            'pasta_id' => Pasta::get()->random()->id
        ];
    }
}
