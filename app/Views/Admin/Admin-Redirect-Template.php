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
?>
    <meta http-equiv="refresh" content="<?= $time ?>;URL=<?= $destination_url ?>" />
<?php

header('Location: '.str_replace('&amp;', '&', $destination_url));
//Send no-cache headers
header('Expires: Thu, 21 Jul 1977 07:30:00 GMT'); // When yours truly first set eyes on this world! :)
header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache'); // For HTTP/1.0 compatibility
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
    <meta http-equiv="refresh" content="<?= $time ?>;URL=<?= $destination_url ?>" />
    <title>install | redirect</title>
    <meta charset="UTF-8">
    <?=link_tag('favicon.ico', 'shortcut icon', 'image/ico');?>
    <meta name="description" content="The small Startpage with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <script>
      var timeleft = <?= $time-1 ?>;
      var downloadTimer = setInterval(function(){
        if(timeleft <= 0){
          clearInterval(downloadTimer);
        }
        document.getElementById("progressBar").value = <?= $time ?> - timeleft;
        timeleft -= 1;
      }, 1000);
      var timeleft1 = <?= $time-1 ?>;
      var downloadTimer1 = setInterval(function(){
        if(timeleft1 <= 0){
          clearInterval(downloadTimer1);
          document.getElementById("countdown").innerHTML = "Going To Redirect Now!!";
        } else {
          document.getElementById("countdown").innerHTML = timeleft1 + " seconds remaining";
        }
        timeleft1 -= 1;
      }, 1000);
    </script>

  </head>

<?php
if( !isset($message))
  $message = 'no lang found but still something happend';
?>

<body class="bg-body-secondary pt-5 mt-3">
<div class="container">
  <div class="card w-25 m-auto p-auto">
    <div class="card-header bg-primary text-light h3 w-100">
      <p class="w-100 text-center">Redirecting</p>
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