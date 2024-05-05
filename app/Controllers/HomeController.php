<?php

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

}