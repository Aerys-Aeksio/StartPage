<?php
/**
 *
 * This file is part of the StartPage
 *
 * @copyright (c) Daniël Rokven
 *
 * @license Mit
 *
 * For full copyright and license information, please see
 * the docs/CREDITS.txt file.
 *
 */
define('STARTPAGE', 'STARTPAGE');
define('REDIRECT', 'REDIRECT');

?>
  <meta http-equiv="refresh" content="<?= $time ?>;URL=<?= $destination_url ?>" />
<?php

header('Location: '.str_replace('&amp;', '&', $destination_url));
//Send no-cache headers
header('Expires: Thu, 21 Jul 1977 07:30:00 GMT'); // When yours truly first set eyes on this world! :)
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache'); // For HTTP/1.0 compatibility

echo $this->include('Include-Template-Head');

if(!isset($message))
  $message = 'no lang found but still something happened';

  $body_color = (!empty($settings['body_background'])) ? '<body class="pt-5 mt-3 '.$settings['body_background'].'">' : '<body class="pt-5 mt-3 bg-secondary">';
?>

<?=$body_color?>
<div class="container">
  <div class="card w-25 m-auto p-auto">
    <div class="card-header bg-primary text-light h3 w-100">
      <p class="w-100 text-center p-0 m-0">Redirecting</p>
    </div>
    <div class="card-body m-auto">
      <p class="m-auto w-100 text-center">
        <?=$message.'<br><br><a class="link-dark" href="'.$destination_url.'">Redirect</a>' ?>
      </p>
      <div class="m-auto" id="countdown">&nbsp;</div>
      <progress class="w-100 m-auto" value="0" max="<?= $time ?>" id="progressBar"></progress>
      <br>
      <small>Page rendered in {elapsed_time} seconds</small>
    </div>
    <div class="modal-footer bg-primary p-2">
      &nbsp;
    </div>
  </div>
</div>
</body>
</html>