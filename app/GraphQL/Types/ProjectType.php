<?php

namespace App\GraphQL\Types;

use App\Models\Project;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class ProjectType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Project',
        'description' => 'Collection of projects',
        'model' => Project::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the project',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of the project',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created date of the Project',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The date the Project was last updated',
            ],
            'user_id' => [
                'type' => Type::int(),
                'description' => 'The id of the user that the project belongs to',
            ],
            'tasks' => [
                'type' => Type::listOf(GraphQL::type('Task')),
                'description' => 'The tasks that belong to the project',
            ],
            'user' => [
                'type' => GraphQL::type('User'),
                'description' => 'The User that the project belongs to',
            ],
        ];
    }
}
