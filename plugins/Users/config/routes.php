<?php

use Cake\Routing\Router;

Router::plugin('Users', ['path' => '/users'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/profile', ['controller' => 'Users', 'action' => 'profile']);
    $routes->connect('/list', ['controller' => 'Users', 'action' => 'lists']);
    $routes->connect('/server-side', ['controller' => 'Users', 'action' => 'serverSide']);
    $routes->connect('/add', ['controller' => 'Users', 'action' => 'add']);
    $routes->fallbacks('DashedRoute');
});
