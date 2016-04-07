<?php
session_start();

function my_autoloader($class) {
    include __DIR__. '/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');

//костылики (нужно доделать)
require_once __DIR__ . '/libs.php';