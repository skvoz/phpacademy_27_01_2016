<?php
session_start();
ob_start();
require_once 'include/config.inc.php';
require_once 'include/function.inc.php';
/**********************************************/
$db = new db(DBHOST, DBUSER, DBPASS, DBBASE);
$login = new login($db);
/********************************************/
function __autoload($name)
{
    require "include/class/{$name}.class.php";
}
if (isset($_SESSION['login'])) {
    $user_priv = $login->priv($_SESSION['login']);
    include 'template/main.php';
} elseif (!isset($_SESSION['login'])) {
    if (isset($_GET['login'])) {
        include 'template/login.php';
        if (isset($_POST['login']) AND isset($_POST['password'])) {
            if ($login->getPass($_POST['login'], $_POST['password'])) {
                $_SESSION['login'] = $_POST['login'];
                header("Location: /");
            } else {
                echo "Логин / Пароль неверный";
            }
        }
    } else if (isset($_GET['registrate'])) {
        include 'template/registrate.php';
    } else {
        header("Location: /?login");
    }
}

if(isset($_POST['edit'])){
    $ubdate_db = new change_db($db);
    if(isset($_POST['id'])){
        var_dump($_POST);
        /******************/
        $ubdate_db->update($_POST['id'],$_POST['name'],$_POST['description'],$_POST['price'],$_POST['is_active'],
            $_POST['vendor']);
        header("Location: /");
    }else{
        $ubdate_db->insert($_POST['name'],$_POST['description'],$_POST['price'],$_POST['is_active'],
            $_POST['vendor']);
        header("Location: /");
    }
}

if(isset($_POST['registrate'])){
    $reg = new registrate($db);
    if($reg->check($_POST['login'])){
        if($reg->add_user($_POST['login'],$_POST['password'])){
            $_SESSION['login'] = $_POST['login'];
            header("Location: /");
        }
    }else{
        echo "Такая запись уже есть";
    }
}

if(isset($_GET['clear_form'])){
    header("Location: /");
}
if (isset($_GET['logout']) AND $_SESSION['login']) {
    unset($_SESSION['login']);
    session_destroy();
    header("Location: /");
}

unset($db);
/****************************************/

?>