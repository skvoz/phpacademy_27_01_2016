<?php


namespace testnamespace;

use ReflectionClass;
use testnamespace\ourInterface\IRouting;

class Routing implements IRouting
{
    function delegate($url)
    {
        $args = [];

        $urlArray = explode('/', $url);
        //magic drop first el , such as first el == ''
        array_shift($urlArray);

        $controller = $urlArray[0];

        $action = $urlArray[1];

        if (count($urlArray) > 2) {
            foreach ($urlArray as $order => $item) {
                if ($order >=2) {
                    $args[] = $item;
                }
            }
        }

        $reflection = new ReflectionClass('testnamespace\\controllers\\' . ucfirst($controller) . 'Controller');

        $controller = $reflection->newInstance();

        $action = 'action' . ucfirst($action);

        if (is_callable([$controller, $action])) {

            call_user_func_array([$controller, $action], $args);
        } else {
            throw new \Exception('Uncnown action . ' . $action);
        }
    }

}