<?php

use Cake\Routing\Router;

Router::plugin('Gallery', ['path' => '/gallery'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/slider-banner/list', ['controller' => 'SliderBanner', 'action' => 'lists']);
    $routes->connect('/slider-banner/form-action', ['controller' => 'SliderBanner', 'action' => 'form']);
    $routes->fallbacks('DashedRoute');
});
