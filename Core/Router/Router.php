<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 21/05/2018
 * Time: 12:41
 */

namespace Core\Router;


    class Router
    {

        private $url;
        private $routes = array();

        public function __construct($url)
        {
            $this->url = $url;
        }

        public function get($path, $callable)
        {
            $route = new Route($path, $callable);
            $this->routes['GET'][] = $route;
        }

        public function post($path, $callable)
        {
            $route = new Route($path, $callable);
            $this->routes['POST'][] = $route;
        }

        public function checkingRoute()
        {

            if (!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
            {
                require ROOT . '/Core/Router/View/GET_POST.php';
            }

            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
                if ($route->match($this->url))
                {
                    return $route->call();
                }
            }
            require ROOT . '/Core/Router/View/404.php';
        }
    }