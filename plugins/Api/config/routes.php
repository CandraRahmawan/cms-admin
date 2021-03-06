<?php

use Cake\Routing\Router;

Router::plugin('Api', ['path' => '/api'], function ($routes) {
  $routes->connect('/sendReview', ['controller' => 'Api', 'action' => 'apiSendReview']);
  $routes->connect('/sendMailbox', ['controller' => 'Api', 'action' => 'apiSendMailbox']);
  $routes->connect('/getListReview', ['controller' => 'Api', 'action' => 'apiGetListReview']);
  $routes->fallbacks('DashedRoute');
});
