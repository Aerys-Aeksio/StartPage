<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use SleekDB\Store;

class Home extends BaseController
{
  protected $admin;
  protected $settings;

  public function index(): string
  {
    $this->admin        = model(\App\Models\AdminModel::class);
    $data['settings']   = $this->admin->get_settings();
    $data['categories'] = $this->admin->get_categories();
    $data['links']      = $this->admin->get_links();

    return view('Index_Template', $data);
  }
}
