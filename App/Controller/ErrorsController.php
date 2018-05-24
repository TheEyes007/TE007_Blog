<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 21/05/2018
 * Time: 12:07
 */

namespace App\Controller;


class ErrorsController
{
    public function error404Action(){
        require ROOT . '/App/view/404.php';
    }
}