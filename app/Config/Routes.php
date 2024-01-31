<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::Accueil');
$routes->get('/accueil', 'Pages::Accueil');
$routes->get('/absences', 'Pages::Absences');
$routes->get('/rattrapages', 'Pages::Rattrapages');

$routes->get('/test', 'Semester::FindAll');