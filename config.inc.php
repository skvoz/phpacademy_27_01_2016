<?php

define('HOME_ROOT', str_replace('\\', '/', substr(__DIR__, strpos(__DIR__, 'htdocs') + strlen('htdocs'))));

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBBASE', 'test8');

include_once('functions\dbfunctions.php');
include_once('functions\formsfunctions.php');
include_once('functions\sessionfunctions.php');

