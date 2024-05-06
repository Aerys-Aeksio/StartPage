<?php
/**
 *
 * This file is part of StartPage
 *
 * @copyright 2024-2024 (c) Daniël Rokven
 *
 * @license Mit
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use SleekDB\Store;

class HomeController extends BaseController
{
  protected $admin;
  protected $settings;
  protected $categories;
  protected $links;

  public function __construct()
  {
    $this->admin  = model(\App\Models\AdminModel::class);
    helper('form');
  }

  public function index(): string
  {
    $data               = $this->_get_data();
    $data['logged_in']  = ($this->_loggedin()) ? TRUE : FALSE;
    $data['more']       = [];
    foreach($data['categories'] as $key => $value)
    {
      $data['more'][$value['id']] = $this->admin->numb_links($value['id'], $value['numb_links']);
    }
    $data['time'] = Time::createFromTimestamp($data['settings']['timestamp_installed'], 'America/Chicago', 'en_US');
    return view('Index_Template', $data);
  }

  public function login()
  {
    if($this->_loggedin() == TRUE)
      return redirect('/');

    if (!$this->request->is("post"))
    {
      $data['settings'] = $this->admin->get_settings();
      return view('Login-Template', $data);
    }
    else
    {
      $email    = $this->request->getPost("email");
      $password = $this->request->getPost("password");
      $user     = $this->admin->login(esc($email), esc($password));

      $data                     = [];
      $data['logged_in']        = $this->_loggedin();
      $data['settings']         = $this->admin->get_settings();
      $data['time']             = $data['settings']['redirect_time'];
      $data['message']          = 'You are now logged in.';
      $data['destination_url']  = url_to('/');
      return view("/Redirect-Template", $data);
    }
  }

  private function _get_data()
  {
    $data['settings']   = $this->admin->get_settings();
    $data['categories'] = $this->admin->get_categories();
    $data['links']      = $this->admin->get_links();
    return $data;
  }

  private function _loggedin()
  {
    $session = \Config\Services::session();
    if(isset($session->logged_in))
      return TRUE;
    else
      return FALSE;
  }

  public function logout()
  {
    $session = \Config\Services::session();
    $session->set("id", "");
    $session->set("username", "");
    $session->set("logged_in", "");
    $session->destroy();

    $data['settings']   = $this->admin->get_settings();
    $data['time'] = $data['settings']['redirect_time'];
    $data['destination_url'] = url_to('/');
    $data['message'] = 'You have been Logged out';
    return view("/Redirect-Template", $data);
  }

  public function edit_settings()
  {
    if (!$this->request->is("post"))
      return redirect('/');
    else
    {
      $data['settings'] = $this->admin->get_settings();
      $newdata =
      [
        "title"                     =>  $this->request->getPost('title'),
        "description"               =>  $this->request->getPost('description'),
        "footer"                    =>  $this->request->getPost('footer'),
        "show_footer"               =>  $this->request->getPost('show_footer'), // 0 = no 1 = yes
        "version"                   =>  $this->request->getPost('version'),
        "timestamp_installed"       =>  $this->request->getPost('timestamp_installed'),
        "redirect_time"             =>  $this->request->getPost('redirect_time'),
        "base_url"                  =>  $this->request->getPost('base_url'),
        "email"                     =>  $this->request->getPost('email'),
        "body_background"           =>  $this->request->getPost('body_background'),
        "nav_background"            =>  $this->request->getPost('nav_background'),
        "nav_link_color"            =>  $this->request->getPost('nav_link_color'),
        "show_login_link"           =>  $this->request->getPost('show_login_link'),
        "head"                      =>  $this->request->getPost('head'),
        "foot"                      =>  $this->request->getPost('foot'),
      ];
      $this->admin->update_settings($newdata);
      $data['settings']   = $this->admin->get_settings();
      $data['time'] = $data['settings']['redirect_time'];
      $data['destination_url'] = url_to('/');
      $data['message'] = 'Your settings are saved..';
      return view("/Redirect-Template", $data);
  
    }
  }
}