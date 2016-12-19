<?php

use Cake\Routing\Router;

Router::plugin('Images', ['path' => '/images'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/list', ['controller' => 'Images', 'action' => 'lists']);
    $routes->connect('/form-action', ['controller' => 'Images', 'action' => 'form']);
    $routes->fallbacks('DashedRoute');
});
