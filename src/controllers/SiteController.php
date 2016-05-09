<?php


namespace testnamespace\controllers;


use PDO;
use testnamespace\View;

class SiteController
{
    public function actionIndex()
    {
        echo 'we in controller';
        die;

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

        echo View::render('sdfasdf', [
            'data' => $data
        ]);
    }
}