<?php

namespace App\GraphQL\Queries\Projects;

use App\Models\Project;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
class ProjectsQuery extends Query
{
    protected $attributes = [
        'name' => 'projects',
    ];
    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Project'));
    }

    public function resolve($root, $args): Collection
    {
        return Project::all();
    }
}
