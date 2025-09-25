<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Public routes
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index'); // Add this line
$routes->get('tours', 'Tour::index');
$routes->get('tour/(:num)', 'Tour::show/$1');
$routes->get('reviews', 'Review::index');
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');

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

// Fallback for 404
$routes->set404Override(function() {
    $data['title'] = 'Page Not Found';
    return view('errors/html/error_404', $data);
});