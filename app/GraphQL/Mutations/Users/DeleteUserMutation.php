<?php

namespace App\GraphQL\Mutations\Users;

use App\Models\User;
use GraphQL\Type\Definition\Type as GraphQLType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rebing\GraphQL\Support\Mutation;

class DeleteUserMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deleteUser',
        'description' => 'Delete a user'
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
                    'exists:users,id',
                ],
            ],
        ];
    }

    public function resolve($root, $args): bool|ModelNotFoundException
    {
        return User::findOrFail($args['id'])->delete();
    }
}
