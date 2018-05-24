<?php
/**
 * Created by PhpStorm.
 * User: mvibert
 * Date: 21/05/2018
 * Time: 16:35
 */

use \App\Controller\PostsController;


// Initialisation de l'objet
$router = new \Core\Router\Router($_GET['url']);

$router->get('/', function(){$home = New PostsController();$home->indexAction();});
$router->get('/articles', function(){$articles = New PostsController();$articles->postAction();});
$router->get('/contacts', function(){$contacts = New PostsController();$contacts->contactsAction();});
$router->checkingRoute();