<?php

if (strpos(__DIR__, 'htdocs')){
    define('HOME_ROOT', str_replace('\\', '/', substr(__DIR__, strpos(__DIR__, 'htdocs') + strlen('htdocs'))) );
} elseif (strpos(dirname(__FILE__), '05-DB-edit-categories')) {
    define('HOME_ROOT', DIRECTORY_SEPARATOR . '05-DB-edit-categories');
} else {
    define('HOME_ROOT', '');
}

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBBASE', 'test8');

include_once('functions' . DIRECTORY_SEPARATOR . 'dbfunctions.php');
include_once('functions' . DIRECTORY_SEPARATOR . 'formsfunctions.php');
include_once('functions' . DIRECTORY_SEPARATOR . 'sessionfunctions.php');

