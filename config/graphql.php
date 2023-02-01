<?php

declare(strict_types = 1);

use App\GraphQL\Mutations\Projects\CreateProjectMutation;
use App\GraphQL\Mutations\Projects\DeleteProjectMutation;
use App\GraphQL\Mutations\Projects\UpdateProjectMutation;
use App\GraphQL\Mutations\Tasks\CreateTaskMutation;
use App\GraphQL\Mutations\Tasks\DeleteTaskMutation;
use App\GraphQL\Mutations\Tasks\UpdateTaskMutation;
use App\GraphQL\Mutations\Users\CreateUserMutation;
use App\GraphQL\Mutations\Users\DeleteUserMutation;
use App\GraphQL\Mutations\Users\UpdateUserMutation;
use App\GraphQL\Queries\Projects\ProjectQuery;
use App\GraphQL\Queries\Projects\ProjectsQuery;
use App\GraphQL\Queries\Tasks\TaskQuery;
use App\GraphQL\Queries\Tasks\TasksQuery;
use App\GraphQL\Queries\Users\UserQuery;
use App\GraphQL\Queries\Users\UsersQuery;
use App\GraphQL\Types\ProjectType;
use App\GraphQL\Types\TaskType;
use App\GraphQL\Types\UserType;

return [
    'route' => [
        'prefix' => 'graphql',

        'controller' => \Rebing\GraphQL\GraphQLController::class . '@query',

        'middleware' => [],

        'group_attributes' => [],
    ],

    'default_schema' => 'default',

    'batching' => [
        'enable' => true,
    ],

    'schemas' => [
        'default' => [
            'query' => [
               'task'     => TaskQuery::class,
               'tasks'    => TasksQuery::class,
               'project'  => ProjectQuery::class,
               'projects' => ProjectsQuery::class,
               'user'     => UserQuery::class,
               'users'    => UsersQuery::class,
            ],
            'mutation' => [
                'createTask'    => CreateTaskMutation::class,
                'updateTask'    => UpdateTaskMutation::class,
                'deleteTask'    => DeleteTaskMutation::class,
                'createProject' => CreateProjectMutation::class,
                'updateProject' => UpdateProjectMutation::class,
                'deleteProject' => DeleteProjectMutation::class,
                'createUser'    => CreateUserMutation::class,
                'updateUser'    => UpdateUserMutation::class,
                'deleteUser'    => DeleteUserMutation::class,
            ],

            'types' => [
                'User'    => UserType::class,
                'Task'    => TaskType::class,
                'Project' => ProjectType::class,
            ],

            'middleware' => null,

            'method' => ['GET', 'POST'],

            'execution_middleware' => null,
        ],
    ],

    'types' => [
    ],

    'lazyload_types' => true,

    'error_formatter' => [\Rebing\GraphQL\GraphQL::class, 'formatError'],

    'errors_handler' => [\Rebing\GraphQL\GraphQL::class, 'handleErrors'],

    'security' => [
        'query_max_complexity' => null,
        'query_max_depth' => null,
        'disable_introspection' => false,
    ],

    'pagination_type' => \Rebing\GraphQL\Support\PaginationType::class,

    'simple_pagination_type' => \Rebing\GraphQL\Support\SimplePaginationType::class,

    'graphiql' => [
        'prefix' => 'graphiql', // Do NOT use a leading slash
        'controller' => \Rebing\GraphQL\GraphQLController::class . '@graphiql',
        'middleware' => [],
        'view' => 'graphql::graphiql',
        'display' => env('ENABLE_GRAPHIQL', true),
    ],

    'defaultFieldResolver' => null,

    'headers' => [],

    'json_encoding_options' => 0,

    'apq' => [
        'enable' => env('GRAPHQL_APQ_ENABLE', false),

        'cache_driver' => env('GRAPHQL_APQ_CACHE_DRIVER', config('cache.default')),

        'cache_prefix' => config('cache.prefix') . ':graphql.apq',

        'cache_ttl' => 300,
    ],

    'execution_middleware' => [
    ],
];
