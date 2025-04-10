<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/cidades', 'Cidades::index');
$routes->get('/cidades/new', 'Cidades::new');
$routes->post('/cidades/create', 'Cidades::create');
$routes->get('/cidades/edit(:any)', 'Cidades::edit/$1'); // esse $1 significa que possui um parametro, se quiser mais um precisa colocar outro (:any) e $2 ...