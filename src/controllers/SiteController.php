<?php


namespace testnamespace\controllers;

use testnamespace\Application;
use testnamespace\models\UserModel;

class SiteController
{
    public function actionIndex()
    {
        $userModel = new UserModel();

        $data = $userModel->find();

        if (Application::response()->request('save')) {
            $name = Application::response()->request('user_name');
            $description = Application::response()->request('description');
            
            $userModel->user_name = $name;
            $userModel->description = $description;
            $userModel->save();
            
            Application::view()->redirect(['/site/index']);
        }

        echo Application::view()->render('index', [
            'data' => $data
        ]);
    }
}