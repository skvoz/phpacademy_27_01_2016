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
        $this->_routing = Config::get('routingMap');
        print_r($this->_routing);
    }

    function delegate($url)
    {
        $args = [];
        
        $url = str_ireplace(REL_URL, '', $url);

        if ($currUrl = $this->matchRule($url)) {
            $url = $currUrl;
        }
        $urlArray = explode('/',  ltrim($url, '/'));
        //magic drop first el , such as first el == ''
        
        $controller = array_shift($urlArray);

        $action = array_shift($urlArray);

        $args = $urlArray;

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