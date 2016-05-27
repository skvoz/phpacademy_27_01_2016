<?php


namespace testnamespace;


class Secure
{
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
}