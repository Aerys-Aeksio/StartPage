<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get(
  'install',
  'InstallController::index',
  ['as' => 'install']);
$routes->post(
  'install',
  'InstallController::index',
  ['as' => 'install']);
  $routes->get('admin', ' AdminController::index', ['filter' => 'auth']);