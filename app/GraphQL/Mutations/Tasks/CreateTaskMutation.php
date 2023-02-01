<?php

namespace App\GraphQL\Mutations\Tasks;

use App\Models\Task;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTask',
        'description' => 'Create a new task'
    ];
    public function type(): GraphQLType
    {
       return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'description' => [
                'name' => 'description',
                'type' => GraphQLType::string(),
                'rules' => ['max:255'],
            ],
            'state' => [
                'name' => 'state',
                'type' => GraphQLType::nonNull(GraphQLType::string()),
                'rules' => ['required','in:Todo,Done'],
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => GraphQLType::nonNull(GraphQLType::int()),
                'rules' => [
                    'exists:users,id',
                ]
            ],
            'project_id' => [
                'name' => 'project_id',
                'type' => GraphQLType::nonNull(GraphQLType::int()),
                'rules' => [
                    'exists:projects,id',
                ]
            ],
        ];
    }

    public function resolve($root, $args): Task
    {
        $task = new Task();
        $task->description = $args['description'];
        $task->state = $args['state'];
        $task->project_id = $args['project_id'];
        $task->user_id = $args['user_id'];
        $task->save();

        return $task;
    }
}
