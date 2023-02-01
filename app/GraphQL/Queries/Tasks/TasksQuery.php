<?php

namespace App\GraphQL\Queries\Tasks;

use App\Models\Task;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
class TasksQuery extends Query
{
    protected $attributes = [
        'name' => 'tasks',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Task'));
    }

    public function resolve($root, $args): Collection
    {
        return Task::all();
    }

}
