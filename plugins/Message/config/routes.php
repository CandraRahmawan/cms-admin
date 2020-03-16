<?php

use Cake\Routing\Router;

Router::plugin('Message', ['path' => '/message'], function ($routes) {
    $routes->extensions('html');
    $routes->connect('/guestbook', ['controller' => 'Guestbook', 'action' => 'lists']);
    $routes->connect('/mailbox', ['controller' => 'Mailbox', 'action' => 'lists']);
    $routes->connect('/mailbox/read', ['controller' => 'Mailbox', 'action' => 'read']);
    $routes->connect('/mailbox/remove', ['controller' => 'Mailbox', 'action' => 'remove']);
    $routes->connect('/read', ['controller' => 'Guestbook', 'action' => 'read']);
    $routes->fallbacks('DashedRoute');
});
