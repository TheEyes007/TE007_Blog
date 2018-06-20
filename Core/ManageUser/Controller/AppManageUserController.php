<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 22/05/2018
 * Time: 13:04
 */

namespace Core\ManageUser\Controller;

use Core\Controller\Controller;

class AppManageUserController extends Controller
{
    protected $template = 'layout';

    public function __construct()
    {
        $this->viewPath = ROOT .'/Core/ManageUser/Views/';
    }
}