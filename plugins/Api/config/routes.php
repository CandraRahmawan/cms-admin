<?php

use Cake\Routing\Router;

Router::plugin('Api', ['path' => '/api'], function ($routes) {
    $routes->connect('/sendReview', ['controller' => 'ApiApp', 'action' => 'apiSendReview']);
    $routes->fallbacks('DashedRoute');
});
