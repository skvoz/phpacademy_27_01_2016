<?php


namespace testnamespace\controllers;


use testnamespace\Application;
use testnamespace\Secure;

class AdminController 
{

    public function __construct()
    {
        if (Secure::checkController('admin') === false) {

            if (Secure::checkAuth() == false) {
                Application::view()->redirect(['/site/error',
                    'error' => 'Page admin is secure, you don\'t have enough right']);
            }

        }
    }
    
    public function actionIndex()
    {
        $data = 'this is secure place';
        
        echo Application::view()->render('index', [
            'data' => $data
        ], 'admin');
    }
}