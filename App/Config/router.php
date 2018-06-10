<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 21/05/2018
 * Time: 16:35
 */

use \App\Controller\PostsController;
use \App\Controller\ManagePostsController;


// Initialisation de l'objet
    $router = new \Core\Router\Router($_GET['url']);


    $router->get('/', function () {
        $home = New PostsController();
        $home->indexAction();
    });
    $router->get('/posts', function () {
        $posts = New PostsController();
        $posts->postsAction();
    });
    $router->get('/contacts', function () {
        $contacts = New PostsController();
        $contacts->contactsAction();
    });

// backoffice
    $router->get('/backoffice', function () {
        $home = New ManagePostsController();
        $home->indexAction();
    });

    $router->get('/backoffice/views/:id', function ($id) {
    $home = New ManagePostsController();
    $home->onePostAction($id);
    });

    $router->get('/backoffice/add', function () {
        $home = New ManagePostsController();
        $home->addPostAction();
    });
    $router->post('/backoffice/add', function () {
        $home = New ManagePostsController();
        $home->addPostAction();
    });

    $router->get('/backoffice/delete/:id', function ($id) {
    $home = New ManagePostsController();
    $home->deletePostAction($id);
    });

    $router->get('/backoffice/edit/:id', function ($id) {
    $home = New ManagePostsController();
    $home->editPostAction($id);
    });

    $router->post('/backoffice/edit/:id', function ($id) {
    $home = New ManagePostsController();
    $home->editPostAction($id);
});

    $router->get('/backoffice/comments', function () {
        $comments = New ManagePostsController();
        $comments->commentsAction();
    });

    $router->checkingRoute();

