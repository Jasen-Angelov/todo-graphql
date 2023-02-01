<?php

namespace App\GraphQL\Mutations\Projects;

use App\Models\Project;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type as GraphQLType;

class UpdateProjectMutation extends Mutation
{
    protected $attributes = [
        'name'        => 'updateProject',
        'description' => 'Update a project'
    ];
    public function type(): GraphQLType
    {
        return GraphQL::type('Project');
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
                    'exists:projects,id',
                ],
            ],
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

    public function resolve($root, $args): Project|ModelNotFoundException
    {
        $project = Project::findOrFail($args['id']);
        $project->name = $args['name'];
        $project->user_id = $args['user_id'];
        $project->save();

        return $project;
    }
}
