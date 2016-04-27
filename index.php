<?php

require "vendor/autoload.php";

/**
 * @param $tpl
 * @param $arrayEnv
 * @return mixed
 */
function render($tpl, $arr)
{
    $templatePath = sprintf('views/%s.te', $tpl);
    ob_start();
    extract($arr);
    include_once $templatePath;
    $res = ob_get_contents();
    ob_end_clean();
    return $res;
}


var_dump($_SERVER['REQUEST_URI']);
echo render('main', [
    'foo' => $foo,
    'bar' => $bar
]);