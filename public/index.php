<?php

require __DIR__ . '/../bootstrap/app.php';

use App\Core\Request;
use App\Core\Router;

$request = new Request($_GET, $_POST, $twig, $pdo);

$routes = require __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (isset($routes[$uri])) {
    $router = new Router();
    echo $router->dispatch($request, $routes[$uri]);
} else {
    http_response_code(404);
    echo "404 Not Found";
}
