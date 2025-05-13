<?php

declare(strict_types=1);

return [
    'roles' => [
        'module' => 'Role',
        'title' => 'Roles',
        'title_create' => 'Create role',
        'title_edit' => 'Edit role',
        'title_delete' => 'Delete role',
        'delete_confirmation_title' => 'Are you sure you want to delete this role?',
        'delete_confirmation_description' => 'Make sure that the role to delete is not associated to any user, it will be permanently deleted.',
        'breadcrumb' => 'Roles',
        'id' => 'Id',
        'name' => 'Name',
        'actions' => 'Actions',
    ],
    'users' => [
        'module' => 'User',
        'title' => 'Users',
        'title_create' => 'Create user',
        'title_edit' => 'Edit user',
        'title_delete' => 'Delete user',
        'delete_confirmation_title' => 'Are you sure you want to delete this user?',
        'delete_confirmation_description' => 'Once this user is deleted, all of its resources and data will also be permanently deleted.',
        'breadcrumb' => 'Users',
        'id' => 'Id',
        'name' => 'Name',
        'email' => 'Email address',
        'role' => 'Role',
        'select_role' => 'Select a rol',
        'password' => 'Password',
        'password_confirmation' => 'Confirm password',
        'actions' => 'Actions',
    ],
];
