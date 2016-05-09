<?php

require __DIR__ . "/vendor/autoload.php";

/** @var PDO $db */

$routing = new \testnamespace\Routing();

$routing->delegate($_SERVER['REQUEST_URI']);


//include __DIR__ . "/src/views/index.php";
