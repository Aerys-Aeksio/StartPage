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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=$settings['title']?> | <?=$settings['description']?></title>
  <meta name="description" content="<?=$settings['description']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?="\t".link_tag('favicon.ico', 'shortcut icon', 'image/ico')."\n";?>
  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

  <?="\n\t".link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', 'stylesheet');?>
  <?="\n\t".link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', 'stylesheet');?>
  <?="\n\t".link_tag('Assets/css/Admin-Css.css', 'stylesheet')."\n";?>

  <?=(empty($settings['head']))?$settings['head']:'';?>

<?php
$body_color     = (!empty($settings['body_background'])) ? '<body class="'.$settings['body_background'].'">' : '<body>';
$nav_bg_color   = (!empty($settings['nav_background'])) ? ' '.$settings['nav_background'] : '';
$nav_link_color = (!empty($settings['nav_link_color'])) ? ' '.$settings['nav_link_color'] : '';
$login_link     = (!empty($settings['show_login_link']) == '1') ? TRUE : FALSE;
?>

<?=$body_color?>
<div class="container-fluid px-0">
  <div class="row align-items-center mt-3 px-0 mx-0">
    <div class="col-4"></div>
    <div class="col text-center">
      <img class="mb-3" style="height:50px;" src="<?=base_url()?>/Assets/images/startpage-header.png" alt="Logo">
    </div>
    <div class="col-4"></div>
  </div>

    <?php
?>

  <header>
    <nav class="navbar navbar-expand-lg<?=$nav_bg_color?>">
      <div class="container-fluid">
        <a class="navbar-brand<?=$nav_link_color?>" href="#">Home</a>
        <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="FALSE" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">Weather</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">Traffic</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">radio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">Tv</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">Games</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">Tips</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">Page rendered in {elapsed_time} seconds</a>
            </li>
            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="#">using {memory_usage} MB of memory.</a>
            </li>

<?php
if($login_link AND $logged_in == FALSE)
{
?>

            <li class="nav-item">
              <a class="nav-link<?=$nav_link_color?>" href="<?=url_to('login')?>">Login</a>
            </li>

<?php
}
if($logged_in === TRUE)
{
?>

            <li class="nav-item me-2">
              <button type="button" class="mb-2 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_link_category">
                Add Link / Category
              </button>
            </li>
            <li class="nav-item me-2">
              <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#settings">
                Edit StartPage Settings
              </button>
            </li>
            <li class="nav-item">
              <a role="button" class="btn btn-danger btn-sm" href="<?=url_to('logout')?>">
                Logout
              </a>
            </li>
<?php
}
?>

          </ul>
        </div>
      </div>
    </nav>
  </header>

<?php
if($logged_in == TRUE)
{
  define('Include-Modal', 'Include-Modal');
  echo $this->include('Include-Modal-Edit-Settings');
  echo $this->include('Include-Modal-Add-Link-Add-Category');
}
?>

  <div class="row mx-0">
    <div class="col">&nbsp;</div>

<?php
$i = 1;
$a = 0;
$modal = '';
// Begin while loop for the output of all the categories and links
while($i < 5)
{
  echo '<div class="col my-3 px-0 mx-2"><!-- column '.$i.' -->';
  foreach($categories as $key => $value)
  {
    $bg_header          = (!empty($value['background_color_header'])) ? ' '.$value['background_color_header'] : '';
    $text_color_header  = (!empty($value['text_color_header'])) ? ' '.$value['text_color_header'] : '';
    if($value['column'] == $i AND $value['visible'] = '1')
    {
      if($logged_in == TRUE)
        $edit_cat_button = '<button style="float: right;" type="button" class="py-0 m-0 btn btn-transparent btn-sm" data-bs-toggle="modal" data-bs-target="#Edit_Modal_Cat'.$value['id'].'"><i class="fa-solid fa-pencil"></i></button>';
      else
        $edit_cat_button = '';
?>

      <div class="card mx-0 mb-1 rounded-0">
        <div class="card-header rounded-0 p-1<?=$bg_header?><?=$text_color_header?>">
          <?=(!empty($value['side_icon']) AND $value['side_icon'] = '1') ? $value['icon'] : ''?> <?=$value['name']?> <?=(!empty($value['side_icon']) AND $value['side_icon'] = '0') ? $value['icon'] : ''?> <?=$edit_cat_button?>
        </div>
        <div class="card-body p-0">

<?php
        foreach($links as $linkkey => $linkvalue)
        {
          if($linkvalue['type'] == 'list' AND !isset($ul_already))
          {
            echo ($linkvalue['type'] == 'list') ? '<ul class="list-group list-group-flush p9-0 m-0 px-2 mb-2">' : '';
            $ul_already = TRUE;
          }
          if($logged_in == TRUE)
            $edit_link_button = '<button style="float: right;" type="button" class="py-0 m-0 btn btn-transparent btn-sm" data-bs-toggle="modal" data-bs-target="#Edit_Modal_Link'.$linkvalue['id'].'"><i class="fa-solid fa-pencil"></i></button>';
          else
            $edit_link_button = '';
          switch ($linkvalue['type'])
          {
            case 'list':
              if($linkvalue['category_id'] == $value['id'])
              {
                if($a < $value['numb_links'])
                {
                  $target = ($linkvalue['target'] === '1') ? ' target="_blank"' : ' target="_self"';

                  if(!empty($linkvalue['icon']))
                    $link = ($linkvalue['side_icon'] === '1') ? $linkvalue['icon'].'&nbsp;<a title="'.$linkvalue['title'].'" class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a>' : '<a title="'.$linkvalue['title'].'" class="icon-link link-dark" href="'.$linkvalue['url'].'"'.$target.'>'.$linkvalue['name'].'</a>&nbsp;'.$linkvalue['icon'];
                  else
                    $link = '<a title="'.$linkvalue['title'].'" class="icon-link link-dark" href="'.$linkvalue['url'].'"'.$target.'>'.$linkvalue['name'].'</a>';

                  echo '<li class="list-group-item p-0 m-0">'.$link.'&nbsp;'.$edit_link_button.'</li>';
                  $a++;
                }
              }
              break;
            case 'img':
              break;
            case 'html':
              break;
          }
        }
        $a=0;
        echo ($linkvalue['type'] == 'list') ? '</ul>' : '';
        unset($ul_already);
?>

        </div><!-- End Card Body -->

<?php
  if($more[$value['id']] == '1')
  {
    $link_color_header  = (!empty($value['link_color_header'])) ? ' '.$value['link_color_header'] : '';
    $link_color_footer  = (!empty($value['link_color_footer'])) ? ' '.$value['link_color_footer'] : '';
    $bg_footer          = (!empty($value['background_color_footer'])) ? $value['background_color_footer'] : '';
?>

        <div class="card-footer <?=$bg_footer?> py-0 ps-2">
          <button type="button" class="btn btn-link<?=$link_color_footer?>" data-bs-toggle="modal" data-bs-target="#more_<?=$value['id']?>">
            More
          </button>
        </div>

<?php
    $modal .= '<!-- Modal -->
          <div class="modal modal-sm fade" id="more_'.$value['id'].'" tabindex="-1" aria-labelledby="more_'.$value['id'].'Label" aria-hidden="TRUE">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header '.$bg_header . $link_color_header.'">
                  <h1 class="modal-title fs-5" id="more_'.$value['id'].'Label">'.$value['name'].'</h1>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <ul class="list-group list-group-flush p9-0 m-0 px-2 mb-2">';

                    foreach($links as $linkkey => $linkvalue)
                    {
                      if($linkvalue['category_id'] == $value['id'] )
                      {
                        if($a <= $value['numb_links'])
                        {
                          $target = ($linkvalue['target'] == '1') ? ' target="_blank"' : ' target="_self"';

                          if(!empty($linkvalue['icon']))
                            $link = ($linkvalue['side_icon'] == '1') ? $linkvalue['icon'] . ' <a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a>' : '<a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a> ' . $linkvalue['icon'];
                          else
                            $link = '<a title="' . $linkvalue['title'] . '" class="icon-link link-dark" href="' . $linkvalue['url'] . '"'.$target.'>'.$linkvalue['name'].'</a>';

                          $modal .= '<li class="list-group-item p-0 m-0">' . $link . '</li>';
                        }
                      }
                    }
    $modal .= '
                  </ul>
                </div>
              </div>
            </div>
          </div>';
  }
?>

      </div>  <!-- End Card -->

<?php
    }
  }
  echo '</div>'; 
  $i++;
}
// End while loop for the output of all the categories and links
?>

    <div class="col">&nbsp;</div>
    <div class="col">&nbsp;</div>
  </div>

<?php
$edit_cat_modal = '';
if($logged_in == TRUE)
{
  foreach($categories as $key => $value)
  {
    $selected_side_icon_left  = ($value['side_icon'] == '1') ? ' selected="selected"' : '';
    $selected_side_icon_right = ($value['side_icon'] == '0') ? ' selected="selected"' : '';

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
    $selected_visible_yes  = ($value['visible'] === '1') ? ' selected="selected"' : '';
    $selected_visible_no   = ($value['visible'] === '0') ? ' selected="selected"' : '';

    $edit_cat_modal .= '<!-- Edit_Modal_Cat'.$value['id'].' -->
    <div class="modal fade modal-lg" id="Edit_Modal_Cat'.$value['id'].'" tabindex="-1" aria-labelledby="Edit_Modal_Cat'.$value['id'].'_Label" aria-hidden="TRUE">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header bg-primary text-light">
            <h1 class="modal-title fs-5" id="Edit_Modal_Cat'.$value['id'].'_Label">Edit Category '.$value['name'].'</h1>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body bg-body-secondary">
            '.form_open(url_to('edit-category', $value['id'])).'
            '.form_hidden('id', ''.$value['id'].'').'

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="_id_span" name="_id_span">Category Id</span>
                <input type="text" class="form-control bg-white" id="_id" name="_id" placeholder="Id" value="'.$value['id'].'" aria-label="Disabled input" disabled>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="name_span" name="name_span">Name Category</span>
                <input type="text" class="form-control" minlength="1" maxlength="25" id="name" name="name" placeholder="Name" value="'.$value['name'].'">
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="column_span" name="column_span">Column</span>
                <input type="number" class="form-control" min="1" max="4" id="column" name="column" placeholder="Column" value="'.$value['column'].'">
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="position_span" name="position_span">Position / Height</span>
                <input type="number" class="form-control" min="0" max="1000" id="position" name="position" placeholder="Position / Height" value="'.$value['position'].'">
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="numb_links_span" name="numb_links_span">Number Of Links</span>
                <input type="number" class="form-control" min="1" max="50" id="numb_links" name="numb_links" placeholder="Number Of Links" value="'.$value['numb_links'].'">
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="icon_span" name="icon_span">Icon</span>
                <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon" value="'.esc($value['icon']).'">
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
                  <option value="1"'.$selected_side_icon_left.'>Left</option>
                  <option value="0"'.$selected_side_icon_right.'>Right</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="background_color_header_span" name="background_color_header_span">Background Color Header</span>
                <select class="form-select" id="background_color_header" name="background_color_header">
                  <option value="">Background color header</option>
                  '.$background_color_header.'
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="text_color_header_span" name="text_color_header_span">Text Color Header</span>
                <select class="form-select" id="text_color_header" name="text_color_header">
                  <option value="">Text Color Header</option>
                  '.$text_color_header.'
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25 text-start" id="background_color_footer_span" name="background_color_footer_span">Background Color Footer<br>(The More link)</span>
                <select class="form-select" id="background_color_footer" name="background_color_footer">
                  <option value="">Background Color Footer<br>(The More link)</option>
                  '.$background_color_footer.'
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25 text-start" id="link_color_footer_span" name="link_color_footer_span">Link Color Footer<br>(The More Link)</span>
                <select class="form-select" id="link_color_footer" name="link_color_footer">
                  <option value="">Link Color Footer<br>(The More Link)</option>
                  '.$link_color_footer.'
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25 text-start" id="link_color_list_span" name="link_color_list_span">Links Color List</span>
                <select class="form-select" id="link_color_list" name="link_color_list">
                  <option value="">Links Color List</option>
                  '.$link_color_list.'
                </select>
              </div>
            </div>

            <div class="mb-3">
              <div class="input-group input-group-sm">
                <span class="input-group-text w-25" id="visible_span" name="visible_span">Category Visible</span>
                <select class="form-select" id="visible" name="visible" aria-label="visible_span">
                  <option>Category Visible</option>
                  <option value="1"'.$selected_visible_yes.'>Yes</option>
                  <option value="0"'.$selected_visible_no.'>No</option>
                </select>
              </div>
            </div>

          </div>
          <div class="modal-footer bg-primary">
            <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success btn-sm">Save Category</button>
            </form>
          </div>
        </div>
      </div>
    </div>';
  }
  // here are all the edit Modal's of every category
  echo isset($edit_cat_modal) ? $edit_cat_modal : '';
}
// here are all the Modal's of the more links in every category
echo isset($modal) ? $modal : ''; 

//Begin edit link modals
$edit_link_modal = '';
if($logged_in == TRUE)
{
    define('Include-Modal-Edit-Link', 'Include-Modal-Edit-Link');
    echo $this->include('Include-Modal-Edit-Link');
}
//End edit link modals

if (!empty($settings['show_footer']) === '1')
{
  define('Include-Footer', 'Include-Footer');
  echo $this->include('Include-Footer');
}
?>

</div>
<?=(empty($settings['foot']))?$settings['foot']:'';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>