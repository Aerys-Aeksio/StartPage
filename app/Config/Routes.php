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
$routes->post(
  'edit-settings',
  'HomeController::edit_settings',
  ['as' => 'edit_settings']
);
$routes->post(
  'edit-category/(:num)',
  'HomeController::edit_category/$1',
  ['as' => 'edit-category']
);
$routes->post(
  'edit-link/(:num)',
  'HomeController::edit_link/$1',
  ['as' => 'edit-link']
);