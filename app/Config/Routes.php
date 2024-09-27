<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->match(['get', 'post'],'Login', 'ControlLogin::loginProcess');
$routes->match(['get', 'post'],'Logout', 'ControlLogin::logout');

$routes->get('Dashboard', 'ControlDashboard::index');
$routes->get('DoGrade/(:any)/(:any)', 'ControlDoGrade::index/$1/$2');
