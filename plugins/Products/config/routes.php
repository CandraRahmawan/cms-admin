<?php

use Cake\Routing\Router;

Router::plugin('Products', ['path' => '/product'], function ($routes) {
  $routes->extensions('html');
  $routes->connect('/list', ['controller' => 'Products', 'action' => 'lists']);
  $routes->connect('/server-side', ['controller' => 'Products', 'action' => 'serverSide']);
  $routes->connect('/form-product', ['controller' => 'Products', 'action' => 'formProduct']);
  $routes->connect('/get-image', ['controller' => 'Products', 'action' => 'getImage']);
  $routes->connect('/upload-image', ['controller' => 'Products', 'action' => 'uploadImage']);
  $routes->connect('/remove-image', ['controller' => 'Products', 'action' => 'removeImage']);
  $routes->connect('/sort-image', ['controller' => 'Products', 'action' => 'sortImage']);
  $routes->fallbacks('DashedRoute');
});
