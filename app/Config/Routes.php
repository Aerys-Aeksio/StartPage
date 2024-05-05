<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get(
  '/',
  'HomeController::index'
);
$routes->get(
  '/',
  'HomeController::index',
  ['as' => 'home']
);
$routes->get(
  'install',
  'InstallController::index',
  ['as' => 'install']
);
$routes->post(
  'install',
  'InstallController::index',
  ['as' => 'install']
);
$routes->get(
  'login',
  'HomeController::login',
  ['as' => 'login']
);
$routes->post(
  'login',
  'HomeController::login',
  ['as' => 'login']
);
$routes->get(
  'logout',
  'HomeController::logout',
  ['as' => 'logout']
);