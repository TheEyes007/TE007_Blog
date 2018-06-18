<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 21/05/2018
 * Time: 16:35
 */

use \App\Controller\PostsController;
use \App\Controller\ManagePostsController;
use \App\Controller\ManageCommentsController;
use \Core\ManageUser\Auth\DbAuth;

// Initialisation de l'objet
    $router = new \Core\Router\Router($_GET['url']);


    $router->get('/', function () {
        $home = New PostsController();
        $home->indexAction();
    });

    $router->get('/register', function () {
        $home = New PostsController();
        $home->registerAction();
    });

    $router->post('/register', function () {
    $home = New PostsController();
    $home->registerAction();
    });

    $router->get('/posts', function () {
        $posts = New PostsController();
        $posts->postsAction();
    });
    $router->get('/contacts', function () {
        $contacts = New PostsController();
        $contacts->contactsAction();
    });

    $router->get('/posts/:id', function ($id) {
    $home = New PostsController();
    $home->articlesAction($id);
    });

    $router->post('/posts/:id', function ($id) {
    $home = New PostsController();
    $home->articlesAction($id);
    });

    $router->get('/posts/comments/:id', function ($id) {
    $home = New PostsController();
    $home->alertComments($id);
    });

    $router->get('/posts/comments/:id', function ($id) {
        $home = New PostsController();
        $home->alertComments($id);
    });

    $router->checkingRoute();

