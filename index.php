<?php

use testnamespace\View;

require __DIR__ . "/vendor/autoload.php";

/** @var PDO $db */

$user = 'root';

$password = 'root';

$driver = 'mysql:host=localhost;dbname=scotchbox;';

$db = new PDO($driver, $user, $password);

$sql = 'select * from user ORDER BY ID DESC limit 10 ';

$result = $db->query($sql);

$data = $result->fetchAll();

if (isset($_REQUEST['save'])) {
    $name = $_REQUEST['user_name'];
    $description = $_REQUEST['description'];
    $sql2 = sprintf('insert into `user` (user_name, description) VALUES ("%s","%s")',
        $name, $description );

    $db->query($sql2);
    header('location: /index.php');
}

echo View::render('index', [
    'data' => $data
]);
//include __DIR__ . "/src/views/index.php";
