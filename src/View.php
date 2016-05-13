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
     * @param array $uri
     */
    public  function redirect($uri = null)
    {
        $uri = isset($uri) ? $uri : '/';
        $uri = Url::to($uri);
        header('location: ' . $uri);
    }

    /**
     * @param $tpl
     * @param $arr
     * @return mixed
     * @throws Exception
     */
    public  function render($tpl, $arr)
    {
        $templatePath = sprintf(__DIR__ . '/views/%s.php', $tpl);
        $layoutPath = sprintf(__DIR__ . '/views/layout.php', $tpl);

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