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

  foreach($links as $key => $value)
  {
?>

    <!-- Modal -->
<div class="modal fade modal-lg" id="Edit_Modal_Link<?=$value['id']?>" tabindex="-1" aria-labelledby="Edit_Modal_Link<?=$value['id']?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white" data-bs-theme="dark">
        <h1 class="modal-title fs-5" id="Edit_Modal_Link<?=$value['id']?>Label">Edit Link - <?=$value['name']?></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <?=form_open(url_to('update-link', $value['id']))?>
      </div>
      <div class="modal-body">

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="link_id_span1">Link Id</span>
          <input type="text" class="form-control bg-white" id="link_id" name="link_id" aria-describedby="link_id" value="<?=$value['id']?>" aria-label="link_id" disabled>
          <span class="input-group-text w-25" id="link_id_span2"><= Disabled</span>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="name_span_edit_link">Name</span>
          <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="<?=$value['name']?>" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="url_span">Url</span>
          <input type="text" class="form-control" id="url" name="url" aria-describedby="url" value="<?=$value['url']?>" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="position_span">Position / Height</span>
          <input type="number" class="form-control" min="0" max="1000" id="position" name="position" placeholder="Position / Height" value="<?=$value['position']?>">
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="category_id_span">Category</span>
          <select class="form-select" id="category_id" name="category_id" aria-label="category_id">

            <?php           
            foreach($categories as $cat => $cat_value)
            {
              if($value['category_id'] == $cat_value['id'])
                echo '<option value="'.$cat_value['id'].'" selected="selected">Column '.$cat_value['column'].' -- '.$cat_value['name'].'</option>';
              else
                echo '<option value="'.$cat_value['id'].'">Column '.$cat_value['column'].' -- '.$cat_value['name'].'</option>';
            }
            ?>

          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="title_span">Title / Tooltip</span>
          <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="<?=$value['title']?>" required>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="type_span">Type</span>
          <select class="form-select" id="type" name="type" aria-label="type">
            <option value="list"<?=($value['type'] === 'list') ? ' selected="selected"' : ''?>>List</option>
            <option value="img"<?=($value['type'] === 'img') ? ' selected="selected"' : ''?>>Image</option>
            <option value="html"<?=($value['type'] === 'html') ? ' selected="selected"' : ''?>>Html</option>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="img_span">Base64 Image String</span>
          <textarea class="form-control" rows="5" id="img" name="img" placeholder="base 64 image string"><?=$value['img']?></textarea>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="html_span">Html</span>
          <textarea class="form-control" rows="5" id="html" name="html" placeholder="html"><?=$value['html']?></textarea>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="target_span">Link Target</span>
          <select class="form-select" id="target" name="target" aria-label="target">
            <option value="1"<?=($value['target'] = '1') ? ' selected="selected"' : ''?>>New Window / New Tab</option>
            <option value="0"<?=($value['target'] = '0') ? ' selected="selected"' : ''?>>Same Window / Same Tab</option>
          </select>
        </div>

        <div class="input-group input-group-sm mb-3">
          <span class="input-group-text w-25" id="visible_span">Link Visible</span>
          <select class="form-select" id="visible" name="visible" aria-label="visible">
            <option value="1"<?=($value['visible'] = '1') ? ' selected="selected"' : ''?>>Yes</option>
            <option value="0"<?=($value['visible'] = '0') ? ' selected="selected"' : ''?>>No</option>
          </select>
        </div>

        <div class="input-group input-group-sm">
          <?php
          $icon_left = !empty($value['icon_left']) ? $value['icon_left'] : '';
          $icon_right = !empty($value['icon_right']) ? $value['icon_right'] : '';
          ?>
          <span class="input-group-text w-25" id="icon_left_span">Icon Left</span>
          <input type="text" class="form-control" id="icon_left" name="icon_left" placeholder="Icon Left" value="<?=esc($icon_left)?>">
        </div>
        <div class="form-text mb-3 mt-0 pt-0">
          <small>You can use icons from <a class="link-dark" href="https://fontawesome.com" target="_blank">font awesome</a></small>
        </div>

        <div class="input-group input-group-sm">
          <span class="input-group-text w-25" id="icon_right_span">Icon Right</span>
          <input type="text" class="form-control" id="icon_right" name="icon_right" placeholder="Icon Right" value="<?=esc($icon_right)?>">
        </div>
        <div class="form-text mb-3 mt-0 pt-0">
          <small>You can use icons from <a class="link-dark" href="https://fontawesome.com" target="_blank">font awesome</a></small>
        </div>

      </div>
      <div class="modal-footer bg-primary btn-group rounded-0">
        <button type="button" class="btn btn-warning btn-sm m-0" data-bs-dismiss="modal">Close</button>
        <button type="submit" formaction="<?=base_url('delete-link/'.$value['id'])?>" id="delete_link<?=$value['id']?>" name="delete_link<?=$value['id']?>" class="btn btn-danger btn-sm m-0">Delete Link</button>
        <button type="submit" id="update_link<?=$value['id']?>" class="btn btn-success btn-sm m-0">Update Link</button>
        <?=form_close()?>
      </div>
    </div>
  </div>
</div>

<?php
  }
