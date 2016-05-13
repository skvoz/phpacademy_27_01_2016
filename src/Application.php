<?php


namespace testnamespace;

use testnamespace\views\Response;

class Application
{
    private $settings = [];

    private static $_instance = null;

    private function __construct()
    {
        $this->settings = __DIR__ . '/config/config.php';
    }

    protected function __clone()
    {

    }

    static public function getInstance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return string
     */
    public static function settings()
    {
        return include 'config/config.php';
    }

    /**
     * @return \PDO
     */
    public static function db()
    {
        return (new Database())->connect();
    }

    /**
     * @return string
     */
    public static function request()
    {
        return 'request';
    }

    /**
     * @return Response
     */
    public static function response()
    {
        return new Response();
    }

    /**
     * @return View
     */
    public static function view()
    {
        return new View();
    }
}