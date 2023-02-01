<?php

namespace App\GraphQL\Mutations\Tasks;

use App\Models\Task;
use GraphQL\Type\Definition\Type as GraphQLType;

class DeleteTaskMutation extends \Rebing\GraphQL\Support\Mutation
{
    protected $attributes = [
        'name' => 'deleteTask',
        'description' => 'Delete a task'
    ];
    public function type(): GraphQLType
    {
        return GraphQLType::boolean();
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => GraphQLType::nonNull(GraphQLType::int()),
                'rules' => [
                    'required',
                    'integer',
                    'exists:tasks,id',
                ],
            ],
        ];
    }

    public function resolve($root, array $args): bool
    {
        $task = Task::find($args['id']);
        if ($task) {
            $task->delete();

            return true;
        }

        return false;
    }
}
