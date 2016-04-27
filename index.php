<?php

use testnamespace\models\UsersModel;

require "vendor/autoload.php";

$model = new UsersModel();

if (isset($_REQUEST['save'])) {
    $model->load($_REQUEST);
    $model->save();
    \testnamespace\View::redirect();
}

$users = $model->find();

echo \testnamespace\View::render('main', [
    'users' => $users,
]);