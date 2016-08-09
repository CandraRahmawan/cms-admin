<?php

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {
    $routes->extensions('html');
    $routes->connect('/', ['controller' => 'Login', 'action' => 'index']);
    $routes->connect('/dashboard', ['controller' => 'Dashboard', 'action' => 'index']);
    $routes->fallbacks('DashedRoute');
});

Plugin::routes();
