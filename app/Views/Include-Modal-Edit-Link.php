<?php
if (!defined('StartPage')) 
    exit;

    foreach($links as $key => $value)
    {
?>
    <!-- Modal -->
<div class="modal fade modal-lg" id="Edit_Modal_Link<?=$value['id']?>" tabindex="-1" aria-labelledby="Edit_Modal_Link<?=$value['id']?>Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title fs-5" id="Edit_Modal_Link<?=$value['id']?>Label">Edit Link - <?=$value['name']?></h1>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        <?=form_open(url_to('edit-link', $value['id']))?>
      </div>
      <div class="modal-body">

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="link_id_span1" name="link_id_span1">Link Id</span>
            <input type="text" class="form-control bg-white" id="link_id" name="link_id" aria-describedby="link_id" value="<?=$value['id']?>" aria-label="link_id" disabled>
            <span class="input-group-text w-25" id="link_id_span2" name="link_id_span2"><= Disabled</span>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="name_span" name="name_span">Name</span>
            <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="<?=$value['name']?>" required>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="url_span" name="url_span">Url</span>
            <input type="text" class="form-control" id="url" name="url" aria-describedby="url" value="<?=$value['url']?>" required>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="category_id_span" name="category_id_span">Category</span>
            <select class="form-select" id="category_id" name="category_id" aria-label="category_id">

              <?php           
              foreach($categories as $cat => $cat_value)
              {
                if($value['category_id'] == $cat_value['id'])
                  echo '<option value="'.$cat_value['id'].'" selected="selected">'.$cat_value['name'].' in Column '.$cat_value['column'].'</option>';
                else
                  echo '<option value="'.$cat_value['id'].'">'.$cat_value['name'].' in Column '.$cat_value['column'].'</option>';
              }
              ?>

            </select>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="title_span" name="title_span">Title / Tooltip</span>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="<?=$value['title']?>" required>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="type_span" name="type_span">Type</span>
            <select class="form-select" id="type" name="type" aria-label="type">
              <option value="list"<?=($value['type'] === 'list') ? ' selected="selected"' : ''?>>List</option>
              <option value="img"<?=($value['type'] === 'img') ? ' selected="selected"' : ''?>>Image</option>
              <option value="html"<?=($value['type'] === 'html') ? ' selected="selected"' : ''?>>Html</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="img_span" name="img_span">Base64 Image String</span>
            <textarea class="form-control" rows="5" id="img" name="img" placeholder="base 64 image string"><?=$value['img']?></textarea>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="html_span" name="html_span">Html</span>
            <textarea class="form-control"" rows="5" id="html" name="html" placeholder="html"><?=$value['html']?></textarea>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="target_span" name="target_span">Link Target</span>
            <select class="form-select" id="target" name="target" aria-label="target">
              <option value="1"<?=($value['target'] = '1') ? ' selected="selected"' : ''?>>New Window / New Tab</option>
              <option value="0"<?=($value['target'] = '0') ? ' selected="selected"' : ''?>>Same Window / Same Tab</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="visible_span" name="visible_span">Link Visible</span>
            <select class="form-select" id="visible" name="visible" aria-label="visible">
              <option value="1"<?=($value['visible'] = '1') ? ' selected="selected"' : ''?>>Yes</option>
              <option value="0"<?=($value['visible'] = '0') ? ' selected="selected"' : ''?>>No</option>
            </select>
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
            <span class="input-group-text w-25" id="side_icon_span" name="side_icon_span">Side icon of the link</span>
            <select class="form-select" id="side_icon" name="side_icon" aria-label="Default select example">
              <option>Side icon of the link</option>
              <option value="1"<?=($value['side_icon'] === '1') ? ' selected="selected"' : ''?>>Left</option>
              <option value="0"<?=($value['side_icon'] === '0') ? ' selected="selected"' : ''?>>Right</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <div class="input-group input-group-sm">
            <span class="input-group-text w-25" id="position_span" name="position_span">Position / Height</span>
            <input type="number" class="form-control" min="0" max="1000" id="position" name="position" placeholder="Position / Height" value="<?=$value['position']?>">
          </div>
        </div>

      </div>
      <div class="modal-footer bg-primary btn-group rounded-0">
        <button type="button" class="btn btn-warning btn-sm m-0" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="delete_link<?=$value['id']?>" name="delete_link<?=$value['id']?>" class="btn btn-danger btn-sm m-0">Delete Link</button>
        <button type="submit" class="btn btn-success btn-sm m-0">Save Link</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <?php
    }
