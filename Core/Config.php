<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 18:48
 */

namespace Core;


class Config
{
    private $settings = array();
    private static $_instance == NULL;

    public static function getInstance(){
        if(is_null(self::$_instance))
        {
            self::$_instance == new Config();
        }
        return self::$_instance;
    }

    public function __construct(){
        $this->settings = require dirname(__DIR__) . '/App/config/config.php';
    }

    public function get($key)
    {
        if (!isset($this->settings[$key]))
        {
            return null;
        }
        return $this->settings[$key];
    }}