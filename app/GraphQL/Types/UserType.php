<?php

namespace App\GraphQL\Types;

use App\Models\User;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'Collection of users',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the user',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of user',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of user',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created at of user',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated at of user',
            ],
            'projects' => [
                'type' => Type::listOf(GraphQL::type('Project')),
                'description' => 'The projects of the user',
            ],
            'tasks' => [
                'type' => Type::listOf(GraphQL::type('Task')),
                'description' => 'The tasks of the user',
            ],
        ];
    }
}
