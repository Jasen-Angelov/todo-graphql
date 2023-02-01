<?php

namespace App\GraphQL\Mutations\Projects;

use App\Models\Project;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Mutation;

class DeleteProjectMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteProject',
        'description' => 'Delete a project'
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
                    'exists:projects,id',
                ],
            ],
        ];
    }

    public function resolve($root, $args): bool
    {
        $project = Project::find($args['id']);
        if ($project) {
            $project->delete();

            return true;
        }

        return false;
    }
}
