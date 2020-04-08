<?php

use Cake\Routing\Router;

Router::plugin('Dashboard', ['path' => '/dashboard'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('', ['controller' => 'Dashboard', 'action' => 'index']);
    $routes->fallbacks('DashedRoute');
});
