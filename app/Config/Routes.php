<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::Connexion');
$routes->get('/connexion', 'Pages::Connexion');
$routes->get('/logout', 'Pages::logout');
$routes->post('/connexion', 'ConnexionController::checkConnexion');
$routes->get('/accueil', 'Pages::Accueil');
$routes->get('/absences', 'Pages::Absences');
$routes->get('/rattrapages', 'Pages::Rattrapages');

$routes->get('/test', 'Semester::FindAll');

$routes->get('/AjoutExam', 'AjoutExam::Index');
$routes->post('/AjoutExam/ajout', 'AjoutExam::Ajout');
$routes->get('/AjoutExam/edit/([0-9]+)', 'AjoutExam::Edit/$1');
$routes->post('/AjoutExam/edit/([0-9]+)', 'AjoutExam::EditExam/$1');


$routes->get('/AjoutRattrapage/([0-9]+)', 'AjoutRattrapage::Index/$1');
$routes->post('/AjoutRattrapage/ajout', 'AjoutRattrapage::Ajout');


$routes->get('/DirectorDashboard', 'DirectorDashboard::Index');
$routes->get('/DirectorDashboard/supprimerSemestre/([0-9]+)', 'DirectorDashboard::SupprimerSemestre/$1');
$routes->post('/DirectorDashboard/ajoutSemestre', 'DirectorDashboard::AjoutSemestre');
$routes->post('/DirectorDashboard/ajoutUser', 'DirectorDashboard::AjoutUser');
$routes->get('/DirectorDashboard/supprimerUser/([0-9]+)', 'DirectorDashboard::SupprimerUser/$1');
$routes->post('/DirectorDashboard/ajoutResource', 'DirectorDashboard::AjoutResource');
$routes->get('/DirectorDashboard/supprimerResource/([0-9]+)', 'DirectorDashboard::SupprimerResource/$1');
$routes->post('/DirectorDashboard/ajoutUserResource', 'DirectorDashboard::AjoutUserResource');
$routes->get('/DirectorDashboard/supprimerUserResource/([0-9]+)', 'DirectorDashboard::SupprimerUserResource/$1');
$routes->post('/DirectorDashboard/ajoutStudent', 'DirectorDashboard::AjoutStudent');
$routes->get('/DirectorDashboard/supprimerStudent/([0-9]+)', 'DirectorDashboard::SupprimerStudent/$1');
$routes->post('/DirectorDashboard/importStudents', 'DirectorDashboard::ImportStudents');
