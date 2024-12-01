<?php 

namespace App\Core;

use InvalidArgumentException;

class Core
{
    private $url;

    public function __construct() {
        $url = '';
        $uri = $_SERVER['REQUEST_URI'];
        isset($uri) ? $url .= $uri : '';

        $urlRoute = explode('/', $url);
        isset($urlRoute[2]) ? $urlRoute[2] = '{id}' : '';
        $urlRoute = implode('/', $urlRoute);

        $this->url = $urlRoute;
    }

    public function run($routes) 
    {
        if(!array_key_exists($this->url, $routes)) {
            throw new InvalidArgumentException ("Rota {$this->url} não encontrada");
        }

        foreach($routes as $route => $controller) {
            $pattern = '#^'.preg_replace('/{id}/', '(\w+)', $route).'$#';
            
            if(preg_match($pattern, $this->url, $matches)) {
                array_shift($matches);
                [$currentController, $action] = explode('@', $controller);
    
                require_once __DIR__ . "/../controller/$currentController.php";
                
                $controllerNamespace = "App\Controller\\$currentController";
                $controllerInstance = new $controllerNamespace();
                $controllerInstance->$action($matches);
            }
        }
    }

}