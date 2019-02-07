<?php

use Cake\Routing\Router;

Router::plugin('Plugins', ['path' => '/plugins'], function ($routes) {
    $routes->extensions('html');
    $routes->fallbacks('DashedRoute');
});
