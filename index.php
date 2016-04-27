<?php

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


include __DIR__ . "/src/views/index.php";

?>

<?php
/**
 * @param $tpl
 * @param $arrayEnv
 * @return mixed
 */
//function render($tpl, $arr)
//{
//    $templatePath = sprintf('views/%s.te', $tpl);
//    ob_start();
//    extract($arr);
//    include_once $templatePath;
//    $res = ob_get_contents();
//    ob_end_clean();
//    return $res;
//}
//
//
//var_dump($_SERVER['REQUEST_URI']);
//echo render('main', [
//    'foo' => $foo,
//    'bar' => $bar
//]);