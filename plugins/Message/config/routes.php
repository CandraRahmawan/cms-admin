<?php

use Cake\Routing\Router;

Router::plugin('Message', ['path' => '/message'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/mailbox', ['controller' => 'Mailbox', 'action' => 'lists']);
    $routes->connect('/mailbox/read', ['controller' => 'Mailbox', 'action' => 'read']);
    $routes->connect('/mailbox/remove', ['controller' => 'Mailbox', 'action' => 'remove']);
    $routes->fallbacks('DashedRoute');
});
