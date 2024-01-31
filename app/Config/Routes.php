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

$routes->get('/test', 'Semester::FindAll');
$routes->get('/AjoutExam', 'AjoutExam::Index');
$routes->post('/AjoutExam/ajout', 'AjoutExam::Ajout');