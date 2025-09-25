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

// Admin routes
$routes->get('admin', 'Admin::index');
$routes->get('admin/addTour', 'Admin::addTour');
$routes->post('admin/addTour', 'Admin::addTour');
$routes->get('admin/edit/(:num)', 'Admin::editTour/$1');
$routes->post('admin/edit/(:num)', 'Admin::editTour/$1');
$routes->get('admin/delete/(:num)', 'Admin::deleteTour/$1');

// Authentication routes
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

// Fallback for 404
$routes->set404Override(function() {
    $data['title'] = 'Page Not Found';
    return view('errors/html/error_404', $data);
});