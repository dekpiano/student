<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->match(['get', 'post'],'Login', 'ControlLogin::loginProcess');
$routes->match(['get', 'post'],'login', 'ControlLogin::loginProcess');
$routes->match(['get', 'post'],'Logout', 'ControlLogin::logout');
$routes->match(['get', 'post'],'logout', 'ControlLogin::logout');

$routes->get('Dashboard', 'ControlDashboard::index');
$routes->get('DoGrade', 'ControlDoGrade::index');
$routes->get('DoGrade/(:any)/(:any)', 'ControlDoGrade::index/$1/$2');

// Club Routes
$routes->get('club', 'ControlClub::index');
$routes->get('club/view/(:num)', 'ControlClub::view/$1');
$routes->post('club/join', 'ControlClub::join');
$routes->post('club/cancel', 'ControlClub::cancelClub');
$routes->get('club/results-summary', 'ControlClub::getResultsSummary');
$routes->get('club/attendance-summary/(:num)/(:num)', 'ControlClub::getAttendanceSummary/$1/$2');
$routes->get('club/remaining-changes', 'ControlClub::getRemainingChanges');

