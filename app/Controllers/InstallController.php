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
    $this->admin  = model(\App\Models\AdminModel::class);

    $installed_time             = new \DateTime();
    $data["title"]              = 'Install Startpage';
    $data["database_dir_write"] = [];
    helper('date');
    
    if ($this->request->is("post"))
    {
      $base_url       = str_replace('/install', '', 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
      $adminusername  = !empty($this->request->getPost("administrator_username")) ? str_replace(' ', '', strtolower(esc($this->request->getPost("administrator_username")))) : "StartPage";
      $adminpassword  = !empty($this->request->getPost("password")) ? esc($this->request->getPost("password")) : "StartPage";
      $adminemail     = !empty($this->request->getPost("admin_email")) ? str_replace(' ', '',strtolower(esc($this->request->getPost("admin_email")))) : "startpage@placeholder.dev";

      if (!is_dir(DATABASE_DIR . "/settings"))
      {
        $configuration =
        [
          "auto_cache"          => FALSE,
          "cache_lifetime"      => null,
          "timeout"             => FALSE, // deprecated! Set it to FALSE!
          "primary_key"         => "id",
          "folder_permissions"  => 0777
        ];

        // Begin categories
        $categories_array =
        [
          [
            'name'                    =>  'bg-primary',
            'column'                  =>  '1',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-primary',
            'text_color_header'       =>  'text-light',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '100',
          ],
          [
            'name'                    =>  'bg-primary-subtle',
            'column'                  =>  '2',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-primary-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '100',
          ],
          [
            'name'                    =>  'bg-secondary',
            'column'                  =>  3,
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-secondary',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '100',
          ],
          [
            'name'                    =>  'bg-secondary-subtle',
            'column'                  =>  '4',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-secondary-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '100',
          ],
          [
            'name'                    =>  'bg-success',
            'column'                  =>  '1',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-success',
            'text_color_header'       =>  'text-light',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '99',
          ],
          [
            'name'                    =>  'bg-success-subtle',
            'column'                  =>  '2',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-success-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '99',
          ],
          [
            'name'                    =>  'bg-danger',
            'column'                  =>  3,
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-danger',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '99',
          ],
          [
            'name'                    =>  'bg-danger-subtle',
            'column'                  =>  '4',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-danger-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '99',
          ],
          [
            'name'                    =>  'bg-warning',
            'column'                  =>  '1',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-warning',
            'text_color_header'       =>  'text-light',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '98',
          ],
          [
            'name'                    =>  'bg-warning-subtle',
            'column'                  =>  '2',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-warning-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '98',
          ],
          [
            'name'                    =>  'bg-info',
            'column'                  =>  '3',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-info',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '98',
          ],
          [
            'name'                    =>  'bg-info-subtle',
            'column'                  =>  '4',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-info-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '98',
          ],
          [
            'name'                    =>  'bg-light',
            'column'                  =>  '1',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-light',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '97',
          ],
          [
            'name'                    =>  'bg-light-subtle',
            'column'                  =>  '2',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-light-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '97',
          ],
          [
            'name'                    =>  'bg-dark',
            'column'                  =>  '3',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-dark',
            'text_color_header'       =>  'text-light',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '97',
          ],
          [
            'name'                    =>  'bg-dark-subtle',
            'column'                  =>  '4',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-dark-subtle',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '97',
          ],
          [
            'name'                    =>  'bg-body-secondary',
            'column'                  =>  '1',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-body-secondary',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '96',
          ],
          [
            'name'                    =>  'bg-body-tertiary',
            'column'                  =>  '2',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-body-tertiary',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '96',
          ],
          [
            'name'                    =>  'bg-body',
            'column'                  =>  '3',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-body',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '96',
          ],
          [
            'name'                    =>  'bg-black',
            'column'                  =>  '4',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-black',
            'text_color_header'       =>  'text-light',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '96',
          ],
          [
            'name'                    =>  'bg-white',
            'column'                  =>  '1',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-white',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '95',
          ],
          [
            'name'                    =>  'bg-transparent',
            'column'                  =>  '2',
            'numb_links'              =>  '5',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  'bg-transparent',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '95',
          ],
          [
            'name'                    =>  'Startpage built with',
            'column'                  =>  '1',
            'numb_links'              =>  '4',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  '',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '0',
          ],
          [
            'name'                    =>  'Css Frameworks',
            'column'                  =>  '2',
            'numb_links'              =>  '4',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  '',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '0',
          ],
          [
            'name'                    =>  'Php Frameworks',
            'column'                  =>  '3',
            'numb_links'              =>  '4',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  '',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '0',
          ],
          [
            'name'                    =>  'Misc',
            'column'                  =>  '4',
            'numb_links'              =>  '4',
            'icon'                    =>  '',
            'side_icon'               =>  '',
            'background_color_header' =>  '',
            'text_color_header'       =>  'text-dark',
            'background_color_footer' =>  'bg-primary',
            'link_color_footer'       =>  'link-light',
            'link_color_list'         =>  'link-dark',
            'visible'                 =>  '1',
            'position'                =>  '0',
          ],
        ];
        // Create Table categories
        $categories = new Store("categories", DATABASE_DIR, $configuration);
        // Insert Array's categories
        $categories->InsertMany($categories_array);
        // End categories

        // Begin links
        $links_array =
        [
          [
            'name'        =>  'Bootstrap',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  '23',
            'title'       =>  'Bootstrap',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Codeigniter',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  '23',
            'title'       =>  'Codeigniter',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'SleekDB',
            'url'         =>  'https://sleekdb.github.io',
            'category_id' =>  '23',
            'title'       =>  'SleekDB',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Favicon',
            'url'         =>  'https://favicon.io',
            'category_id' =>  '23',
            'title'       =>  'Favicon',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Font Awesome',
            'url'         =>  'https://fontawesome.com',
            'category_id' =>  '23',
            'title'       =>  'Font Awesome',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Bootstrap',
            'url'         =>  'http://getbootstrap.com',
            'category_id' =>  '24',
            'title'       =>  'Bootstrap',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Bulma',
            'url'         =>  'https://bulma.io',
            'category_id' =>  '24',
            'title'       =>  'Bulma',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Foundation',
            'url'         =>  'https://get.foundation',
            'category_id' =>  '24',
            'title'       =>  'Foundation',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Materialize',
            'url'         =>  'https://materializecss.github.io/materialize',
            'category_id' =>  '24',
            'title'       =>  'Materialize',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Tailwind',
            'url'         =>  'https://tailwindcss.com',
            'category_id' =>  '24',
            'title'       =>  'Tailwind',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Codeigniter',
            'url'         =>  'http://codeigniter.com',
            'category_id' =>  '25',
            'title'       =>  'Codeigniter',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '100',
          ],
          [
            'name'        =>  'Laravel',
            'url'         =>  'http://laravel.com',
            'category_id' =>  '25',
            'title'       =>  'Laravel',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '99',
          ],
          [
            'name'        =>  'Symfony',
            'url'         =>  'https://symfony.com',
            'type'        =>  'list', //'list','img','html'
            'category_id' =>  '25',
            'title'       =>  'Symfony',
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '98',
          ],
          [
            'name'        =>  'Laminas',
            'url'         =>  'https://getlaminas.org',
            'category_id' =>  '25',
            'title'       =>  'Laminas',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '98',
          ],
          [
            'name'        =>  'Yii',
            'url'         =>  'https://www.yiiframework.com',
            'category_id' =>  '25',
            'title'       =>  'Yii',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '97',
          ],
          [
            'name'        =>  'Base64decode',
            'url'         =>  'https://www.base64decode.org',
            'category_id' =>  '26',
            'title'       =>  'Base64decode',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '97',
          ],
          [
            'name'        =>  'Logo',
            'url'         =>  'https://logo.com',
            'category_id' =>  '26',
            'title'       =>  'Logo',
            'type'        =>  'list', //'list','img','html'
            'img'         =>  '',
            'html'        =>  '',
            'target'      =>  '1', // 0 = same tab 1 = new tab
            'visible'     =>  '1', // 0 = no 1 = yes
            'icon'        =>  '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
            'side_icon'   =>  '1', // 1 = left and 0 = right
            'position'    =>  '96',
          ],
        ];
        // Create the Table links
        $categories = new Store("links", DATABASE_DIR, $configuration);
        // Insert the Array's links
        $categories->InsertMany($links_array);
        // End links

        // Begin users
        $users_configuration = [
          "auto_cache"          => FALSE,
          "cache_lifetime"      => null,
          "timeout"             => FALSE, // deprecated! Set it to FALSE!
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
          "addCategory"     => '1',
          "delCategory"     => '1',
          "editCategory"    => '1',
          "addLink"         => '1',
          "delLink"         => '1',
          "editLink"        => '1',
          "changeSettings"  => '1',
          "manageUsers"     => '1',
        ];
        // Create Table users
        $users_table = new Store("users", DATABASE_DIR, $users_configuration);
        // Insert Array's users
        $users_table->Insert($users_array);
        // End users

        // Begin settings
        $settings_array = 
        [
          "title"                     =>  'Startpage',
          "description"               =>  'What is a Startpage',
          "footer"                    =>  "Copyright ©",
          "show_footer"               =>  '0', // 0 = no 1 = yes
          "version"                   =>  "0.0.1",
          "timestamp_installed"       =>  ''.$installed_time->getTimestamp().'',
          "redirect_time"             =>  '2',
          "base_url"                  =>  $base_url,
          "email"                     =>  $adminemail,
          "body_background"           =>  "bg-dark-subtle",
          "nav_background"            =>  "bg-primary",
          "nav_link_color"            =>  "link-light",
          "show_login_link"           =>  '1',
          "head"                      =>  '',
          "foot"                      =>  '',
        ];
        // Create Table settings
        $settings  = new Store("settings", DATABASE_DIR, $configuration);
        // Insert ARRAY settings
        $settings->Insert($settings_array);
        // End settings

        $settings_Table = new Store('settings', DATABASE_DIR);
        $settings_Table = $settings_Table
          ->CreateQueryBuilder()
          ->disableCache()
          ->getQuery()
          ->fetch();
        $settings_Table = array_shift($settings_Table);

        $data['time'] 	          = '2';
        $data['message']          = 'Well Done. Startpage is installed';
        $data['destination_url']  = $settings_Table['base_url'];

        return view('Redirect-Template', $data);
      }
      $data['time'] 	          = '2';
      $data['message']          = 'Well Done. Startpage is installed';
      $data['destination_url']  = $settings_Table['base_url'];
      return view('Redirect-Template', $data);
    }
    else
    {
      $database_dir_write = is_wriTable(DATABASE_DIR);
      $data["database_dir_write"] = ($database_dir_write) ? 1 : 0;
    }
    return view("Install-Template/Install-Template", $data);
  }
}

/* End of file InstallController.php */
/* Location: ./app/Controllers/InstallController.php */