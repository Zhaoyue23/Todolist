<?php

namespace App\Core;

class Router {
    public function dispatch($request, $route) {
        [$controllerClass, $method] = $route;

        $controller = new $controllerClass($request->twig, $request->pdo);
        return $controller->$method($request);
    }
}
