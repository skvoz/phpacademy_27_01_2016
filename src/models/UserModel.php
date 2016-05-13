<?php


namespace testnamespace\models;

/**
 * Class UserModel
 * @package testnamespace\models
 */
class UserModel extends BaseModel
{
    protected $table = 'user';
    
    public $id;
    public $url_id;
    public $user_name;
    public $description;
}