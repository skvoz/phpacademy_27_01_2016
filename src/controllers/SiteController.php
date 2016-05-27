<?php


namespace testnamespace\controllers;

use testnamespace\Application;
use testnamespace\models\UserModel;
use testnamespace\Secure;

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

    public function actionError($error = null)
    {

        echo Application::view()->render('error', [
            'data' => $error
        ]);
    }

    public function actionLogin()
    {
        if (Application::response()->request('submit')) {

            $form = Application::response()->request();

            $model = new UserModel();

            $model->find([
                'login' => isset($form['login']) ? $form['login'] : null,
            ]);

            if ($model->id == null) {
                throw new \Exception('unexsist user');
            } else {
                if ($form['login'] == $model->login && $form['password'] == $model->password) {
                    Secure::authUser($form['login'], $form['password']);

                    Application::view()->redirect(['/admin/index']);    
                }
            }

        }
        echo Application::view()->render('login', [
            'data' => null,
        ]);
    }

    public function actionLogout()
    {
        Secure::logoutUser();
        
        Application::view()->redirect(['/site/index']);
    }
}