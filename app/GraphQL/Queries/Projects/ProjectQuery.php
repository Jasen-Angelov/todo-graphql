<?php

namespace App\GraphQL\Queries\Projects;

use App\Models\Project;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ProjectQuery extends Query
{

    public function type(): Type
    {
        return GraphQL::type('Project');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()),
                'rules' => [
                    'required',
                    'integer',
                    'exists:projects,id'
                ],
            ],
        ];
    }

    public function resolve($root, $args): Project|ModelNotFoundException
    {
        return Project::findOrFail($args['id']);
    }
}
