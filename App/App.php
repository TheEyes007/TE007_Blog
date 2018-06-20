<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 19:29
 */


class App
{
        private static $_instance = NULL;

        public static function getInstance(){
                if(is_null(self::$_instance))
                {
                    self::$_instance == new App();
                }
                return self::$_instance;
            }

        public static function load()
        {
            require ROOT . '/App/Autoloader.php';
            App\Autoloader::register();

            require ROOT . '/Core/Autoloader.php';
            Core\Autoloader::register();

            require_once ROOT . '/App/Config/router.php';
         }
}