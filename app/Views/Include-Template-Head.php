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
if (!defined('STARTPAGE')) 
    exit;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<?php if(defined('REDIRECT-TEMPLATE'))
        echo '<meta http-equiv="refresh" content="'.$time.';URL='.$destination_url.'">';

      if(isset($settings['title']))
        $title = $settings['title'];
      else
        $title = '';

      if(defined('INDEX'))
      {
        $title        = $settings['title'];
        $second_title = $settings['description'];
        $description  = $settings['description'];
      }
      elseif(defined('LOGIN'))
      {
        $title        = $settings['title'];
        $second_title = 'Login';
        $description  = $settings['description'];
      }
      elseif(defined('INSTALL'))
      {
        $title        = 'StartPage';
        $second_title = 'Install';
        $description  = 'Installing StartPage';
      }
      elseif(defined('REDIRECT'))
      {
        if(empty($settings['title']) AND empty($settings['description']))
        {
          $title        = 'StartPage';
          $second_title = 'Redirecting';
          $description  = 'Just installed StartPage';
        }
        else
        {
          $title        = $settings['title'];
          $second_title = 'Redirecting';
          $description  = $settings['description'];
        }
      }
      else
        $second_title = '';
      //if(!empty($settings['description']))
        //$description = $settings['description'];
?>

    <title><?=$title?> | <?=$second_title?></title>
    <meta charset="UTF-8">
    <?=link_tag('favicon.ico', 'shortcut icon', 'image/ico')."\n";?>
    <meta name="description" content="<?=$description?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?="\n\t".link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', 'stylesheet');?>
    <?="\n\t".link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', 'stylesheet');?>
    <?="\n\t".link_tag(base_url().'Assets/css/Default-Css.css', 'stylesheet')."\n";?>
    <?=(!empty($settings['head'])) ? $settings['head'] : '';?>

<?php
if(defined('STARTPAGE') AND defined('REDIRECT'))
{
?>
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
<?php
}
?>

  </head>