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

namespace App\Models;

use CodeIgniter\Model;
use SleekDB\Store;

class AdminModel extends Model
{

  public function __construct()
  {

  }

  /**
   * [Log user in on success]
   *
   * @param mixed $email
   * @param mixed $password
   * 
   * @return [bool]
   * 
   */
  function login($email, $password)
  {
    $users_configuration =
    [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "user_id",
      "folder_permissions"  => 0777
    ];
    $session    = \Config\Services::session();
    $user_table = new Store("users", DATABASE_DIR, $users_configuration);
    $user       = $user_table
      ->createQueryBuilder()
      ->where([ "email", "=", strtolower($email) ])
      ->disableCache()
      ->getQuery()
      ->fetch();
    $user=array_shift($user);
    // Verify password
    if (password_verify($password, $user["password"]) == TRUE)
    {
        $newdata =
        [
          "id"        => $user["user_id"],
          "username"  => $user["username"],
          "email"     => $user["email"],
          "logged_in" => TRUE,
        ];
        $session->set("id",        $newdata["id"]);
        $session->set("username",  $newdata["username"]);
        $session->set("email",     $newdata["email"]);
        $session->set("logged_in", $newdata["logged_in"]);
        return TRUE;
    }
    else
      return FALSE;
  }

  /**
   * [Fetch all settings of the site from the settings table]
   *
   * @return [array]
   * 
   */
  public function get_settings(): array
  {
    $settings = new Store('settings', DATABASE_DIR);
    $settings = $settings->createQueryBuilder()->useCache(300)->regenerateCache()->getQuery()->fetch();
    $settings = array_shift($settings);
    return $settings;
  }

  /**
   * [Fetch all links of the site from the links table]
   *
   * @return [array]
   * 
   */
  public function get_links(): array
  {
    $configuration = [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $links = new Store('links', DATABASE_DIR, $configuration);
    $links = $links->findAll();
    return $links;
  }

  /**
   * [Description for update_settings]
   *
   * @param mixed $array
   * 
   * @return [bool]
   * 
   */
  public function update_settings($array)
  {
    $configuration =
    [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $settings = new Store('settings', DATABASE_DIR, $configuration);
    $settings->updateById(1, $array);

    $settings
      ->createQueryBuilder()
      ->disableCache()
      ->getQuery()
      ->fetch();
    return TRUE;
  }

  /**
   * [Description for update_category]
   *
   * @param mixed $array
   * @param mixed $id
   * 
   * @return [bool]
   * 
   */
  public function update_category($array, $id)
  {
    $configuration =
    [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $update_category = new Store('categories', DATABASE_DIR, $configuration);
    $update_category->updateById($id, $array);
    return TRUE;
  }

  /**
   * [Description for update_link]
   *
   * @param mixed $array
   * @param mixed $id
   * 
   * @return [bool]
   * 
   */
  public function update_link($array)
  {
    $configuration =
    [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $update_category = new Store('links', DATABASE_DIR, $configuration);
    $update_category->updateOrInsert($array);
    return TRUE;
  }

  /**
   * [Description for delete_link]
   *
   * @param mixed $array
   * @param mixed $id
   * 
   * @return [bool]
   * 
   */
  public function delete_link($id)
  {
    $configuration =
    [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $update_category = new Store('links', DATABASE_DIR, $configuration);
    $update_category->deleteById($id);
    return TRUE;
  }

  /**
   * [Description for get_categories]
   *
   * @return [array]
   * 
   */
  public function get_categories(): array
  {
    $configuration = [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $categories = new Store('categories', DATABASE_DIR, $configuration);
    $categories = $categories
      ->createQueryBuilder()
      ->orderBy([ "column" =>  "asc" ])
      ->orderBy([ "position" =>  "desc" ])
      ->disableCache()
      ->getQuery()
      ->fetch();
    return $categories;
  }

  /**
   * [Description for add_category]
   *
   * @param mixed $array
   * 
   * @return [bool]
   * 
   */
  public function add_category($array): bool
  {
    $configuration = [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $add_category = new Store('categories', DATABASE_DIR, $configuration);
    $add_category->insert($array);
    return TRUE;
  }

  /**
   * [delete_category deletes category]
   *
   * @param mixed $array
   * 
   * @return [bool]
   * 
   */
  public function delete_category($id)
  {
    $configuration = [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $categories = new Store("categories", DATABASE_DIR, $configuration);
    $categories->deleteById($id);
    return TRUE;
  }

  /**
   * [Description for numb_links]
   *
   * @param mixed $cat_id
   * @param mixed $number_link_in_category
   * 
   * @return [type]
   * 
   */
  function numb_links($cat_id, $number_link_in_category)
  {
    $configuration = [
      "auto_cache"          => FALSE,
      "cache_lifetime"      => NULL,
      "timeout"             => FALSE, // deprecated! Set it to FALSE!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $links = new Store("links", DATABASE_DIR, $configuration);
    $links = $links
      ->createQueryBuilder()
      ->where([ 'category_id', "=", "".$cat_id."" ])
      ->regenerateCache()
      ->getQuery()
      ->fetch();
    $numb = count($links);
    if($numb == $number_link_in_category)
      return 0;
    elseif($numb < $number_link_in_category)
      return 0;
    else
      return 1;
  }

}

/* End of file AdminModel.php */
/* Location: ./app/Models/AdminModel.php */