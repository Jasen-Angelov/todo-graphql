<?php

namespace App\GraphQL\Mutations\Users;

use App\Models\User;
use GraphQL\Type\Definition\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class CreateUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createUser',
        'description' => 'Create a new user'
    ];
    public function type(): GraphQLType
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name',
                'type' => GraphQLType::nonNull(GraphQLType::string()),
                'rules' => [
                    'required',
                    'max:255',
                ],
            ],
            'email' => [
                'name' => 'email',
                'type' => GraphQLType::nonNull(GraphQLType::string()),
                'rules' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],
            ],
            'password' => [
                'name' => 'password',
                'type' => GraphQLType::nonNull(GraphQLType::string()),
                'rules' => [
                    'required',
                    'min:6',
                    'max:255',
                ],
            ],
        ];
    }

    public function resolve($root, $args): User
    {
        $user = new User();
        $user->name = $args['name'];
        $user->email = $args['email'];
        $user->password = bcrypt($args['password']);
        $user->save();

        return $user;
    }
}
