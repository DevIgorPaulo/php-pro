<?php 

function validate(array $validations){
    $result = [];
    $param = '';
    foreach ($validations as $field => $validate) {
        if(!str_contains($validate, '|')){
            $result[$field] = singleValidation($validate, $field, $param);
        }else{
            $result[$field] = multipleValidation($validate, $field, $param);
        }
    }

    if(in_array(false, $result)){
        return false;
    }
     
    return $result;
    
}

function singleValidation($validate, $field, $param){
    if(str_contains($validate, ':')){
        [$validate, $param] = explode(':', $validate);
    }

    return $validate($field, $param);
}

function multipleValidation($validate, $field, $param){

    $explodePipeValidate = explode('|', $validate);
    foreach ($explodePipeValidate as $validate) {
        if(str_contains($validate, ':')){
            [$validate, $param] = explode(':', $validate);
        }
        $result = $validate($field, $param);
    }

    return $result;
}

function required($field){
    if($_POST[$field] === ''){
        setFlash($field, 'O campo é obrigatorio');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_UNSAFE_RAW);
}

function email($field){
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    if(!$emailIsValid){
        setFlash($field, 'O campo tem que ser um email válido!');
        return false;
    }

    return filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL);
}

function unique($field, $param){
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL);
    $user = findBy($param, $field, "*", $data);

    if($user){
        setFlash($field, 'Esse valor ja esta cadastrado');
        return false;
    }

    return $data;

}

function maxlen($field, $param){
    $data = filter_input(INPUT_POST, $field, FILTER_SANITIZE_EMAIL);

    if(strlen($data) > $param){
        setFlash($field, "Esse campo não pode passar de $param");
        return false;
    }

    return $data;
}