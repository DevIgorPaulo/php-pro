<?php

function redirect($to){
    return header("Location: $to");
    exit;
}

function setMessageAndRedirect($message, $index, $to){
    setFlash($index, $message);
    return redirect($to);
}