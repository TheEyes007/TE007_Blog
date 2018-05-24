<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 22/05/2018
 * Time: 13:04
 */

namespace App\Controller;


use Core\Controller\Controller;


class AppController extends Controller
{
    protected $template = 'layout';

    public function __construct()
    {
        $this->viewPath = ROOT .'/App/View/';
    }

}