<?php

use Cake\Routing\Router;

Router::plugin('Themes', ['path' => '/themes'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/list', ['controller' => 'Themes', 'action' => 'lists']);
    $routes->connect('/server-side', ['controller' => 'Themes', 'action' => 'serverSide']);
    $routes->connect('/form-theme', ['controller' => 'Themes', 'action' => 'form']);
    $routes->connect('/list-menu', ['controller' => 'Menu', 'action' => 'lists']);
    $routes->connect('/setting-menu', ['controller' => 'Menu', 'action' => 'setting']);
    $routes->connect('/update-detail-menu', ['controller' => 'Menu', 'action' => 'detail_update']);
    $routes->connect('/save-menu', ['controller' => 'Menu', 'action' => 'saveMenu']);
    $routes->connect('/change-status/:status', ['controller' => 'Menu', 'action' => 'changeStatus']);
    $routes->fallbacks('DashedRoute');
});
