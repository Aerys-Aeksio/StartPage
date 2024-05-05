<?php
/**
 *
 * This file is part of the Startpage
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome To StartPage</title>
  <meta name="description" content="Your StartPage Install">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?=link_tag('favicon.ico', 'shortcut icon', 'image/ico');?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <?="\n\t".link_tag('Admin-Css/Admin-Css.css', 'stylesheet')."\n";?>
  <style>
    #btn-back-to-top {
      position: fixed;
      bottom: 59px;
      right: 5px;
      display: none;
    }
  </style>
</head>
<body class="bg-body-secondary">

<?= $this->section('content') ?>

<?php
if ($database_dir_write == 0)
{
?>

    <div class="row m-1 alert alert-danger m-3" role="alert">
      <h2><?= lang('Install.warning')?></h2>
      <div class="input-group mb-3 fs-4">
        <p>
          The directory<br><code><?= DATABASE_DIR ?></code><br>does not exist or it is not writable or both.<br>Create the directory and/or make it writeble. After that reload[F5] this page to check.
        </p>
      </div>
    </div>

<?php
}
else
{
?>

<form action="install" class="form-control" method="post" accept-charset="utf-8">
  <div class="card mb-3 pb-3 border border-0 rounded">
    <div class="card-header rounded border bg-primary text-light">
      <h1>Install Your Startpage</h1>
    </div>
    <div class="card-body">
      <div class="row m-1">
        <h2>Options</h2>
        <div class="input-group mb-3">
          <span class="input-group-text" id="blog_title1">
            StartPage Title<span class="text-danger">*</span>
          </span>
          <input type="text" value="StartPage" class="form-control" id="title" name ="title" required="required">
        </div>
      </div>
      <div class="row m-1">
        <div class="input-group mb-3">
          <span class="input-group-text" for="desc">
            StartPage Description<span class="text-danger">*</span>
          </span>
          <input type="text" value="No one can tell you what StartPage is - you have to see it for yourself." class="form-control" id="desc" name="desc">
        </div>
      </div>
      <div class="row m-1">
        <div class="input-group mb-3">
          <span class="input-group-text" for="base_url">
            The BASE URL (without trailing slash)<br>of your StartPage.<span class="text-danger">*</span>
          </span>

<?php
          $c_url = str_replace('/install', '', 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>

          <input type = "text" class="form-control" value="<?= $c_url ?>" id="board_url" name="board_url" required="required">
        </div>
      </div>
      <div class="row m-1">
        <h2>Administrator setup</h2>
        <div class="input-group mb-3">
          <p>
            Your username should be between 2 and 25 characters long.<br>Your password must be between <span class="text-danger">6 characters</span> and <span class="text-danger">64 characters</span> long.<br>Remember that passwords are case-sensitiv
          </p>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="admin_username">
            Administrators username<span class="text-danger">*</span>
          </span>
          <input type="text" class="form-control" placeholder ="Username" id="administrator_username" value="kierownik" name="administrator_username" maxlength="25" minlength="2" required="required">
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" for="admin_password">
            Password<span class="text-danger">*</span>
          </span>
          <input type="password" class="form-control" placeholder ="Password" id="password" value="testtest" name="password" maxlength="64" minlength="6" required ="required">
          <span class="input-group-text" onclick="password_show_hide();">
            <i class="fa-solid fa-eye" id="show_eye"></i>
            <i class="fa-solid fa-eye-slash d-none" id="hide_eye"></i>
          </span>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" id="confirm_password1">
            Confim Password<span class="text-danger">*</span>
          </span>
          <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="confirm_password" value="testtest" maxlength="64" minlength="6" required="required">
          <span class="input-group-text" onclick="confirm_password_show_hide();">
            <i class="fa-solid fa-eye" id="show_eye1"></i>
            <i class="fa-solid fa-eye-slash d-none" id="hide_eye1"></i>
          </span>
        </div>
        <div class="input-group mb-3">
          <span class="input-group-text" for="admin_email">
            Email<span class="text-danger">*</span>
          </span>
          <input type="text" class="form-control" placeholder ="email@example.com" id="admin_email" name="admin_email" value="rokven@gmail.com" required="required">
        </div>
      </div>
      <div class="card-footer text-muted border border-1 rounded">
        <span class="text-danger">*</span> = Mandatory
        <input type="submit" class="btn btn-primary" value="Submit">
      </div>
    </div>
    </div>
  </form>

<?php
}
?>

<!-- SCRIPTS -->
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
  function confirm_password_show_hide() {
    var x1 = document.getElementById("confirm_password");
    var show_eye1 = document.getElementById("show_eye1");
    var hide_eye1 = document.getElementById("hide_eye1");
    hide_eye1.classList.remove("d-none");
    if (x1.type === "password") {
      x1.type = "text";
      show_eye1.style.display = "none";
      hide_eye1.style.display = "block";
    } else {
      x1.type = "password";
      show_eye1.style.display = "block";
      hide_eye1.style.display = "none";
    }
  }
</script>
</body>
</html>