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
use SleekDB\Store;
use CodeIgniter\I18n\Time;

class InstallController extends BaseController
{
  public function index()
  {
    if (is_dir(DATABASE_DIR . "/settings"))
    {
      echo 'Startpage is already installed';
      exit;
    }
    $this->admin    = model(\App\Models\AdminModel::class);

    $installed_time = new \DateTime();
    $data["title"]              = 'Install Startpage';
    $data["database_dir_write"] = [];
    helper('date');
    
    if ($this->request->is("post"))
    {
      $title          = !empty($this->request->getPost("title")) ? esc($this->request->getPost("title")) : "Startpage";
      $description    = !empty($this->request->getPost("desc")) ? esc($this->request->getPost("desc")) : "";
      $c_url          = str_replace('/install', '', 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
      $base_url       = !empty($this->request->getPost("base_url")) ? esc($this->request->getPost("base_url")) : $c_url;
      $adminusername  = !empty($this->request->getPost("administrator_username")) ? str_replace(' ', '', strtolower(esc($this->request->getPost("administrator_username")))) : "admin";
      $adminpassword  = !empty($this->request->getPost("password")) ? esc($this->request->getPost("password")) : "admin";
      $adminemail     = !empty($this->request->getPost("admin_email")) ? str_replace(' ', '',strtolower(esc($this->request->getPost("admin_email")))) : "info@forgotten-email.dev";

      if (!is_dir(DATABASE_DIR . "/settings"))
      {
        $configuration = [
          "auto_cache"          => false,
          "cache_lifetime"      => null,
          "timeout"             => false, // deprecated! Set it to false!
          "primary_key"         => "id",
          "folder_permissions"  => 0777
        ];

        // BEGIN categories
        $categories_array =
        [
          [
            'name'                =>  'bg-primary',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-primary',
            'text_color'          =>  'text-light',
            'visible'             =>  1,
            'position'            =>  100,
          ],
          [
            'name'                =>  'bg-primary-subtle',
            'column'              =>  2,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-primary-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  100,
          ],
          [
            'name'                =>  'bg-secondary',
            'column'              =>  3,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-secondary',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  100,
          ],
          [
            'name'                =>  'bg-secondary-subtle',
            'column'              =>  4,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-secondary-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  100,
          ],
          [
            'name'                =>  'bg-success',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-success',
            'text_color'          =>  'text-light',
            'visible'             =>  1,
            'position'            =>  99,
          ],
          [
            'name'                =>  'bg-success-subtle',
            'column'              =>  2,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-success-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  99,
          ],
          [
            'name'                =>  'bg-danger',
            'column'              =>  3,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-danger',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  99,
          ],
          [
            'name'                =>  'bg-danger-subtle',
            'column'              =>  4,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-danger-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  99,
          ],
          [
            'name'                =>  'bg-warning',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-warning',
            'text_color'          =>  'text-light',
            'visible'             =>  1,
            'position'            =>  98,
          ],
          [
            'name'                =>  'bg-warning-subtle',
            'column'              =>  2,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-warning-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  98,
          ],
          [
            'name'                =>  'bg-info',
            'column'              =>  3,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-info',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  98,
          ],
          [
            'name'                =>  'bg-info-subtle',
            'column'              =>  4,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-info-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  98,
          ],
          [
            'name'                =>  'bg-light',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-light',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  97,
          ],
          [
            'name'                =>  'bg-light-subtle',
            'column'              =>  2,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-light-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  97,
          ],
          [
            'name'                =>  'bg-dark',
            'column'              =>  3,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-dark',
            'text_color'          =>  'text-light',
            'visible'             =>  1,
            'position'            =>  97,
          ],
          [
            'name'                =>  'bg-dark-subtle',
            'column'              =>  4,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-dark-subtle',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  97,
          ],
          [
            'name'                =>  'bg-body-secondary',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-body-secondary',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  96,
          ],
          [
            'name'                =>  'bg-body-tertiary',
            'column'              =>  2,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-body-tertiary',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  96,
          ],
          [
            'name'                =>  'bg-body',
            'column'              =>  3,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-body',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  96,
          ],
          [
            'name'                =>  'bg-black',
            'column'              =>  4,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-black',
            'text_color'          =>  'text-light',
            'visible'             =>  1,
            'position'            =>  96,
          ],
          [
            'name'                =>  'bg-white',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-white',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  95,
          ],
          [
            'name'                =>  'bg-transparent',
            'column'              =>  2,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  'bg-transparent',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  95,
          ],
          [
            'name'                =>  'Startpage built with',
            'column'              =>  1,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  '',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  0,
          ],
          [
            'name'                =>  'Css Frameworks',
            'column'              =>  2,
            'more'                =>  1, // 0 = no 1 = yes
            'link_to_more'        =>  'https://github.com/troxler/awesome-css-frameworks#awesome-css-frameworks-',
            'link_to_more_target' =>  1, // 0 is same tab 1 = new tab
            'icon'                =>  '',
            'background_color'    =>  '',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  0,
          ],
          [
            'name'                =>  'Php Frameworks',
            'column'              =>  3,
            'more'                =>  0, // 0 = no 1 = yes
            'link_to_more'        =>  '',
            'link_to_more_target' =>  1,
            'icon'                =>  '',
            'background_color'    =>  '',
            'text_color'          =>  'text-dark',
            'visible'             =>  1,
            'position'            =>  0,
          ],
        ];
        // CREATE TABLE categories
        $categories = new Store("categories", DATABASE_DIR, $configuration);
        // INSERT ARRAY'S categories
        $categories->insertMany($categories_array);
        // END categories

        // BEGIN links
        $links_array =
        [
          [
            'name'        =>  'Bootstrap',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  23,
            'title'       =>  'Bootstrap',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Codeigniter',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  23,
            'title'       =>  'Codeigniter',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'SleekDB',
            'url'         =>  'https://sleekdb.github.io',
            'category_id' =>  23,
            'title'       =>  'SleekDB',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Favicon',
            'url'         =>  'https://favicon.io',
            'category_id' =>  23,
            'title'       =>  'Favicon',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Font Awesome',
            'url'         =>  'https://fontawesome.com',
            'category_id' =>  23,
            'title'       =>  'Font Awesome',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Bootstrap',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  24,
            'title'       =>  'Bootstrap',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Bulma',
            'url'         =>  'https://bulma.io',
            'category_id' =>  24,
            'title'       =>  'Bulma',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Foundation',
            'url'         =>  'https://get.foundation',
            'category_id' =>  24,
            'title'       =>  'Foundation',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Materialize',
            'url'         =>  'https://materializecss.github.io/materialize',
            'category_id' =>  24,
            'title'       =>  'Materialize',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Tailwind',
            'url'         =>  'https://tailwindcss.com',
            'category_id' =>  24,
            'title'       =>  'Tailwind',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Codeigniter',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  25,
            'title'       =>  'Codeigniter',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  100,
          ],
          [
            'name'        =>  'Laravel',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  25,
            'title'       =>  'Laravel',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  99,
          ],
          [
            'name'        =>  'Symfony',
            'url'         =>  'https://symfony.com',
            'type'        =>  'list', //'list','img','html'
            'category_id' =>  25,
            'title'       =>  'Symfony',
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  98,
          ],
          [
            'name'        =>  'Laminas',
            'url'         =>  'https://getlaminas.org',
            'category_id' =>  25,
            'title'       =>  'Laminas',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  98,
          ],
          [
            'name'        =>  'Yii',
            'url'         =>  'https://www.yiiframework.com',
            'category_id' =>  25,
            'title'       =>  'Yii',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'link_open'   =>  1, // 0 = same tab 1 = new tab
            'visible'     =>  1, // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'icon_place'  =>  0, // 0 = left  1 = right
            'position'    =>  97,
          ],
        ];
        // CREATE the TABLE links
        $categories = new Store("links", DATABASE_DIR, $configuration);
        // INSERT the ARRAY'S links
        $categories->insertMany($links_array);
        // END links

        // BEGIN users
        $users_configuration = [
          "auto_cache"          => false,
          "cache_lifetime"      => null,
          "timeout"             => false, // deprecated! Set it to false!
          "primary_key"         => "user_id",
          "folder_permissions"  => 0777
        ];
        $adminpassword = password_hash($adminpassword,PASSWORD_BCRYPT);
        $users_array =
        [
          "username"        => $adminusername,
          "password"        => $adminpassword,
          "email"           => $adminemail,
          "title"           => "Administrator",
          "time_format"     => "",
          "date_format"     => "",
          "language"        => "eng",
          "style"           => "default",
          "registered"      => time(),
          "registration_ip" => esc($this->request->getIPAddress()),
          "addCategory"     => 1,
          "delCategory"     => 1,
          "editCategory"    => 1,
          "addLink"         => 1,
          "delLink"         => 1,
          "editLink"        => 1,
          "changeSettings"  => 1,
          "manageUsers"     => 1,
        ];

        // CREATE TABLE users
        $users_table = new Store("users", DATABASE_DIR, $users_configuration);
        // INSERT ARRAY'S users
        $users_table->insert($users_array);
        $users = $users_table->count();
        // CREATE CACHE users
        $users = $users_table->createQueryBuilder()->disableCache()->getQuery()->fetch();
        // END users

        // BEGIN settings
        $settings_array = 
        [
          "title"                   =>  $title,
          "description"             =>  $description,
          "footer"                  =>  "Copyright ©",
          "show_footer"             =>  1, // 0 = no 1 = yes
          "version_startpage"       =>  "0.0.1",
          "timestamp_installed"     =>  $installed_time->getTimestamp(),
          "default_user_group"      =>  4,
          "redirect_time"           =>  2,
          "base_url"                =>  $base_url,
          "board_email"             =>  $adminemail,
          "favicon"                 =>  "favicon.ico",
          "favicon16"               =>  "favicon-16x16.png",
          "favicon32"               =>  "favicon-32x32.png",
          "apple_touch_icon"        =>  "apple-touch-icon.png",
          "android_chrome_192x192"  =>  "android-chrome-192x192.png",
          "android_chrome_512x512"  =>  "android-chrome-512x512.png",
          "webmanifest"             =>  "site.webmanifest",
          "body_background"         =>  "bg-light",
          "nav_background"          =>  "bg-primary-subtle",
          "nav_link_color"          =>  "text-dark",
          "show_footer"             =>  1,
          "show_login_link"         =>  1,
        ];
        // CREATE TABLE settings
        $settings  = new Store("settings", DATABASE_DIR, $configuration);
        // INSERT ARRAY settings
        $settings->insert($settings_array);
        // CREATE CACHE settings
        $settings = $settings->createQueryBuilder()->disableCache()->getQuery()->fetch();
        // End settings

        $settings_table = new Store('settings', DATABASE_DIR);
        $settings_table = $settings_table
          ->createQueryBuilder()
          ->useCache(300)
          ->regenerateCache()
          ->getQuery()
          ->fetch();
          $settings_table = array_shift($settings_table);

        $data['time'] 	          = '2';
        $data['message']          = 'Well Done. Startpage is installed';
        $data['destination_url']  = $settings_table['base_url'];

        return view('Admin/Admin-Redirect-Template', $data);
      }
      $data['time'] 	          = '2';
      $data['message']          = 'Well Done. Startpage is installed';
      $data['destination_url']  = $settings_table['base_url'];
      return view('Admin/Admin-Redirect-Template', $data);
    }
    else
    {
      $database_dir_write = is_writable(DATABASE_DIR);

      $data["database_dir_write"] = ($database_dir_write) ? 1 : 0;
    }
    return view("Install-Template/Install-Template", $data);
  }
}

/* End of file InstallController.php */
/* Location: ./app/Controllers/InstallController.php */