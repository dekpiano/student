<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->match(['get', 'post'],'Login', 'ControlLogin::loginProcess');
$routes->match(['get', 'post'],'login', 'ControlLogin::loginProcess');
$routes->post('login/google', 'ControlLogin::googleLoginProcess');
$routes->match(['get', 'post'],'Logout', 'ControlLogin::logout');
$routes->match(['get', 'post'],'logout', 'ControlLogin::logout');

$routes->get('Dashboard', 'ControlDashboard::index');
$routes->get('DoGrade', 'ControlDoGrade::index');
$routes->get('DoGrade/(:any)', 'ControlDoGrade::index/$1');
$routes->get('DoGrade/(:any)/(:any)', 'ControlDoGrade::index/$1/$2');

$routes->get('dograde', 'ControlDoGrade::index');
$routes->get('dograde/(:any)', 'ControlDoGrade::index/$1');
$routes->get('dograde/(:any)/(:any)', 'ControlDoGrade::index/$1/$2');

// Club Routes
$routes->get('club', 'ControlClub::index');
$routes->get('club/view/(:num)', 'ControlClub::view/$1');
$routes->post('club/join', 'ControlClub::join');
$routes->post('club/cancel', 'ControlClub::cancelClub');
$routes->get('club/results-summary', 'ControlClub::getResultsSummary');
$routes->get('club/attendance-summary/(:num)/(:num)', 'ControlClub::getAttendanceSummary/$1/$2');
$routes->get('club/remaining-changes', 'ControlClub::getRemainingChanges');

// Email Verification & Guide Routes
$routes->get('verify-email', 'ControlEmailVerification::index');
$routes->get('guide', 'ControlEmailVerification::guide');
$routes->post('verify-email/check', 'ControlEmailVerification::verifyAndGetEmail');
$routes->post('verify-email/reset-password', 'ControlEmailVerification::resetPassword');



