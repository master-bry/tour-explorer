<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');
$routes->get('tours', 'Tour::index');
$routes->get('tour/(:num)', 'Tour::show/$1');
$routes->get('contact', 'Contact::index');
$routes->post('contact', 'Contact::index');
$routes->get('admin', 'Admin::index');
$routes->get('admin/addTour', 'Admin::addTour');
$routes->post('admin/addTour', 'Admin::addTour');
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
});