Todolist (PHP + Twig) menggunakan struktur MVC, Todolist dengan fitur CRUD (Create, Read, Update, Delete) dan menambahkan Fitur pencarian berdasarkan input dan status (pending, completed, all)

Requirements
- PHP 8.1+  
- Composer

Quick start

1. Install dependencies
composer install

2. Configure DB (see) 
bootstrap/database.php

3. Run built-in server 
php -S localhost:8000 -t public

Structure (important files)

- Front controller: public/index.php
- Routes: routes/web.php
- Bootstrap: bootstrap/app.php,bootstrap/database.php

MVC

- Controllers: App\Controllers\HomeController, App\Controllers\TaskController — app/Controllers/
- Core: App\Core\Router, App\Core\Request, App\Core\BaseController — app/Core/
- Models / Repos / Services: App\Models\TaskModel, App\Repositories\TaskRepository, App\Services\TaskService — app/Models/, app/Repositories/, app/Services/
- Views (Twig): app/views/layout.twig and app/views/tasks/

Development notes

- Templates menggunakan Twig (vendor: twig/twig). See vendor/twig/twig/src/Environment.php for configuration hooks.
- Add routes in routes/web.php. The router implementation is in app/Core/Router.php.
- DB migrations / seeds: none included — use bootstrap/database.php for connection.

License & credits

- Project dependencies managed by Composer. See composer.json and vendor/composer/installed.json.