<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {
    $routes->extensions('html');
    $routes->connect('', ['controller' => 'Login', 'action' => 'index']);
    $routes->connect('/login', ['controller' => 'Login', 'action' => 'index']);
    $routes->connect('/delete-files', ['controller' => 'Utility', 'action' => 'deleteFiles']);
    $routes->fallbacks('DashedRoute');
});

Plugin::routes();
