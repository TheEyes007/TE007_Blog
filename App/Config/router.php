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

$router = new \Core\Router\Router($_GET['url']);

        // backoffice
        $router->get('/backoffice', function () {
            $home = New ManagePostsController();
            $home->indexAction();
        });

        $router->get('/backoffice/comments', function () {
            $comments = New ManageCommentsController();
            $comments->indexAction();
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

        $router->get('/backoffice/comments/alert/:id', function ($id) {
            $home = New ManageCommentsController();
            $home->alertCommentsAction($id);
        });

        $router->get('/backoffice/comments/delete/:id', function ($id) {
            $home = New ManageCommentsController();
            $home->deleteCommentsAction($id);
        });

        $router->get('/backoffice/comments/views/:id', function ($id) {
            $home = New ManageCommentsController();
            $home->onePostAction($id);
        });


        $router->get('/myaccount', function () {
            $home = New ManagePostsController();
            $home->accountAction();
        });

        $router->get('/myaccount/edit', function () {
            $home = New ManagePostsController();
            $home->accountEditAction();
        });

        $router->post('/myaccount/edit', function () {
            $home = New ManagePostsController();
            $home->accountEditAction();
        });

        // Frontoffice
    $router->get('/', function () {
        $home = New PostsController();
        $home->indexAction();
    });

    $router->get('/login', function () {
        $home = New PostsController();
        $home->loginAction();
    });

    $router->get('/logout', function () {
    $home = New PostsController();
    $home->logoutAction();
    });

    $router->post('/login', function () {
        $home = New PostsController();
        $home->loginAction();
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


    $router->get('/404', function () {
        $error404 = New \Core\Controller\Controller();
        $error404->error404();
    });

    $router->checkingRoute();