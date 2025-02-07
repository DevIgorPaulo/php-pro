<?php

require 'bootstrap.php';

try {
    $data = router();

    if(!isset($data['data'])){
       throw new Exception("O indice data está faltando");
    }
    
    if(!isset($data['data']['title'])){
        throw new Exception("O indice title está faltando");
    }

    if(!isset($data['view'])){
        throw new Exception("View não encontrada");
    }

    if(!file_exists(VIEWS.$data['view'])){
        throw new Exception("View {$data['view']} não existe ");
    }

    extract($data['data']);

    $view = $data['view'];

    require VIEWS.'master.php';
} catch (Exception $e) {
    echo $e->getMessage();
}