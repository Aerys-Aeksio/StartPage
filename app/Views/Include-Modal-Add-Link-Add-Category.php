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

<!-- Add Link Modal -->
<div class="modal fade modal-lg" id="add_link" tabindex="-1" aria-labelledby="add_linkLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light" data-bs-theme="dark">
        <h1 class="modal-title fs-5" id="add_linkLabel">Add Link</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="name_span" name="name_span">Name<span class="text-danger">*</span></span>
          <input type="text" class="form-control" id="name_add_link" name="name_add_link" aria-describedby="name" value="" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="url_span" name="url_span">Url<span class="text-danger">*</span></span>
          <input type="text" class="form-control" id="url_add_link" name="url_add_link" aria-describedby="url" value="" required>
        </div>

        <div class="input-group input-group-sm">
          <span class="input-group-text w-25" id="position_span" name="position_span">Position / Height</span>
          <input type="number" class="form-control" min="0" max="1000" id="position_add_link" name="position_add_link" placeholder="Position / Height" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="category_id_span" name="category_id_span">Category</span>
          <select class="form-select" id="category_id_add_link" name="category_id_add_link" aria-label="category_id_add_link">

<?php           
            foreach($categories as $cat => $cat_value)
              echo '<option value="'.$cat_value['id'].'">'.$cat_value['name'].' in Column '.$cat_value['column'].'</option>';
?>

          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="title_span" name="title_span">Title / Tooltip</span>
          <input type="text" class="form-control" id="title_add_link" name="title_add_link" aria-describedby="title" value="" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="type_span" name="type_span">Type</span>
          <select class="form-select" id="type_add_link" name="type_add_link" aria-label="type">
            <option value="list">List</option>
            <option value="img">Image</option>
            <option value="html">Html</option>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="img_span" name="img_span">Base64 Image String</span>
          <textarea class="form-control" id="img_add_link" name="img_add_link" placeholder="base 64 image string"></textarea>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="html_span" name="html_span">Html</span>
          <textarea class="form-control" id="html_add_link" name="html_add_link" placeholder="html"></textarea>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="target_span" name="target_span">Link Target</span>
          <select class="form-select" id="target_add_link" name="target_add_link" aria-label="target">
            <option value="1">New Window / New Tab</option>
            <option value="0">Same Window / Same Tab</option>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="visible_span" name="visible_span">Link Visible</span>
          <select class="form-select" id="visible_add_link" name="visible_add_link" aria-label="visible">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="icon_left_span" name="icon_left_span">Icon Left</span>
          <input type="text" class="form-control" id="icon_left_add_link" name="icon_left_add_link" placeholder="Icon Left" value="">
        </div>
        <div class="form-text mb-3">
            <small>You can use icons from font awesome</small>
          </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="icon_right_span" name="icon_right_span">Icon Right</span>
          <input type="text" class="form-control" id="icon_right_add_link" name="icon_right_add_link" placeholder="Icon Right" value="">
        </div>
        <div class="form-text">
          You can use icons from font awesome
        </div>

      </div>
      <div class="modal-footer bg-primary text-light btn-group rounded-0">
        <button type="button" class="btn btn-warning btn-sm m-0" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-sm m-0">Add Link</button>
      </div>
    </div>
  </div>
</div>

<?php
  $bg_colors =
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
  $background_color_header = '';
  foreach($bg_colors as $colors)
    $background_color_header .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';

  $background_color_footer = '';
  foreach($bg_colors as $colors)
    $background_color_footer .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';

  $text_colors =
  [
    'text-primary',
    'text-primary-emphasis',
    'text-secondary',
    'text-secondary-emphasis',
    'text-success',
    'text-success-emphasis',
    'text-danger',
    'text-danger-emphasis',
    'text-warning',
    'text-warning-emphasis',
    'text-info',
    'text-info-emphasis',
    'text-light',
    'text-light-emphasis',
    'text-dark',
    'text-dark-emphasis',
    'text-body',
    'text-body-emphasis',
    'text-body-secondary',
    'text-body-tertiary',
    'text-black',
    'text-white',
    'text-black-50',
    'text-white-50',
  ];
  $text_color_header = '';
  foreach($text_colors as $colors)
    $text_color_header .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';

  $link_colors =
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
  $link_color_footer = '';
  foreach($link_colors as $colors)
    $link_color_footer .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
  
  $link_color_list = '';
  foreach($link_colors as $colors)
    $link_color_list .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
?>

<!-- Add Category Modal -->
<div class="modal fade modal-lg" id="add_category" tabindex="-1" aria-labelledby="add_categoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-light" data-bs-theme="dark">
        <h1 class="modal-title fs-5" id="add_categoryLabel">Add Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="name_span" name="name_span">Name Category</span>
          <input type="text" class="form-control" minlength="1" maxlength="25" id="name_add_category" name="name_add_category" placeholder="Name" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="column_span" name="column_span">Column</span>
          <input type="number" class="form-control" min="1" max="4" id="column_add_category" name="column_add_category" placeholder="Column" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="position_span" name="position_span">Position / Height</span>
          <input type="number" class="form-control" min="0" max="1000" id="position_add_category" name="position_add_category" placeholder="Position / Height" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="numb_links_span" name="numb_links_span">Number Of Links</span>
          <input type="number" class="form-control" min="1" max="50" id="numb_links_add_category" name="numb_links_add_category" placeholder="Number Of Links" value="">
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="icon_left_span" name="icon_left_span">Icon Right</span>
          <input type="text" class="form-control" id="icon_left_add_category" name="icon_left_add_category" placeholder="Icon Left" value="">
        </div>
        <div class="form-text">
          You can use icons from font awesome
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="icon_right_span" name="icon_right_span">Icon Left</span>
          <input type="text" class="form-control" id="icon_right_add_category" name="icon_right_add_category" placeholder="Icon Right" value="">
        </div>
        <div class="form-text">
          You can use icons from font awesome
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="background_color_header_span" name="background_color_header_span">Background Color Header</span>
          <select class="form-select" id="background_color_header_add_category" name="background_color_header_add_category">
          <option value="">Background Color Header</option>
          <?=$background_color_header?>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="text_color_header_span" name="text_color_header_span">Text Color Header</span>
          <select class="form-select" id="text_color_header_add_category" name="text_color_header_add_category">
            <option value="">Text Color Header</option>
            <?=$text_color_header?>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25 text-start" id="background_color_footer_span" name="background_color_footer_span">Background Color Footer<br>(The More link)</span>
          <select class="form-select" id="background_color_footer_add_category" name="background_color_footer_add_category">
            <option value="">Background Color Footer</option>
            <?=$background_color_footer?>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25 text-start" id="link_color_footer_span" name="link_color_footer_span">Link Color Footer<br>(The More Link)</span>
          <select class="form-select" id="link_color_footer_add_category" name="link_color_footer_add_category">
            <option value="">Link Color Footer</option>
            <?=$link_color_footer?>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25 text-start" id="link_color_list_span" name="link_color_list_span">Links Color List</span>
          <select class="form-select" id="link_color_list_add_category" name="link_color_list_add_category">
            <option value="">Link Color Links</option>
            <?=$link_color_list?>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="visible_span" name="visible_span">Category Visible</span>
          <select class="form-select" id="visible_add_category" name="visible_add_category" aria-label="visible_span">
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>

      </div>
      <div class="modal-footer bg-primary text-light btn-group rounded-0">
        <button type="button" class="btn btn-warning btn-sm m-0" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success btn-sm m-0">Add Category</button>
      </div>
    </div>
  </div>
</div>