## About this project

This is a simple project to demonstrate how to use Laravel for the purpose of creating a simple GraphQL API. That will handle creation of To-do tasks, that are to be attached to a user and a project.
The GraphQL API is supporting the following queries and mutations:

- Query: `user(id: ID! email: String password: String projects: [ProjectInput] tasks: [TaskInput])`
- Query: `users`
- Query: `project(id: ID! name: String userId: ID tasks: [TaskInput] user: UserInput)`
- Query: `projects`
- Query: `task(id: ID! name: String projectId: ID userId: ID status: String project: ProjectInput user: UserInput view_count: Int)`
- Query: `tasks`
- Mutation: `createUser(name: String! email: String! password: String!)`
- Mutation: `updateUser(id: ID!, name: String, email: String, password: String)`
- Mutation: `deleteUser(id: ID!)`
- Mutation: `createProject(name: String!, userId: ID!)`
- Mutation: `updateProject(id: ID!, name: String, userId: ID)`
- Mutation: `deleteProject(id: ID!)`
- Mutation: `createTask(name: String!, projectId: ID! userId: ID! status: String!)`
- Mutation: `updateTask(id: ID!, name: String, projectId: ID, userId: ID, status: String)`
- Mutation: `deleteTask(id: ID!)`

## Installation

Requirements: Docker

- Clone the repository
- Run `php artisan sail:install`

## Usage

- Run `./vendor/bin/sail up -d`
- Run `bash vendor/bin/sail artisan migrate`
- Run `bash vendor/bin/sail artisan db:seed`

Open your browser and go to `http://localhost/graphql` to access the GraphQL Playground.
