<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

 if (! function_exists('sp_base_url')) {
  /**
   * Returns the base URL as defined by the App config.
   * Base URLs are trimmed site URLs without the index page.
   *
   * @param array|string $relativePath URI string or array of URI segments.
   * @param string|null  $scheme       URI scheme. E.g., http, ftp. If empty
   *                                   string '' is set, a protocol-relative
   *                                   link is returned.
   */
  function sp_base_url($relativePath = '', ?string $scheme = null): string
  {
      $currentURI = service('request')->getUri();

      assert($currentURI instanceof SiteURI);

      return $currentURI->baseUrl($relativePath, $scheme);
  }
}