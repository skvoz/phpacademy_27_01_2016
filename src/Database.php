<?php
namespace testnamespace;

use PDO;

class Database
{
    public function connect()
    {
        $settings = Application::settings();
        $driver = $settings['configDb']['driver'];
        $user = $settings['configDb']['user'];
        $password = $settings['configDb']['password'];
        return new PDO($driver, $user, $password);
    }
}