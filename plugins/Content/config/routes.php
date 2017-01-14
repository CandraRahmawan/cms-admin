<?php

use Cake\Routing\Router;

Router::plugin('Content', ['path' => '/content'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/list-article', ['controller' => 'Content', 'action' => 'listsArticle']);
    $routes->connect('/list-page', ['controller' => 'Content', 'action' => 'listsPage']);
    $routes->connect('/list-section', ['controller' => 'Content', 'action' => 'listsSection']);
    $routes->connect('/server-side/:type', ['controller' => 'Content', 'action' => 'serverSide']);
    $routes->connect('/form-page', ['controller' => 'Content', 'action' => 'formPage']);
    $routes->connect('/form-article', ['controller' => 'Content', 'action' => 'formArticle']);
    $routes->connect('/form-section', ['controller' => 'Content', 'action' => 'formSection']);
    $routes->connect('/trash', ['controller' => 'Content', 'action' => 'trashContent']);
    $routes->fallbacks('DashedRoute');
});
