<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 20/05/2018
 * Time: 20:20
 */

namespace App\Controller;


use Core\Controller\Controller;
use \App;

class PostsController extends AppController
{
    public function indexAction(){
        $this->render('frontend.home');
    }

    public function postsAction(){
        $this->render('frontend.post');
    }

    public function contactsAction(){
        $this->render('frontend.contacts');
    }
}