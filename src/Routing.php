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

    /**
     * @param $url
     * @throws \Exception
     */
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

    /**
     * @param $url
     * @return bool
     */
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
    }
}