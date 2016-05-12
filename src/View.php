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

        header('location: ' . REL_URL.'/'.$uri);
    }

    /**
     * @param $tpl
     * @param $arr
     * @return mixed
     * @throws Exception
     */
    public static function render($tpl, $arr, $useLayout = true, $layout = 'default')
    {
        

        $templatePath = sprintf(__DIR__ . '/views/%s.php', $tpl);

        ob_start();
        extract($arr);
        if (!is_file($templatePath)) {
            throw new Exception ('Error', 404);
        }
        
        include_once $templatePath;

        $content = ob_get_contents();
        ob_end_clean();

        if ($useLayout != false) {
            if (!is_file(self::getLayoutPath($layout))){
                throw new Exception ('Layout Error', 404.4);
            }
            ob_start();
            include_once self::getLayoutPath($layout);
            $content = ob_get_clean();
        }
        return $content;
    }

    public static function getLayoutPath($layout = 'default') 
    {
        return __DIR__.'/views/_layouts/'.$layout.'.php';
    }
}