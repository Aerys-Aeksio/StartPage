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
  <title><?=$settings['title']?></title>
  <meta name="description" content="<?=$settings['description']?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?="\t".link_tag(''.$settings['favicon']['favicon'].'', 'shortcut icon', 'image/ico')."\n";?>
  <link rel="apple-touch-icon" sizes="180x180" href="/<?=$settings['favicon']['apple_touch_icon']?>">
  <link rel="icon" type="image/png" sizes="32x32" href="/<?=$settings['favicon']['favicon32']?>">
  <link rel="icon" type="image/png" sizes="16x16" href="/<?=$settings['favicon']['favicon16']?>">
  <link rel="manifest" href="/<?=$settings['favicon']['webmanifest']?>">

  <?="\n\t".link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', 'stylesheet');?>
  <?="\n\t".link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css', 'stylesheet');?>
  <?="\n\t".link_tag('Admin-Css/Admin-Css.css', 'stylesheet')."\n";?>

<?php
$body_color     = (!empty($settings['body_background'])) ? '<body class="'.$settings['body_background'].'">' : '<body>';
$nav_bg_color   = (!empty($settings['nav_background'])) ? ' '.$settings['nav_background'] : '';
$nav_link_color = (!empty($settings['nav_link_color'])) ? ' '.$settings['nav_link_color'] : '';
$login_link     = (!empty($settings['show_login_link']) == 1) ? TRUE : FALSE;
?>

<?=$body_color?>
<div class="container-fluid">
  <div class="h-20">&nbsp;</div>
  <header>
    <nav class="navbar navbar-expand-lg<?=$nav_bg_color?>">
      <div class="container-fluid">
        <a class="navbar-brand<?=$nav_link_color?>" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

<?php
if($login_link AND $logged_in == FALSE)
{
      echo '<li class="nav-item">
              <a class="nav-link'.$nav_link_color.'" href="'.url_to('login').'">Login</a>
            </li>';
}
?>

          </ul>
        </div>

<?php
if($logged_in == TRUE)
  echo'<div class="float-end">
        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#settings">
          Edit StartPage Settings
        </button>
            <a tabindex="-1" role="button" class="btn btn-danger btn-sm" href="'.url_to('logout').'">Logout</a>
          </div>';
?>

      </div>
    </nav>
  </header>
  <?php
if($logged_in == TRUE)
{
?>

<!-- Begin Modal edit startpage settings-->
  <div class="modal modal-lg fade" id="settings" tabindex="-1" aria-labelledby="settingsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header bg-primary text-light">
          <h1 class="modal-title fs-5" id="settingsLabel">Edit StartPage Settings</h1>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body bg-body-secondary">
          <?=form_open('edit-settings')?>
          <?=form_hidden('favicon',                 $settings['favicon']['favicon'])?>
          <?=form_hidden('favicon16',               $settings['favicon']['favicon16'])?>
          <?=form_hidden('favicon32',               $settings['favicon']['favicon32'])?>
          <?=form_hidden('apple_touch_icon',        $settings['favicon']['apple_touch_icon'])?>
          <?=form_hidden('android_chrome_192x192',  $settings['favicon']['android_chrome_192x192'])?>
          <?=form_hidden('android_chrome_512x512',  $settings['favicon']['android_chrome_512x512'])?>
          <?=form_hidden('webmanifest',             $settings['favicon']['webmanifest'])?>
          <?=form_hidden('version',                 $settings['version'])?>
          <?=form_hidden('timestamp_installed',     $settings['timestamp_installed'])?>
          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="version_span_edited" name="version_span_edited">StartPage Version</span>
              <input type="text" class="form-control bg-white" id="version_edited" name="version_edited" aria-describedby="version_edited" value="V<?=$settings['version']?>" aria-label="Disabled" disabled>
              <span class="input-group-text w-25"><= Disabled</span>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="timestamp_installed_span_edited" name="timestamp_installed_span_edited">StartPage Installed</span>
              <input type="text" class="form-control bg-white" id="timestamp_installed_edited" name="timestamp_installed_edited" aria-describedby="timestamp_installed_edited" value="<?=$time?>" aria-label="Disabled" disabled>
              <span class="input-group-text w-25"><= Disabled</span>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="title_span" name="title_span">Title</span>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="<?=$settings['title']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="description_span" name="description_span">Description</span>
              <input type="text" class="form-control" id="description" name="description" aria-describedby="description" value="<?=$settings['description']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="footer_span" name="footer_span">Footer</span>
              <input type="text" class="form-control" id="footer" name="footer" aria-describedby="footer" value="<?=$settings['footer']?>">
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="footer_span" name="footer_span">Show footer</span>
              <?php $selected_footer_no   = ($settings['show_footer'] == 0) ? ' selected="selected"' : '';
                    $selected_footer_yes  = ($settings['show_footer'] == 1) ? ' selected="selected"' : '';
              ?>
              <select class="form-select" id="show_footer" name="show_footer" aria-label="Default select example">
                <option>Show Footer</option>
                <option value="0"<?=$selected_footer_no?>>No</option>
                <option value="1"<?=$selected_footer_yes?>>Yes</option>
              </select>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="redirect_time_span" name="redirect_time_span">Redirect time</span>
              <input type="number" min="0" max="10" class="form-control" id="redirect_time" name="redirect_time" aria-describedby="redirect_time" value="<?=$settings['redirect_time']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="base_url_span" name="base_url_span">Base url</span>
              <input type="text" class="form-control" id="base_url" name="base_url" aria-describedby="base_url" value="<?=$settings['base_url']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="email_span" name="email_span">E-mail</span>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="<?=$settings['email']?>" required>
            </div>
          </div>

          <div class="mb-3">
            <div class="input-group">
              <span class="input-group-text w-25" id="body_background_span" name="body_background_span">Body background</span>
              <select class="form-select" id="body_background" name="body_background" aria-label="Default select example">
                <option value="">Body background</option>

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
            <div class="input-group">
              <span class="input-group-text w-25" id="nav_background_span" name="nav_background_span">Navigation background</span>
              <select class="form-select" id="nav_background" name="nav_background" aria-label="nav_background">
                <option value="">Navigation background</option>

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
            <div class="input-group">
              <span class="input-group-text w-25" id="nav_link_color_span" name="nav_link_color_span">Navigation link color</span>
              <select class="form-select" id="nav_link_color" name="nav_link_color" aria-label="nav_link_color">
                <option value="">Navigation link color</option>

<?php           $text_colors =
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

                foreach($text_colors as $colors)
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
            <div class="input-group">
              <span class="input-group-text w-25" id="show_login_link_span" name="show_login_link_span">Show Login Link</span>
              <?php $selected_show_login_link_no   = ($settings['show_login_link'] == 0) ? ' selected="selected"' : '';
                    $selected_show_login_link_yes  = ($settings['show_login_link'] == 1) ? ' selected="selected"' : '';
              ?>
              <select class="form-select" id="show_login_link" name="show_login_link" aria-label="show_login_link_span">
                <option>Show Login Link</option>
                <option value="0"<?=$selected_show_login_link_no?>>No</option>
                <option value="1"<?=$selected_show_login_link_yes?>>Yes</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer bg-primary">
          <button type="button" class="btn btn-warning btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm">Save changes</button>
        </div>
        <?=form_close()?>
      </div>
    </div>
  </div>
  <!-- End Modal edit startpage settings-->
<?php
}
?>
  <div class="row">
    <div class="col">&nbsp;</div>

<?php
$i = 1;
$a = 1;
$modal = '';
// Begin while loop for the output of all the categories and links
while($i < 5)
{
  echo '<div class="col my-3 px-0 mx-2"><!-- column '.$i.' -->';
  foreach($categories as $key => $value)
  {
    $bg_header  = (!empty($value['background_color_header'])) ? ' '.$value['background_color_header'] : '';
    $text_color_header       = (!empty($value['text_color_header'])) ? ' '.$value['text_color_header'] : '';
    if($value['column'] == $i AND $value['visible'] == 1)
    {
      if($logged_in == TRUE)
        $edit_button = '<button style="float: right;" type="button" class="py-0 m-0 btn btn-transparent btn-sm" data-bs-toggle="modal" data-bs-target="#Edit_Modal_'.$value['id'].'"><i class="fa-solid fa-pencil"></i></button>';
      else
        $edit_button = '';

?>

      <div class="card mx-0 mb-1 rounded-0">
        <div class="card-header rounded-0 p-1<?=$bg_header?><?=$text_color_header?>">
          <?=$value['name']?> <?=$edit_button?>
        </div>
        <div class="card-body p-0">

<?php
        foreach($links as $linkkey => $linkvalue)
        {
          if($linkvalue['type'] == 'list' AND !isset($already))
          {
            echo ($linkvalue['type'] == 'list') ? '<ul class="list-group list-group-flush p9-0 m-0 px-2 mb-2">' : '';
            $already = true;
          }
          switch ($linkvalue['type'])
          {
            case 'list':
              if($linkvalue['category_id'] == $value['id'] )
              {
                if($a <= $value['numb_links'])
                {
                  $target = ($linkvalue['target'] == 0) ? ' target="_self"' : ' target="_blank"';

                  if(!empty($linkvalue['icon']))
                    $link = ($linkvalue['icon_place'] == 0) ? $linkvalue['icon'] . ' <a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a>' : '<a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $link_open . '>' . $linkvalue['name'] . '</a> ' . $linkvalue['icon'];
                  else
                    $link = '<a title="' . $linkvalue['title'] . '" class="icon-link link-dark" href="' . $linkvalue['url'] . '"'.$link_open.'>'.$linkvalue['name'].'</a>';

                  echo '<li class="list-group-item p-0 m-0">' . $link . '</li>';
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
        $a=1;
        echo ($linkvalue['type'] == 'list') ? '</ul>' : '';
        unset($already);

?>

        </div><!-- End Card Body -->

<?php
  if($more[$value['id']] == 1)
  {
    $link_color_header = (!empty($value['link_color_header'])) ? ' '.$value['link_color_header'] : '';
    $link_color_footer = (!empty($value['link_color_footer'])) ? ' '.$value['link_color_footer'] : '';
    $bg_footer  = (!empty($value['background_color_footer'])) ? $value['background_color_footer'] : '';
    ?>

        <div class="card-footer <?=$bg_footer?> py-0 ps-2">
          <button type="button" class="btn btn-link<?=$link_color_footer?>" data-bs-toggle="modal" data-bs-target="#more_<?=$value['id']?>">
            More
          </button>
        </div>

<?php
    $modal .= '<!-- Modal -->
          <div class="modal modal-sm fade" id="more_'.$value['id'].'" tabindex="-1" aria-labelledby="#more_'.$value['id'].'" aria-hidden="true">
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
                          $target = ($linkvalue['target'] == 0) ? ' target="_self"' : ' target="_blank"';

                          if(!empty($linkvalue['icon']))
                            $link = ($linkvalue['icon_place'] == 0) ? $linkvalue['icon'] . ' <a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a>' : '<a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $link_open . '>' . $linkvalue['name'] . '</a> ' . $linkvalue['icon'];
                          else
                            $link = '<a title="' . $linkvalue['title'] . '" class="icon-link link-dark" href="' . $linkvalue['url'] . '"'.$link_open.'>'.$linkvalue['name'].'</a>';

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
$edit_modal = '';
if($logged_in == TRUE)
{
  foreach($categories as $key => $value)
  {
    $background_color = (!empty($value['background_color'])) ? ' '.$value['background_color'] : '';
    $text_color       = (!empty($value['text_color'])) ? ' '.$value['text_color'] : '';

$edit_modal .= '<!-- Edit_Modal_'.$value['id'].' -->
    <div class="modal fade" id="Edit_Modal_'.$value['id'].'" tabindex="-1" aria-labelledby="Edit_Modal_'.$value['id'].'_Label" aria-hidden="true">
        <input type="hidden" value="'.$value['id'].'" id="category_'.$value['id'].'" name="category_'.$value['id'].'">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header '.$background_color . $text_color.'">
            <h1 class="modal-title fs-5" id="Edit_Modal_'.$value['id'].'_Label">Edit Category '.$value['name'].'</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            '.form_open('edit_category').'
            ...
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            '.form_close().'
            </div>
        </div>
      </div>
    </div>';

  }
}
echo $edit_modal; // here are all the edit Modal's of every category
echo $modal; // here are all the Modal's of the more links in every category

if (!empty($settings['show_footer']) == 1)
{
 ?>

  <footer class="bg-body-tertiary text-muted">
    <div class="pt-4" style="background-color: rgba(0, 0, 0, 0.05);">
      <div class="d-flex justify-content-center justify-content-lg-between py-4 border-bottom">
        <div class="col text-start">
          <span class="">Get connected with us on social networks:</span>
        </div>
        <div class="col text-center">
          © <?= date('Y') ?> Copyright: <a class="text-body" href="http://startpage.io" target="_blank">StartPage</a>
        </div>
        <div class="col text-end">
          <a href="" class="me-4 text-reset">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="me-4 text-reset">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="me-4 text-reset">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="me-4 text-reset">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="me-4 text-reset">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="me-4 text-reset">
            <i class="fab fa-github"></i>
          </a>
        </div>
</div>
    </div>
  </footer>

<?php
}
/* echo "<pre>";
print_r($more);
echo "</pre>"; */
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>