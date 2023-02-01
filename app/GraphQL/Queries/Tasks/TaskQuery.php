<?php

namespace App\GraphQL\Queries\Tasks;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
class TaskQuery extends Query
{
    protected $attributes = [
        'name' => 'task',
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required', 'integer', 'exists:tasks,id'],
            ],
        ];
    }

    public function resolve($root, $args): Task|ModelNotFoundException
    {
        $task = Task::findOrFail($args['id']);
        if ($task) {
            $task->view_count = $task->view_count + 1;
            $task->save();

            return $task;
        }
    }

}
