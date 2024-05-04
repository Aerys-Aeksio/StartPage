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

namespace App\Libraries;

/**
 * [Description AuthLibrary]
 */
class AuthLibrary
{
  private $session;

  public function __construct()
  {
  }

  /**
   * [Description for is_admin]
   *
   * @return [type]
   * 
   */
  public function is_admin()
  {
    $this->session = \Config\Services::session();
    return ($this->session->get('group_id') == 3) ? TRUE: FALSE;
  }
} 
