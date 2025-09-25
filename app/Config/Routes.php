<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('tours', 'Tour::index');
$routes->get('tour/(:num)', 'Tour::show/$1');
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send'); // Changed from just 'contact'

// Remove the reviews route for now since we don't have a Reviews controller
// $routes->get('reviews', 'Review::index'); // Comment out until we create this

// Admin routes
$routes->get('admin', 'Admin::index');
$routes->get('admin/addTour', 'Admin::addTour');
$routes->post('admin/addTour', 'Admin::addTour');

// Authentication routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout');
});

// Fallback for 404 - fixed version
$routes->set404Override(function() {
    return view('errors/html/error_404');
});