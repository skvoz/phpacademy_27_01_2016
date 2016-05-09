<?php


namespace testnamespace;

/**
 * Class View
 * @package testnamespace\views
 */
class View
{
    /**
     * @param null $uri
     */
    public static function redirect($uri = null)
    {
        $uri = isset($uri) ? $uri : '/';

        header('location: ' . $uri);
    }

    /**
     * @param $tpl
     * @param $arr
     * @return mixed
     */
    public static function render($tpl, $arr)
    {
        $templatePath = sprintf('src/views/%s.php', $tpl);
        ob_start();
        extract($arr);
        include_once $templatePath;
        $res = ob_get_contents();
        ob_end_clean();
        return $res;
    }
}