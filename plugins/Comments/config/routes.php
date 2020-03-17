<?php

use Cake\Routing\Router;

Router::plugin('Comments', ['path' => '/comments'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/review', ['controller' => 'Reviews', 'action' => 'lists']);
    $routes->connect('/review/change-status/:status', ['controller' => 'Reviews', 'action' => 'changeStatus']);
    $routes->fallbacks('DashedRoute');
});
