<?php


namespace testnamespace;


use Composer\Package\Package;

class Secure
{
    const SALT = '111';

    public static function checkController($controller, $callback = null)
    {
        $config = Application::settings();
        
        if (isset($config['secure']['controller']) && in_array($controller, $config['secure']['controller'])) {
            return false;
        } elseif (!isset($config['secure']['controller'])) {
            return true;
        }
        
        return false;
    }

    public static function checkAuth()
    {
        if ($_SESSION['authStatus'] == self::SALT) {
            return true;
        }
        return false;
    }

    public static function authUser()
    {
        $_SESSION['authStatus'] = self::SALT;
    }

    public static function logoutUser()
    {
        unset($_SESSION['authStatus']);
    }
}