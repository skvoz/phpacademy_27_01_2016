<?php


namespace testnamespace;
use Exception;

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
     * @throws Exception
     */
    public static function render($tpl, $arr)
    {
        $templatePath = sprintf(__DIR__ . '/views/%s.php', $tpl);

        ob_start();
        extract($arr);
        if (!is_file($templatePath)) {
            throw new Exception ('Error', 404);
        }
        
        include_once $templatePath;

        $res = ob_get_contents();
        ob_end_clean();

        return $res;
    }
}