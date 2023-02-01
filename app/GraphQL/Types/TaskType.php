<?php

namespace App\GraphQL\Types;

use App\Models\Task;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'Collection of tasks',
        'model' => Task::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the task',
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'The description of the task',
            ],
            'state' => [
                'type' => Type::string(),
                'description' => 'The state of task',
            ],
            'view_count' => [
                'type' => Type::int(),
                'description' => 'The view count of task',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created date of the Task',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the Task was last updated',
            ],
            'project' => [
                'type' => GraphQL::type('Project'),
                'description' => 'The Project that the task belongs to',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'The User that the task belongs to',
            ],
        ];
    }
}
