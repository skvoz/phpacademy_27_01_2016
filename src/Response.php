<?php


namespace testnamespace;


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

    public function request($key = null)
    {
        $result = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $_REQUEST;
        
        return $result;
    }
}