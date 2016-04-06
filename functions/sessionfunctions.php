<?php

function login($msg = ''){
    header("Location: " . HOME_ROOT . "/login.php" . $msg);
}

function login_correct($post){
    session_start();
    $_SESSION['user'] = 'logged';
    $_SESSION['role'] = db_get_user_role($post);
    header("Location: " . HOME_ROOT . "/index.php?role=" . db_get_user_role($post));
}

function logout(){
    session_start();
    session_destroy();
    header("Location: " . HOME_ROOT . "/login.php");
}

function check_session($session){
    if ((isset($session['user'])) && ($session['user'] == 'logged')){
        header("Location: " . HOME_ROOT . "/index.php");
    }
}

function create_session(){
    $_SESSION['user'] = 'logged';
    header("Location: " . HOME_ROOT . "/index.php");
}