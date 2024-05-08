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
  <title>StartPage | Install Startpage</title>
  <meta name="description" content="Your StartPage Install">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?=link_tag('favicon.ico', 'shortcut icon', 'image/ico');?>
  <?="\n\t".link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', 'stylesheet');?>
  <?="\n\t".link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', 'stylesheet');?>
  <?="\n\t".link_tag(base_url().'Assets/css/Default-Css.css', 'stylesheet')."\n";?>
</head>
<body class="bg-body-secondary p-0 m-0">
|<div class="container-fluid">
  <?= $this->section('content') ?>

  <?php
  if ($database_dir_write == 0)
  {
  ?>

      <div class="row m-1 alert alert-danger" role="alert">
        <h2><?= lang('Install.warning')?></h2>
        <div class="input-group mb-3 fs-4">
          <p>
            The directory<br><code><?= DATABASE_DIR ?></code><br>
            does not exist or it is not writable or both.<br>
            Create the directory and/or make it writeble. After that reload[F5] this page to check.
          </p>
        </div>
      </div>

  <?php
  }
  else
  {
  ?>
  <div class="row pt-5">
    <div class="col-4"></div>
    <div class="col-4">
      <div class="card mb-3 border border-0 rounded">
        <form action="install" method="post" accept-charset="utf-8">
        <div class="card-header bg-primary text-light text-center h3">
          Install Your Startpage
        </div>
        <div class="card-body">
          <p class="text-center p-0 m-0"><img class="img-fluid mb-3 w-25" src="<?=base_url()?>Assets/images/logo-login-screen-resized.png" alt="Logo"></p>

            <h2>Administrator setup</h2>
            <div class="input-group mb-3">
              <p>
                Your username should be between 2 and 25 characters long.<br>
                Your password must be between <span class="text-danger">6 characters</span> and <span class="text-danger">64 characters</span> long.<br>
                Remember that passwords are case-sensitive.
              </p>
              <p class="text-end p-0 m-0 w-100">
                <span class="text-danger p-0 m-0">*</span> = Mandatory
              </p>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="admin_username" style="width:200px;">
                Administrators username<span class="text-danger">*</span>
              </span>
              <input type="text" class="form-control" placeholder="Username" id="administrator_username" value="StartPage" name="administrator_username" maxlength="25" minlength="2" required="required">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" for="admin_password" style="width:200px;">
                Password<span class="text-danger">*</span>
              </span>
              <input type="password" class="form-control" placeholder ="Password" id="password" value="StartPage" name="password" maxlength="64" minlength="6" required ="required">
              <span class="input-group-text" onclick="password_show_hide();">
                <i class="fa-solid fa-eye" id="show_eye"></i>
                <i class="fa-solid fa-eye-slash d-none" id="hide_eye"></i>
              </span>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="confirm_password1" style="width:200px;">
                Confirm Password<span class="text-danger">*</span>
              </span>
              <input type="password" class="form-control" placeholder="Confirm password" id="confirm_password" name="confirm_password" value="StartPage" maxlength="64" minlength="6" required="required">
              <span class="input-group-text" onclick="confirm_password_show_hide();">
                <i class="fa-solid fa-eye" id="show_eye1"></i>
                <i class="fa-solid fa-eye-slash d-none" id="hide_eye1"></i>
              </span>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" for="admin_email" style="width:200px;">
                Email<span class="text-danger">*</span>
              </span>
              <input type="text" class="form-control" placeholder ="email@example.com" id="admin_email" name="admin_email" value="StartPage@placeholder.dev" required="required">
            </div>
        </div>
        <div class="card-footer bg-primary text-light text-end">
          <input type="submit" class="btn btn-success" value="Submit">
        </form>
        </div>
      </div>
    </div>
    <div class="col-4"></div>
  </div>

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
  </div>
</body>
</html>