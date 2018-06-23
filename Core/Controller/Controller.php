<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 20:19
 */

namespace Core\Controller;


class Controller
{
    protected $viewPath;
    protected $template;

    public function render($view,$variables = []){
        ob_start();
        extract($variables);
        require($this->viewPath.str_replace('.','/',$view).'.php');
        $content = ob_get_clean();
        require($this->viewPath. $this->template.'.php');
    }

    public function error404()
    {
        require_once ROOT . '/Core/Router/View/404.php';
    }

    public function security()
    {
        require_once ROOT . '/Core/Router/View/security.php';
    }
}