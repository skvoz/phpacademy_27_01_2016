<?php

include_once('config.inc.php');
print_doctype('login');

if (isset($_GET['registrate']) && ($_GET['registrate'] == 'ok')){
    echo '<h2>Такой юзер уже зареган!</h2>';
}

if($_POST){
    $row = db_try_logopass($_POST);
    if($row){        
        login_correct($_POST);
    } else {
        echo '<h2>Имя юзера или пароль неправильный!</h2>';
    }
}

print_login();

body_end();