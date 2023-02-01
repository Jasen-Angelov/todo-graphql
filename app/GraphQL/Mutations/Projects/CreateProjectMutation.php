<?php

namespace App\GraphQL\Mutations\Projects;

use App\Models\Project;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createProject',
        'description' => 'Create a new project'
    ];
    public function type(): GraphQLType
    {
        return GraphQL::type('Project');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => GraphQLType::nonNull(GraphQLType::string()),
                'rules' => [
                    'required',
                    'string',
                    'max:255',
                ],
            ],
            'user_id' => [
                'name' => 'user_id',
                'type' => GraphQLType::nonNull(GraphQLType::int()),
                'rules' => [
                    'required',
                    'integer',
                    'exists:users,id',
                ],
            ],
        ];
    }

    public function resolve($root, $args): Project
    {
        $project              = new Project();
        $project->name        = $args['name'];
        $project->user_id     = $args['user_id'];
        $project->save();

        return $project;
    }
}
