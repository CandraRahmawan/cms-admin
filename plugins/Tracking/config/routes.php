<?php

use Cake\Routing\Router;

Router::plugin('Tracking', ['path' => '/tracking'], function ($routes) {
    $routes->fallbacks('DashedRoute');
});
