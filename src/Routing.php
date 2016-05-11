<?php


namespace testnamespace;

use ReflectionClass;
use testnamespace\ourInterface\IRouting;

/**
 * Class Routing
 * @package testnamespace
 */
class Routing implements IRouting
{
    /**
     * @var array config routing
     */
    protected $_routing;

    public function __construct()
    {
        $config = include_once __DIR__ . '/config/config.php';

        $this->_routing = $config['routingMap'];
    }

    function delegate($url)
    {
        $args = [];

        if ($currUrl = $this->matchRule($url)) {
            $url = $currUrl;
        }
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
    private function matchRule($url)
    {
        if ($this->_routing) {
            foreach ($this->_routing as $item) {
                if ($item[0] == $url) {
                    return $item[1];
                }
            }
        }
        return false;

//        var_dump($url);
//        die;

//        $uri = $request->getURI();
//        $uri = $url;
//        if (self::isAdminUri($uri)) {
//            Controller::setAdminLayout();
//        }
//        // перебор элементов массива из routes.php
//        foreach (self::$map as $route) {
//            $regex = $route->pattern;
//            foreach ($route->params as $k => $v) {
//                $regex = str_replace('{' . $k . '}', '(' . $v . ')', $regex);
//                // echo "$regex <br>";
//            }
//            // если нашли совпадение по регулярному выражению
//            if (preg_match('@^' . $regex . '$@', $uri, $matches)) {
//                array_shift($matches);
//                if ($matches) {
//                    $matches = array_combine(array_keys($route->params), $matches);
//                    $request->mergeGet($matches);
//                }
//                self::$controller = 'Controller\\' . $route->controller . 'Controller';
//                self::$action = $route->action . 'Action';
//                break;
//            }
//        }
//        if (is_null(self::$controller) || is_null(self::$action)) {
//            throw new \Exception('Route not found: ' . $uri, 404);
//        }
    }


}