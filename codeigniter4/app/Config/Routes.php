<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('/cidades', 'Cidades::index');
$routes->get('/cidades/index', 'Cidades::index');
$routes->get('/cidades/new', 'Cidades::new');
$routes->post('/cidades/create', 'Cidades::create');
$routes->get('/cidades/edit/(:any)', 'Cidades::edit/$1');
$routes->post('/cidades/update', 'Cidades::update');
$routes->post('/cidades/search', 'Cidades::search');
$routes->get('/cidades/delete/(:any)', 'Cidades::delete/$1');

$routes->get('/categorias', 'Categorias::index');
$routes->get('/categorias/index', 'Categorias::index');
$routes->get('/categorias/new', 'Categorias::new');
$routes->post('/categorias/create', 'Categorias::create');
$routes->get('/categorias/edit/(:any)', 'Categorias::edit/$1');
$routes->post('/categorias/update', 'Categorias::update');
$routes->post('/categorias/search', 'Categorias::search');
$routes->get('/categorias/delete/(:any)', 'Categorias::delete/$1');

$routes->get('/produtos', 'Produtos::index');
$routes->get('/produtos/index', 'Produtos::index');
$routes->get('/produtos/new', 'Produtos::new');
$routes->post('/produtos/create', 'Produtos::create');
$routes->get('/produtos/edit/(:any)', 'Produtos::edit/$1');
$routes->post('/produtos/update', 'Produtos::update');
$routes->post('/produtos/search', 'Produtos::search');
$routes->get('/produtos/delete/(:any)', 'Produtos::delete/$1');

$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/index', 'Usuarios::index');
$routes->get('/usuarios/new', 'Usuarios::new');
$routes->post('/usuarios/create', 'Usuarios::create');
$routes->get('/usuarios/edit/(:any)', 'Usuarios::edit/$1');
$routes->post('/usuarios/update', 'Usuarios::update');
$routes->post('/usuarios/search', 'Usuarios::search');

$routes->get('/admin', 'Admin::index');
$routes->get('/admin/index', 'Admin::index');

$routes->get('/user', 'User::index');
$routes->get('/user/index', 'User::index');


$routes->get('/login', 'Login::index');
$routes->get('/login/index', 'Login::index');
$routes->post('/login/logar', 'Login::logar');
$routes->get('/login/logout', 'Login::logout');


$routes->get('/usuarios/edit_nivel', 'Usuarios::edit_nivel');
$routes->post('/usuarios/salvar_nivel', 'Usuarios::salvar_nivel');

$routes->get('/usuarios/edit_senha', 'Usuarios::edit_senha');
$routes->post('/usuarios/salvar_senha', 'Usuarios::salvar_senha');

$routes->get('/usuarios/delete/(:any)', 'Usuarios::delete/$1');
$routes->get('/enderecos', 'Endereco::index');

$routes->get('/endereco/new', 'Endereco::new');
$routes->post('/enderecos/create', 'Endereco::create');
$routes->get('/enderecos/deletar/(:any)', 'Endereco::deletar/$1');// esse (:any) foi feito para passar parametros pela url, e o $1 e para receber.
$routes->get('/enderecos/editar/(:any)', 'Endereco::edit/$1');// esse (:any) foi feito para passar parametros pela url, e o $1 e para receber.
$routes->post('/enderecos/update', 'Endereco::update');
$routes->post('/endereco/search', 'Endereco::search');

