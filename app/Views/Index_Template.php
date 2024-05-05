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
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer"> -->
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
  echo '
            <li class="nav-item">
              <a class="nav-link'.$nav_link_color.'" href="'.url_to('login').'">Login</a>
            </li>';
}
elseif($login_link AND $logged_in == TRUE)
{
  echo '
            <li class="nav-item">
              <a class="nav-link'.$nav_link_color.'" href="'.url_to('logout').'">Logout</a>
            </li>';
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
?>
  <div class="row">
    <?=form_open('edit_settings')?>

    <?=form_close()?>
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
?>

  <div class="dropdown">
  <!-- <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Background Color
  </button> -->
  <select class="form-select w-25" id="background_color">

<?php
  foreach($bg_colors as $colors)
  {
    if($colors === "bg_black" OR $colors === "bg_dark")
      $text_color = ' text-light';
    else
      $text_color = '';

    echo '<option value="'.$colors.'" class="'.$colors.$text_color.'">'.$colors.'</option>';
  }
?>

  </select>
</div>
<?php
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