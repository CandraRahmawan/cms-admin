<?php

use Cake\Routing\Router;

Router::plugin('Message', ['path' => '/message'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/guestbook', ['controller' => 'Guestbook', 'action' => 'lists']);
    $routes->connect('/read', ['controller' => 'Guestbook', 'action' => 'read']);
    $routes->fallbacks('DashedRoute');
});
