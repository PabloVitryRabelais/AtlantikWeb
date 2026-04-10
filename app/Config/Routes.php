<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('Atlantik', 'Visiteur::acceuil');

$routes->match(['get', 'post'],'creercompte', 'Visiteur::creerCompte');
$routes->match(['get', 'post'],'seconnecter', 'Visiteur::seConnecter');
$routes->match(['get', 'post'],'sedeconnecter', 'Visiteur::seDeconnecter');

$routes->match(['get', 'post'],'liaisonsparsecteur', 'Visiteur::LiaisonSecteur');
$routes->match(['get', 'post'],'liaisonsparsecteur/(:num)', 'Visiteur::LiaisonSecteur/$1');

$routes->match(['get', 'post'],'visutraversees', 'Visiteur::VisualiserTraversees');
$routes->match(['get', 'post'],'visutraversees/(:num)', 'Visiteur::VisualiserTraversees/$1');
$routes->match(['get', 'post'],'reservertraversee/(:num)', 'Visiteur::ReserverTraversee/$1', ["filter" => "filtreclient"]);