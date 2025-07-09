<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// API Routes
$routes->group('api', function($routes) {
    $routes->get('tasks', 'TasksController::index');
    $routes->post('tasks', 'TasksController::create');
    $routes->put('tasks/(:num)', 'TasksController::update/$1');
    $routes->delete('tasks/(:num)', 'TasksController::delete/$1');
    
    // CORS preflight requests
    $routes->options('tasks', 'TasksController::options');
    $routes->options('tasks/(:num)', 'TasksController::options/$1');
});
