<?php

function all($fields = '*', $table){
    try {
        $connect = connect();

        $query = $connect->query("SELECT $fields FROM $table");

        return $query->fetchAll();
    } catch (PDOException $e) {
        var_dump($e);
    }
}

function findBy($table, $field, $fields = '*', $value){
    try {
        $connect = connect();
        $prepare = $connect->prepare("SELECT $fields FROM $table WHERE $field = :$field");
        $prepare->execute([$field => $value]);

        return $prepare->fetch();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}