<?php

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../routes/router.php';

try {
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    $method = $_SERVER['REQUEST_METHOD'];
    
    if(!isset($routes[$method])) {
        throw new \Exception("Método {$method} não permitido", 405);
    }
    if (!array_key_exists($uri, $routes[$method])) {
        throw new \Exception("Rota {$uri} não encontrada", 404);
    }
    
    $controller = $routes[$method][$uri];
    $controller();
} catch (\Exception $e) {
    $e->getMessage();
}