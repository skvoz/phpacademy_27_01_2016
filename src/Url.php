<?php


namespace testnamespace;


class Url
{
    protected static $_routing;

    public static function getRouting()
    {
        $config = include __DIR__ . '/config/config.php';
     
        return $config['routingMap'];
    }

//    public function __construct()
//    {
//
//    }

    /**
     *
     * @param $param ['site/index', ['id'=>5]]
     * @return mixed string /site/index/5
     */
    public static function to($param)
    {
        if ($url = self::matchRule($param[0])) {
            
        } else {
            $url = $param[0];
        }
       
        return $url;
    }

    /**
     * @param $url
     * @return bool
     */
    private static function matchRule($url)
    {
        $_routing = self::getRouting();
        if ($_routing) {
            foreach ($_routing as $item) {
                
                if ($item[1] == $url) {
                    return $item[0];
                }
            }
        }
        return false;
    }
}