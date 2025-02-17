<?php

function exactMatchUri($uri, $routes){
    return (array_key_exists($uri, $routes)) ? [$uri => $routes[$uri]] : [];
}

function dynamicMatchUri($uri, $routes){
    return array_filter(
        $routes, 
        function($value) use ($uri){
            $regex = str_replace('/', '\/', ltrim($value, '/'));
            return preg_match("/^$regex$/", ltrim($uri, '/'));
        }, ARRAY_FILTER_USE_KEY
    );
}

function params($uri, $matchedUri){
    if(!empty($matchedUri)){
        return array_diff(
            $uri,
            explode('/', ltrim(array_keys($matchedUri)[0], '/'))
        );
    }

    return [];
}

function paramsFormat($uri, $params){
    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index - 1]] = $param;
    }

    return $paramsData;
}

function router(){
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $routes = require 'routes.php';

    $requestMethod = $_SERVER['REQUEST_METHOD'];
    
    $matchedUri = exactMatchUri($uri, $routes[$requestMethod]);


    $params = [];

    if(empty($matchedUri)){
        $matchedUri = dynamicMatchUri($uri, $routes[$requestMethod]);

        $uri = explode('/', ltrim($uri, '/'));

        $params = params($uri, $matchedUri);
        $params = paramsFormat($uri, $params);
 
    }

    if(!empty($matchedUri)){
        return controller($matchedUri, $params);
    }

    throw new Exception('Algo deu errado');
}