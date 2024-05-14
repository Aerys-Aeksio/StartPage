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
  'update-settings',
  'HomeController::update_settings',
  ['as' => 'update-settings']
);
$routes->post(
  'update-category/(:num)',
  'HomeController::update_category/$1',
  ['as' => 'update-category']
);
$routes->post(
  'add-category',
  'HomeController::add_category',
  ['as' => 'add-category']
);
$routes->post(
  'delete-category/(:num)',
  'HomeController::delete_category/$1',
  ['as' => 'delete-category']
);
$routes->post(
  'update-link/(:num)',
  'HomeController::update_link/$1',
  ['as' => 'update-link']
);
$routes->post(
  'add-link',
  'HomeController::add_link',
  ['as' => 'add-link']
);
$routes->post(
  'delete-link/(:num)',
  'HomeController::delete_link/$1',
  ['as' => 'delete-link']
);