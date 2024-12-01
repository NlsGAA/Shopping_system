<?php 

namespace App\Controller;

use League\Plates\Engine;

abstract class BaseController 
{
    public static function view(string $view, array $data = [])
    {
        $viewPath = __DIR__ . '/../view/';
        $template = new Engine($viewPath);
        echo $template->render($view, $data);
    }
}