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

foreach($categories as $key => $value)
{
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
  {
  if($value['background_color_header'] == $colors)
      $background_color_header .= '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
  else
      $background_color_header .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
  }
  $background_color_footer = '';
  foreach($bg_colors as $colors)
  {
  if($value['background_color_footer'] == $colors)
      $background_color_footer .= '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
  else
      $background_color_footer .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
  }
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
  {
  if($value['text_color_header'] == $colors)
      $text_color_header .= '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
  else
      $text_color_header .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
  }
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
  {
  if($value['link_color_footer'] == $colors)
      $link_color_footer .= '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
  else
      $link_color_footer .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
  }
  $link_color_list = '';
  foreach($link_colors as $colors)
  {
  if($value['link_color_list'] == $colors)
      $link_color_list .= '<option value="'.$colors.'" class="'.$colors.'" selected="selected">'.$colors.'</option>';
  else
      $link_color_list .= '<option value="'.$colors.'" class="'.$colors.'">'.$colors.'</option>';
  }
?>

<!-- Edit_Modal_Cat<?=$value['id']?> -->
  <div class="modal fade modal-lg" id="Edit_Modal_Cat<?=$value['id']?>" tabindex="-1" aria-labelledby="Edit_Modal_Cat<?=$value['id']?>_Label" aria-hidden="TRUE">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h1 class="modal-title fs-5" id="Edit_Modal_Cat<?=$value['id']?>_Label">Edit Category <?=$value['name']?></h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-body-secondary">
          <?=form_open(url_to('edit-category', $value['id']))?>
          <?=form_hidden('id', ''.$value['id'].'')?>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="_id_span" name="_id_span">Category Id</span>
              <input type="text" class="form-control bg-white" id="_id" name="_id" placeholder="Id" value="<?=$value['id']?>" aria-label="Disabled input" disabled>
              <span class="input-group-text w-25" id="_id_span" name="_id_span"><= Disabled</span>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="name_span" name="name_span">Name Category</span>
              <input type="text" class="form-control" minlength="1" maxlength="25" id="name" name="name" placeholder="Name" value="<?=$value['name']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="column_span" name="column_span">Column</span>
              <input type="number" class="form-control" min="1" max="4" id="column" name="column" placeholder="Column" value="<?=$value['column']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="position_span" name="position_span">Position / Height</span>
              <input type="number" class="form-control" min="0" max="1000" id="position" name="position" placeholder="Position / Height" value="<?=$value['position']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="numb_links_span" name="numb_links_span">Number Of Links</span>
              <input type="number" class="form-control" min="1" max="50" id="numb_links" name="numb_links" placeholder="Number Of Links" value="<?=$value['numb_links']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="icon_span" name="icon_span">Icon</span>
              <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" value="<?=esc($value['icon'])?>">
            </div>
            <div class="form-text">
              You can use icons from font awesome
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="side_icon_span" name="side_icon_span">Side Icon Of The Category</span>

              <select class="form-select" id="side_icon" name="side_icon" aria-label="Default select example">
              <option>Side Icon Of The Category</option>
              <option value="1"<?=($value['side_icon'] === '1') ? ' selected="selected"' : ''?>>Left</option>
              <option value="0"<?=($value['side_icon'] === '0') ? ' selected="selected"' : ''?>>Right</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="background_color_header_span" name="background_color_header_span">Background Color Header</span>
              <select class="form-select" id="background_color_header" name="background_color_header">
              <option value="">Background color header</option>
              <?=$background_color_header?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="text_color_header_span" name="text_color_header_span">Text Color Header</span>
              <select class="form-select" id="text_color_header" name="text_color_header">
              <?=$text_color_header?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25 text-start" id="background_color_footer_span" name="background_color_footer_span">Background Color Footer<br>(The More link)</span>
              <select class="form-select" id="background_color_footer" name="background_color_footer">
                <?=$background_color_footer?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25 text-start" id="link_color_footer_span" name="link_color_footer_span">Link Color Footer<br>(The More Link)</span>
              <select class="form-select" id="link_color_footer" name="link_color_footer">
              <?=$link_color_footer?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25 text-start" id="link_color_list_span" name="link_color_list_span">Links Color List</span>
              <select class="form-select" id="link_color_list" name="link_color_list">
                <?=$link_color_list?>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group input-group-sm">
              <span class="input-group-text w-25" id="visible_span" name="visible_span">Category Visible</span>
              <select class="form-select" id="visible" name="visible" aria-label="visible_span">
                <option value="1"<?=($value['visible'] === '1') ? ' selected="selected"' : ''?>>Yes</option>
                <option value="0"<?=($value['visible'] === '0') ? ' selected="selected"' : ''?>>No</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer bg-primary btn-group rounded-0">
          <button type="button" class="btn btn-warning btn-sm m-0" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="delete_cat<?=$value['id']?>" name="delete_cat<?=$value['id']?>" class="btn btn-danger btn-sm m-0">Delete Category</button>
          <button type="submit" class="btn btn-success btn-sm m-0">Save Category</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
}