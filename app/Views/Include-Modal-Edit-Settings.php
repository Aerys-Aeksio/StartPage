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
if (!defined('StartPage')) 
    exit;
?>

<!-- Begin Modal edit startpage settings-->
  <div class="modal modal-lg fade" id="settings" tabindex="-1" aria-labelledby="settingsLabel" aria-hidden="TRUE">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h1 class="modal-title fs-5" id="settingsLabel">Edit StartPage Settings</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-body-secondary">
          <?=form_open('edit-settings')?>
          <?=form_hidden('version',                 $settings['version'])?>
          <?=form_hidden('timestamp_installed',     $settings['timestamp_installed'])?>
          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="version_span_edited" name="version_span_edited">StartPage Version</span>
              <input type="text" class="form-control bg-white" id="version_edited" name="version_edited" aria-describedby="version_edited" value="V<?=$settings['version']?>" aria-label="Disabled" disabled>
              <span class="input-group-text w-25"><= Disabled</span>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="timestamp_installed_span_edited" name="timestamp_installed_span_edited">StartPage Installed</span>
              <input type="text" class="form-control bg-white" id="timestamp_installed_edited" name="timestamp_installed_edited" aria-describedby="timestamp_installed_edited" value="<?=$time?>" aria-label="Disabled" disabled>
              <span class="input-group-text w-25"><= Disabled</span>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="title_span" name="title_span">Title</span>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="<?=$settings['title']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="description_span" name="description_span">Description</span>
              <input type="text" class="form-control" id="description" name="description" aria-describedby="description" value="<?=$settings['description']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="footer_span" name="footer_span">Footer</span>
              <input type="text" class="form-control" id="footer" name="footer" aria-describedby="footer" value="<?=$settings['footer']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="footer_span" name="footer_span">Show footer</span>
              <select class="form-select" id="show_footer" name="show_footer" aria-label="Default select example">
                <option value="1"<?=($settings['show_footer'] == '1') ? ' selected="selected"' : ''?>>Yes</option>
                <option value="0"<?=($settings['show_footer'] == '0') ? ' selected="selected"' : ''?>>No</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="redirect_time_span" name="redirect_time_span">Redirect time</span>
              <input type="number" min="0" max="10" class="form-control" id="redirect_time" name="redirect_time" aria-describedby="redirect_time" value="<?=$settings['redirect_time']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="base_url_span" name="base_url_span">Base url</span>
              <input type="text" class="form-control" id="base_url" name="base_url" aria-describedby="base_url" value="<?=$settings['base_url']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="email_span" name="email_span">E-mail</span>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="<?=$settings['email']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="body_background_span" name="body_background_span">Body background</span>
              <select class="form-select" id="body_background" name="body_background" aria-label="Default select example">

<?php           $bg_colors =
                [
                  'bg-primary',
                  'bg-primary-subtle',
                  'bg-secondary',
                  'bg-secondary-subtle',
                  'bg-success',
                  'bg-success-subtle',
                  'bg-danger',
                  'bg-danger-subtle',
                  'bg-warning',
                  'bg-warning-subtle',
                  'bg-info',
                  'bg-info-subtle',
                  'bg-light',
                  'bg-light-subtle',
                  'bg-dark',
                  'bg-dark-subtle',
                  'bg-body-secondary',
                  'bg-body-tertiary',
                  'bg-body',
                  'bg-black',
                  'bg-white',
                  'bg-transparent',
                ];
                foreach($bg_colors as $colors)
                {
                  if($settings['body_background'] == $colors)
                    echo '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
                  else
                    echo '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
                }
?>

              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="nav_background_span" name="nav_background_span">Navigation background</span>
              <select class="form-select" id="nav_background" name="nav_background" aria-label="nav_background">

<?php           foreach($bg_colors as $colors)
                {
                  if($settings['nav_background'] == $colors)
                    echo '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
                  else
                    echo '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
                }
?>

              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="nav_link_color_span" name="nav_link_color_span">Navigation link color</span>
              <select class="form-select" id="nav_link_color" name="nav_link_color" aria-label="nav_link_color">

<?php           $link_colors =
                [
                  'link-primary',
                  'link-secondary',
                  'link-success',
                  'link-danger',
                  'link-warning',
                  'link-info',
                  'link-light',
                  'link-dark',
                  'link-body-emphasis',
                ];

                foreach($link_colors as $colors)
                {
                  if($settings['nav_link_color'] == $colors)
                    echo '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
                  else
                    echo '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
                }
?>

              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="show_login_link_span" name="show_login_link_span">Show Login Link</span>
              <select class="form-select" id="show_login_link" name="show_login_link" aria-label="show_login_link_span">
                <option value="1"<?=($settings['show_login_link'] == '1') ? ' selected="selected"' : ''?>>Yes</option>
                <option value="0"<?=($settings['show_login_link'] == '0') ? ' selected="selected"' : ''?>>No</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="head_span" name="head_span">Add to head</span>
              <textarea class="form-control" id="head" name="head" placeholder="Add to head"><?=$settings['head']?></textarea>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="foot_span" name="foot_span">Add to foot</span>
              <textarea class="form-control" id="foot" name="foot" placeholder="Add to foot"><?=$settings['foot']?></textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer bg-primary btn-group rounded-0">
          <button type="button" class="btn btn-warning btn-sm mx-0" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm mx-0">Save Settings</button>
        </div>
        <?=form_close()?>
      </div>
    </div>
  </div>
  <!-- End Modal edit startpage settings-->
