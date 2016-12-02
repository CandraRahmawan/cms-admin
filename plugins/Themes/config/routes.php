<?php

use Cake\Routing\Router;

Router::plugin('Category', ['path' => '/category'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/list', ['controller' => 'Category', 'action' => 'lists']);
    $routes->connect('/server-side', ['controller' => 'Category', 'action' => 'serverSide']);
    $routes->connect('/form-category', ['controller' => 'Category', 'action' => 'form']);
    $routes->fallbacks('DashedRoute');
});
