<?php


namespace testnamespace;

/**
 * Class Config
 * @package testnamespace
 */
class Config
{
    /**
     * @param $key
     * @return mixed
     */
    public static function params($key) {
        $data = include __DIR__ . '/../config/config.php';
        return $key ? $data[$key] : $data;
    }
}