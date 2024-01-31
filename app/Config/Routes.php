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

$routes->get('/AjoutExam', 'AjoutExam::Index');
$routes->post('/AjoutExam/ajout', 'AjoutExam::Ajout');

$routes->get('/AjoutRattrapage/[0-9]+', 'AjoutRattrapage::Index');
$routes->post('/AjoutRattrapage/ajout', 'AjoutRattrapage::Ajout');