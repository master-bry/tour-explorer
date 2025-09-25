<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('tours', 'Tour::index');
$routes->get('tour/(:num)', 'Tour::show/$1');
$routes->get('reviews', 'Review::index');
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');

// Admin routes with admin filter
$routes->group('admin', ['filter' => 'admin'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('addTour', 'Admin::addTour');
    $routes->post('addTour', 'Admin::addTour');
    $routes->get('edit/(:num)', 'Admin::editTour/$1');
    $routes->post('edit/(:num)', 'Admin::editTour/$1');
    $routes->get('delete/(:num)', 'Admin::deleteTour/$1');
});

// Myth:Auth routes (use the default ones)
// service('auth')->routes($routes);
// Myth:Auth routes (manual)
$routes->get('login', 'Myth\Auth\Controllers\AuthController::login');
$routes->post('login', 'Myth\Auth\Controllers\AuthController::attemptLogin');
$routes->get('logout', 'Myth\Auth\Controllers\AuthController::logout');
$routes->get('register', 'Myth\Auth\Controllers\AuthController::register');
$routes->post('register', 'Myth\Auth\Controllers\AuthController::attemptRegister');

// Fallback for 404
$routes->set404Override(function() {
    $data['title'] = 'Page Not Found';
    return view('errors/html/error_404', $data);
});