<?php
use App\Core\Router;

return [
    '/' => ['App\Controllers\HomeController', 'index'],

    // tasks
    '/tasks' => ['App\Controllers\TaskController', 'index'],
    '/tasks/show' => ['App\Controllers\TaskController', 'show'],
    '/tasks/create' => ['App\Controllers\TaskController', 'create'],
    '/tasks/edit' => ['App\Controllers\TaskController', 'edit'],
    '/tasks/update' => ['App\Controllers\TaskController', 'update'],
    '/tasks/delete' => ['App\Controllers\TaskController', 'delete'],
    '/tasks/toggle' => ['App\Controllers\TaskController', 'toggle'],
];
