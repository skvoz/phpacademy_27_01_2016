<?php

function login($msg = ''){
    redirect('login', $msg);    
}

function login_correct($post){
    session_start();
    $_SESSION['user'] = 'logged';
    $_SESSION['role'] = db_get_user_role($post);
    redirect('index', '?role=' . db_get_user_role($post));    
}

function logout(){
    session_start();
    session_destroy();
    redirect('login');
}

function check_session($session){
    if ((isset($session['user'])) && ($session['user'] == 'logged')){
        redirect();
    }
}

function create_session(){
    $_SESSION['user'] = 'logged';
    redirect();
}

function redirect($path = 'index', $get = ''){
    $redirect = HOME_ROOT . "/{$path}.php" . $get;    
    header("Location: " . $redirect);
}