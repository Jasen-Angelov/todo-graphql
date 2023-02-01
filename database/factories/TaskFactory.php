<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Task::class;
    public function definition()
    {
        $project_ids = Project::all()->pluck('id')->toArray();
        $user_ids    = User::all()->pluck('id')->toArray();
        return [
            'description' => $this->faker->sentence,
            'state' => $this->faker->randomElement(['Todo', 'Done']),
            'project_id' => $this->faker->randomElement($project_ids),
            'user_id' => $this->faker->randomElement($user_ids),
            'view_count' => 0,
        ];
    }
}
