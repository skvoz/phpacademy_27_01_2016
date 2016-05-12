<?php

require __DIR__ . "/vendor/autoload.php";

define('REL_URL', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));

$routing = new \testnamespace\Routing();

$routing->delegate($_SERVER['REQUEST_URI']);
