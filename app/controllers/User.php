<?php

namespace app\controllers;

class User{
    
    public function show($params){
        if(!isset($params['user'])){
            redirect("/");  
        }

        $user = findBy("users", "id", "*", $params['user']);

        var_dump($user);
    }

    public function create(){

        return[
            'view' => 'create.php',
            'data' => ['title' => 'Create']
        ];
    }

    public function store(){
        $validate = validate([
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'email|unique:users',
            'password' => 'required|maxlen:10'
        ]);

        $validate['password'] = password_hash($validate['password'], PASSWORD_DEFAULT);

        if(!$validate){
            return redirect('/user/create');
        }

        $created = create('users', $validate);

        if(!$created){
            setFlash('message', "Ocorreu um erro ao cadastrar, tente novamente em alguns segundos");
            return redirect('/user/create');
        }

        return redirect('/');

    } 
}