<?php
namespace app\controllers;

class Login{
    public function index(){
        return [
            'view' => 'login.php',
            'data' => ['title' => 'Login'],
        ];
    }

    public function store(){
        $email    = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

        if(empty($email) || empty($password)){
            return setMessageAndRedirect('Usuário ou senha estão incorretos','message', '/login');             
        }

        $user = findBy('users', 'email', "*", $email);
        
        if(!$user){
            return setMessageAndRedirect('Usuário ou senha estão incorretos','message', '/login');             

        }
        if(!password_verify($password, $user->password)){
            return setMessageAndRedirect('Usuário ou senha estão incorretos','message', '/login');             
        }

        $_SESSION[LOGGED] = $user;

        return redirect('/');
    }

    public function destroy(){
        unset($_SESSION[LOGGED]);
        return redirect('/login');
    }
}