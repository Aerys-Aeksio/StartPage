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
      "auto_cache"          => true,
      "cache_lifetime"      => null,
      "timeout"             => false, // deprecated! Set it to false!
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
   * @return [boolean]
   * 
   */
  public function update_settings($array)
  {
    $configuration = [
      "auto_cache" => true,
      "cache_lifetime" => null,
      "timeout" => false, // deprecated! Set it to false!
      "primary_key" => "id",
      "folder_permissions" => 0777
    ];
    $settings = new Store('fusionboard_settings', DATABASE_DIR, $configuration);
    $settings->updateById(1, $array );

    $settings->createQueryBuilder()->useCache(0)->regenerateCache()->getQuery()->fetch();
    return true;
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
      "auto_cache"          => true,
      "cache_lifetime"      => null,
      "timeout"             => false, // deprecated! Set it to false!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $categories = new Store('categories', DATABASE_DIR, $configuration);
    $categories = $categories
      ->createQueryBuilder()
      ->orderBy([ "column" =>  "asc" ])
      ->orderBy([ "position" =>  "desc" ])
      ->getQuery()
      ->fetch();
    return $categories;
  }

  public function add_category($array): bool
  {
    $configuration = [
      "auto_cache"          => false,
      "cache_lifetime"      => null,
      "timeout"             => false, // deprecated! Set it to false!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $add_category = new Store('categories', DATABASE_DIR, $configuration);
    $add_category->insert($array);
    return true;
  }

  /**
   * [delete_category deletes category]
   *
   * @param mixed $array
   * 
   * @return
   * 
   */
  public function delete_category($id)
  {
    $configuration = [
      "auto_cache"          => false,
      "cache_lifetime"      => null,
      "timeout"             => false, // deprecated! Set it to false!
      "primary_key"         => "id",
      "folder_permissions"  => 0777
    ];
    $fusionboard_categories = new Store("categories", DATABASE_DIR, $configuration);
    $fusionboard_categories
      ->createQueryBuilder()
      ->getQuery()
      ->delete();
    $fusionboard_categories->deleteById($id);
  }

}

/* End of file AdminModel.php */
/* Location: ./app/Models/AdminModel.php */