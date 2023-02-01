<?php

namespace App\GraphQL\Mutations\Tasks;

use App\Models\Task;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateTaskMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTask',
        'description' => 'Update a task'
    ];
    public function type(): GraphQLType
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => GraphQLType::int(),
                'rules' => [
                    'required',
                    'integer',
                    'min:1',
                ],
            ],
            'description' => [
                'name' => 'description',
                'type' => GraphQLType::string(),
                'rules' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
            ],
            'state' => [
                'name' => 'state',
                'type' => GraphQLType::string(),
                'rules' => [
                    'required',
                    'string',
                    'in:Todo,Done',
                ],
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => GraphQLType::int(),
                'rules' => [
                    'required',
                    'integer',
                    'min:1',
                    'exists:users,id',
                ],
            ],
            'project_id' => [
                'name' => 'project_id',
                'type' => GraphQLType::int(),
                'rules' => [
                    'required',
                    'integer',
                    'min:1',
                    'exists:projects,id',
                ],
            ],
        ];
    }

    public function resolve($root, $args): Task
    {
        $task = Task::find($args['id']);
        $task->description = $args['description'];
        $task->state = $args['state'];
        $task->user_id = $args['user_id'];
        $task->project_id = $args['project_id'];
        $task->save();

        return $task;
    }
}
