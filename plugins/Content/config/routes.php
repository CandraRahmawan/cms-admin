<?php

use Cake\Routing\Router;

Router::plugin('Content', ['path' => '/content'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/list', ['controller' => 'Content', 'action' => 'lists']);
    $routes->connect('/server-side', ['controller' => 'Content', 'action' => 'serverSide']);
    $routes->connect('/form-page', ['controller' => 'Content', 'action' => 'formPage']);
    $routes->connect('/form-article', ['controller' => 'Content', 'action' => 'formArticle']);
    $routes->connect('/trash', ['controller' => 'Content', 'action' => 'trashContent']);
    $routes->fallbacks('DashedRoute');
});
