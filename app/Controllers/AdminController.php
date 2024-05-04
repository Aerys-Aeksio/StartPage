<?php
/**
 *
 * This file is part of Startpage
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

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\I18n\Time;
use SleekDB\Store;

class AdminController extends BaseController
{
  protected $admin;
  protected $fb_settings;

  public function __construct()
  {
    $this->admin    = model(\App\Models\AdminModel::class);
  }

  /**
   * [Admin Dashboard]
   *
   * @return string
   * 
   */
  public function index(): string
  {
    define('__PAGENAME__', 'Dashboard');
    $data['fb_settings']  = $this->admin->fetch_settings_table();
    $default_lang         = $data['fb_settings']['language']['default'];
    $data['lang']         = lang($default_lang, 'backend', 'dashboard');
    $data['categories'] = $this->admin->get_categories();

    return view('Admin/Admin-Index-Template', $data);
  }

  /**
   * [Description for settings]
   *
   * @return [type]
   * 
   */
  public function settings()
  {
    define('__PAGENAME__', 'Settings');
    $data['fb_settings']    = $this->admin->fetch_settings_table();
    $default_lang           = $data['fb_settings']['language']['default'];
    $data['lang']           = lang($default_lang, 'backend', 'settings');
    $data['time_installed'] = Time::createFromTimestamp($data['fb_settings']['general']['timestamp_installed'], 'Europe/Amsterdam', 'nl_NL');

    if (!$this->request->is("post"))
      return view('Admin/Admin-Settings-Template', $data);
    else
    {
      $settings =
      [
        [
          'general' =>
          [
              'title'               => $this->request->getPost('title'),
              'slogan'              => $this->request->getPost('slogan'),
              'description'         => $this->request->getPost('description'),
              'footer'              => $this->request->getPost('footer'),
              'footer_show_version' => $this->request->getPost('footer_show_version'),
              'version_fusionboard' => $this->request->getPost('version_fusionboard'),
              'rules'               => $this->request->getPost('rules'),
              'rules_message'       => $this->request->getPost('rules_message'),
              'timestamp_installed' => $data['fb_settings']['general']['timestamp_installed'],
              'default_user_group'  => $this->request->getPost('default_user_group'),
              'censoring'           => $this->request->getPost('censoring'),
              'redirect_time'       => $this->request->getPost('redirect_time'),
          ],
          'advanced' =>
          [
              'posts_per_topic' => $this->request->getPost('posts_per_topic'),
              'base_url'        => $this->request->getPost('base_url'),
              'board_email'     => $this->request->getPost('email'),
          ],
          'seo' =>
          [
              'format_startpage'  => $this->request->getPost('format_startpage'),
              'format_viewforum'  => $this->request->getPost('format_viewforum'),
              'format_viewtopic'  => $this->request->getPost('format_viewtopic'),
              'format_help'       => $this->request->getPost('format_help'),
          ],
          'social_networks' =>
          [
            'codepen'   => $this->request->getPost('codepen'),
            'facebook'  => $this->request->getPost('facebook'),
            'gitlab'    => $this->request->getPost('gitlab'),
            'github'    => $this->request->getPost('github'),
            'instagram' => $this->request->getPost('instagram'),
            'linkedin'  => $this->request->getPost('linkedin'),
            'mastodon'  => $this->request->getPost('mastodon'),
            'vk'        => $this->request->getPost('vk'),
            'x/twitter' => $this->request->getPost('x'),
            'xing'      => $this->request->getPost('xing'),
          ],
          'images' =>
          [
            'width'   => $this->request->getPost('thumbwidth'),
            'height'  => $this->request->getPost('thumbheight'),
            'quality' => $this->request->getPost('thumbquality'),
          ],
          'language' =>
          [
            'default'             => $this->request->getPost('language_board'),
            'timezone'            => $this->request->getPost('timezone'),
            'time_format'         => (empty($this->request->getPost('time_format')) ? 'H:i:s' : $this->request->getPost('time_format')),
            'date_format'         => (empty($this->request->getPost('date_format')) ? 'd-m-Y' : $this->request->getPost('date_format')),
            'installed_languages' =>
            [
              'English',
              'Dutch',
            ],
          ],
          'logo_board' =>
          [
            'data'  => $this->request->getPost('logo1'),
          ],
        ],
      ];
      $this->admin->update_settings($settings);
      $data['destination_url']  = 'settings';
      $data['time']             = $data['fb_settings']['general']['redirect_time'];
      $data['lang']['message']          = $data['lang']['redirect_success_message'];

    return view('Admin/Admin-Redirect-Template', $data);
    }
  }
  
  /**
   * [Description for upload]
   *
   * @return string
   * 
   */
  public function upload(): string
  {
    define('__PAGENAME__', 'Upload');
    $data['fb_settings']  = $this->admin->fetch_settings_table();
    $default_lang         = $data['fb_settings']['language']['default'];
    $data['lang']         = lang($default_lang, 'backend', 'upload');
    return view('Admin/Admin-Upload-Template', $data);
  }

  /**
   * [Description for plugins]
   *
   * @return string
   * 
   */
  public function plugins(): string
  {
    define('__PAGENAME__', 'Plugins');
    $data['fb_settings']  = $this->admin->fetch_settings_table();
    $default_lang         = $data['fb_settings']['language']['default'];
    $data['lang']         = lang($default_lang, 'backend', 'plugins');
    return view('Admin/Admin-Plugins-Template', $data);
  }

  /**
   * [Description for themes]
   *
   * @return string
   * 
   */
  public function themes(): string
  {
    define('__PAGENAME__', 'Themes');
    $data['fb_settings']  = $this->admin->fetch_settings_table();
    $default_lang         = $data['fb_settings']['language']['default'];
    $data['lang']         = lang($default_lang, 'backend', 'themes');
    return view('Admin/Admin-Themes-Template', $data);
  }

  /**
   * [Description for about_fusionboard]
   *
   * @return string
   * 
   */
  public function about_fusionboard()
  {
    define('__PAGENAME__', 'About FusionBoard');
    $data['fb_settings']  = $this->admin->fetch_settings_table();
    $default_lang         = $data['fb_settings']['language']['default'];
    $data['lang']         = lang($default_lang, 'backend', 'about');
    $data['time_installed'] = Time::createFromTimestamp($data['fb_settings']['general']['timestamp_installed'], 'Europe/Amsterdam', 'nl_NL');
    return view('Admin/Admin-About-FusionBoard-Template', $data);
  }

  /**
   * [Description for forums_categories]
   *
   * @return string
   * 
   */
  public function forums_categories()
  {
    define('__PAGENAME__', 'Forums and Categories');
    $data['fb_settings']      = $this->admin->fetch_settings_table();
    $default_lang             = $data['fb_settings']['language']['default'];
    $data['lang']             = lang($default_lang, 'backend', 'forumsandcategories');
    $data['time'] 	          = $data['fb_settings']['general']['redirect_time'];
    $data['destination_url']  = 'forums-categories';

    if (!$this->request->is("post"))
    {
      $data['categories'] = $this->admin->get_categories();
      return view('Admin/Admin-Forums-Categories-Template', $data);
    }
    else
    {
      $configuration = [
        "auto_cache"          => true,
        "cache_lifetime"      => null,
        "timeout"             => false, // deprecated! Set it to false!
        "primary_key"         => "id",
        "folder_permissions"  => 0777
      ];

      if(!empty($this->request->getPost('addforum')))
      {
        $addforum = [
          'category_id' =>  $this->request->getPost('category_id'),
          'name'        =>  $this->request->getPost('forum_name'),
          'description' =>  $this->request->getPost('forum_description'),
          'height'      =>  $this->request->getPost('forum_height'),
        ];
        if($addforum['height'] == '')
          $addforum['height'] = 50;

        $this->admin->add_forum($addforum);
        $data['lang']['message'] = $data['lang']['redirect_success_message_forum'];
        return view('Admin/Admin-Redirect-Template', $data);
      }

      if(!empty($this->request->getPost('addcategory')))
      {
        $parent_id = ($this->request->getPost('category_parent_id') == "null") ? null : $this->request->getPost('category_parent_id');
        $data_category = [
          'parent_id'   =>  $parent_id,
          'name'        =>  $this->request->getPost('category_name'),
          'description' =>  $this->request->getPost('category_desc'),
          'position'    =>  $this->request->getPost('category_position'),
        ];

        $this->admin->add_category($data_category);
        $data['lang']['message'] = $data['lang']['redirect_success_message_category'];
        return view('Admin/Admin-Redirect-Template', $data);
      }

      if(!empty($this->request->getPost('delete_category')))
      {
        $id = $this->request->getPost('delete_category');
        $this->admin->delete_category($id);
        $data['lang']['message'] = $data['lang']['redirect_success_message_delete_category'];
        return view('Admin/Admin-Redirect-Template', $data);
      }

      return view('Admin/Admin-Forums-Categories-Template', $data);
    }
  }

}

/* End of file AdminController.php */
/* Location: ./app/Controllers/AdminController.php */