<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_ids = User::all()->pluck('id')->toArray();
        return [
            'name'    => $this->faker->sentence,
            'user_id' => $this->faker->randomElement($user_ids),
        ];
    }
}
