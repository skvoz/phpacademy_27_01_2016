<?php

session_start();
include_once('config.inc.php');
print_doctype('registrate');

check_session($_SESSION);

if($_POST){
    $row = db_try_login($_POST);
    if($row){        
        login('?registrate=ok');
    } else {
        db_change_users($_POST);
        create_session();
    }
}

print_registration();
body_end();