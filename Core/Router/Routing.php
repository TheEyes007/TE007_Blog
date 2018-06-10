<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 08/06/2018
 * Time: 13:52
 */

namespace Core\Router;


class Routing
{
    public function redirectToRoute($path){
        header('Location: /'.$path);
    }
}