<?php

define('ROOT', dirname(__DIR__));
require ROOT . '/App/App.php';

App::load();

require ROOT . '/App/Config/router.php';