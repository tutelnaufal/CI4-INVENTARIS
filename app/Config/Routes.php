<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Arahkan root "/" ke /items
$routes->get('/', function () {
    return redirect()->to('/items');
});

// ✅ Route login dan logout (di luar grup)
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::doLogin');
$routes->get('logout', 'Auth::logout');

// ✅ Group untuk fitur items
$routes->group('items', function($routes) {
    $routes->get('/', 'Items::index');
    $routes->get('create', 'Items::create');
    $routes->post('store', 'Items::store');
    $routes->get('edit/(:num)', 'Items::edit/$1');
    $routes->post('update/(:num)', 'Items::update/$1');
    $routes->post('delete/(:num)', 'Items::delete/$1');
});
