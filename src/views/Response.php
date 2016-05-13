<?php


namespace testnamespace\views;


class Response
{
    
    public function post($key = null)
    {

        $result = isset($_POST[$key]) ? $_POST[$key] : false;

        return $result;
    }

    public function get($key)
    {
        $result = isset($_GET[$key]) ? $_GET[$key] : false;

        return $result;
    }

    public function request($key)
    {
        $result = isset($_REQUEST[$key]) ? $_REQUEST[$key] : false;
        
        return $result;
    }
}