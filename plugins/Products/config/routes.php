<?php

use Cake\Routing\Router;

Router::plugin('Products', ['path' => '/product'], function ($routes) {
  $routes->extensions('html');
  $routes->connect('/list', ['controller' => 'Products', 'action' => 'lists']);
  $routes->connect('/server-side', ['controller' => 'Products', 'action' => 'serverSide']);
  $routes->connect('/form-product', ['controller' => 'Products', 'action' => 'formProduct']);
  $routes->fallbacks('DashedRoute');
});
