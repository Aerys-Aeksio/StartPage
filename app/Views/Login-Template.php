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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=$settings['title']?> | Login</title>
  <meta name="description" content="<?=$settings['description']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?="\t".link_tag('favicon.ico', 'shortcut icon', 'image/ico')."\n";?>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <?="\n\t".link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', 'stylesheet');?>
  <?="\n\t".link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', 'stylesheet');?>
  <?="\n\t".link_tag(base_url().'Assets/css/Default-Css.css', 'stylesheet')."\n";?>

<?php
$body_color     = (!empty($settings['body_background'])) ? '<body class="'.$settings['body_background'].'">' : '<body>';
$nav_bg_color   = (!empty($settings['nav_background'])) ? ' '.$settings['nav_background'] : '';
$nav_link_color = (!empty($settings['nav_link_color'])) ? ' '.$settings['nav_link_color'] : '';
$login_link     = (!empty($settings['show_login_link']) == 1) ? true : false;
?>

<?=$body_color?>
<div class="container-fluid m-auto p-auto">
  <div class="row mt-5 p-auto">
    <div class="col">&nbsp;</div>
    <div class="col m-0 p-0">
      <div class="card mb-3">
      <?=form_open('login', ['id' => "loginform"]) ?>
        <div class="card-header bg-primary text-light text-center h3">
          <p class="text-center p-0 m-0 h3">
            Login
          </p>
        </div>
        <div class="card-body text-center">
          <img class="mb-3" src="<?=base_url()?>Assets/images/logo-login-screen-resized.png" alt="Logo">
          <?php if (! empty($errors)): ?>
              <div class="alert alert-danger" role="alert">
                  <ul>
                  <?php foreach ($errors as $error): ?>
                      <li><?= esc($error) ?></li>
                  <?php endforeach ?>
                  </ul>
              </div>
          <?php endif ?>
          <div class="input-group mb-3 has-validation">
            <span class="input-group-text">
              <i class="fa-solid fa-envelope"></i>
            </span>
            <input type="email" class="form-control" placeholder="startpage@placeholder.dev" id="email" name="email" value="<?= set_value('email')?>" required="required">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">
              <i class="fa-solid fa-lock"></i>
            </span>
            <input type="password" class="form-control" placeholder="StartPage" id="password" name="password" value="<?= set_value('password')?>" maxlength="64" minlength="6" required="required">
            <span class="input-group-text" onclick="password_show_hide();">
              <i class="fa-solid fa-eye" id="show_eye"></i>
              <i class="fa-solid fa-eye-slash d-none" id="hide_eye"></i>
            </span>
          </div>
          <div class="row">
            <div class="col justify-content-center pb-3">
              <a href ="#!" class="link-dark fw-bold">
                Forgot Password?
              </a>
            </div>
          </div>
        </div>
        <div class="card-footer text-end bg-primary">
          <a role="button" href="<?=base_url()?>" class="btn btn-warning">
            Go Back To Index
          </a>
          <button type ="submit" class="btn btn-success">
            Login
          </button>
        </div>
          <?=form_close()?>
      </div>
    </div>
    <div class="col">&nbsp;</div>
  </div>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
  function password_show_hide() {
    var x = document.getElementById("password");
    var show_eye = document.getElementById("show_eye");
    var hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
      x.type = "text";
      show_eye.style.display = "none";
      hide_eye.style.display = "block";
    } else {
      x.type = "password";
      show_eye.style.display = "block";
      hide_eye.style.display = "none";
    }
  }
  </script>
</div>
</body>
</html>