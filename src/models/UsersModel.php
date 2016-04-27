<?php


namespace testnamespace\models;


use testnamespace\ActiveRecord;

class UsersModel extends ActiveRecord
{
    public $id;
    public $url_id;
    public $user_name;
    public $description;

    public $table = 'user';
    
}