<?php


namespace testnamespace\controllers;

use testnamespace\models\User;
use testnamespace\Url;
use testnamespace\View;

class UserController
{
    public function actionIndex()
    {   

        $dataObj = User::find('all');

        if (isset($_REQUEST['save'])) {
            $name = $_REQUEST['user_name'];
            $description = $_REQUEST['description'];

            $user = new User();
            $user->user_name = $name;
            $user->description = $description;
            $user->save();

            header('location: ' . Url::to(['/user/index']));
        }

        echo View::render('user/index', [
            'dataObj' => $dataObj
        ]);
    }
}