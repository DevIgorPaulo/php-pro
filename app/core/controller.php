<?php

function controller($matchedUri, $params){
    
    [$controller, $method] = explode('@', array_values($matchedUri)[0]);

    $controllerWithNamespance = CONTROLLER_PATH.$controller;

    if(!class_exists($controllerWithNamespance)){
        throw new Exception("Controller $controller não existe");
    }

    $controllerInstance = new $controllerWithNamespance;
    
    if(!method_exists($controllerInstance, $method)){
        throw new Exception("Método $method não existe no controller $controller");
    }

    $controllerInstance->$method($params);
}