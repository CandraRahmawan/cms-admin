<?php

use Cake\Routing\Router;

Router::plugin('Comments', ['path' => '/comments'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/reviews', ['controller' => 'Reviews', 'action' => 'lists']);
    $routes->connect('/change-status/:status', ['controller' => 'Reviews', 'action' => 'changeStatus']);
    $routes->connect('/api/sendReview', ['controller' => 'Reviews', 'action' => 'apiSendReview']);
    $routes->fallbacks('DashedRoute');
});
