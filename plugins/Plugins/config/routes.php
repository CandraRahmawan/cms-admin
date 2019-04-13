<?php

use Cake\Routing\Router;

Router::plugin('Plugins', ['path' => '/plugins'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/list', ['controller' => 'Plugins', 'action' => 'lists']);
    $routes->connect('/form-action', ['controller' => 'Plugins', 'action' => 'form_action']);
    $routes->fallbacks('DashedRoute');
});
