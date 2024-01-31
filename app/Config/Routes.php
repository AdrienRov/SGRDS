<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::Connexion');
$routes->get('/connexion', 'Pages::Connexion');
$routes->post('/connexion', 'ConnexionController::checkConnexion');
$routes->get('/accueil', 'Pages::Accueil');
$routes->get('/absences', 'Pages::Absences');
$routes->get('/rattrapages', 'Pages::Rattrapages');