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

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $auth = service('auth');

    if ($auth->is_admin() == FALSE)
    {
      return redirect()->to(url_to('/'));
    }
  }
  
  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
      // Do something here
  }
}