<?php

session_start();
include_once('config.inc.php');
print_doctype('DB-Edit');

if((!isset($_SESSION['user'])) || ($_SESSION['user'] != "logged")){
    login();
}

if ($_POST){
    db_change_products($_POST);
}
echo '<a href="' . HOME_ROOT . '/logout.php">Logout</a>';

print_DB();
add_product_form();

body_end();

