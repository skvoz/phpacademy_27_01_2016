<?php

require __DIR__ . "/vendor/autoload.php";

$routing = new \testnamespace\Routing();

$routing->delegate($_SERVER['REQUEST_URI']);
