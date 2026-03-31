<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('Atlantik', 'Visiteur::acceuil');

$routes->match(['get', 'post'],'creercompte', 'Visiteur::creerCompte');

$routes->match(['get', 'post'],'liaisonsparsecteur', 'Visiteur::LiaisonSecteur');
$routes->match(['get', 'post'],'liaisonsparsecteur/(:num)', 'Visiteur::LiaisonSecteur/$1');