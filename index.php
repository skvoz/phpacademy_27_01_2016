<?php

define('ROOT', dirname(__FILE__));

define('REL_URL', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));

require __DIR__ . "/vendor/autoload.php";

require __DIR__ . '/src/config/config.php';

$routing = new \testnamespace\Routing();

$routing->delegate($_SERVER['REQUEST_URI']);
