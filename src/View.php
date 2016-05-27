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
        //todo
        $newUri = '';
        foreach ($uri as $order => $item) {
            $newUri .= '/' . $item;
        }
        $uri = substr($newUri, 1, strlen($newUri));
        $uri = isset($uri) ? $uri : '/';

        header('location: ' . $uri);
    }

    /**
     * @param $tpl
     * @param $arr
     * @param string $controller
     * @return mixed
     * @throws Exception
     */
    public  function render($tpl, $arr, $controller = 'site')
    {
        $templatePath = sprintf(__DIR__ . '/views/%s/%s.php', $controller, $tpl);
        
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