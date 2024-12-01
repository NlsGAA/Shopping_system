<?php 

namespace App\Service;

abstract class BaseService
{
    public function __invoke(array $params)
    {
        $paramsValidated = [];
        foreach ($params as $key => $value) {
            $paramsValidated[$key] = filter_input(INPUT_POST, $key);
        }
        return $paramsValidated;
    }
}