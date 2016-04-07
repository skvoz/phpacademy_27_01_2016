<?php
class Db
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'php_class01';

    private static $link;
    private static $instance;

    private function __construct()
    {
    self::$link = mysqli_connect(Db::DB_HOST, Db::DB_USER, Db::DB_PASS, Db::DB_NAME);
    }

    public static function connect()
    {
    if (self::$instance=== null) {
    self::$instance= New self;
    }
    return self::$instance;
    }

    public static function getLink()
    {
    return self::$link;
    }

    public static function query($sql)
    {
    return mysqli_query(self::$link, $sql);
    }

    public static function queryExec($sql)
    {
    mysqli_query(self::$link, $sql);
    return mysqli_error(self::$link);
    }

    public static function insert_last_id()
    {
    return mysqli_insert_id(self::$link);
    }

    public static function escape_string($string)
    {
    return mysqli_real_escape_string(self::$link, $string);
    }

    private function __clone()
    {

    }

}