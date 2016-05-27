<?php
session_start();

use testnamespace\Routing;

require __DIR__ . "/vendor/autoload.php";

$routing = new Routing();

$routing->delegate($_SERVER['REQUEST_URI']);
