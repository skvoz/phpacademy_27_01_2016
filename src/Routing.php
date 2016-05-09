<?php


namespace testnamespace;

use testnamespace\ourInterface\IRouting;

class Routing implements IRouting
{
    function delegate($url)
    {
        $urlArray = explode('/', $url);
        $controller = $urlArray[0];
        $action = $urlArray[1];
        
        if (count($urlArray) > 3) {
            foreach ($urlArray as $order => $item) {
                if ($order >=2) {
                    $args[] = $item;
                }
            }
        }
    }

}