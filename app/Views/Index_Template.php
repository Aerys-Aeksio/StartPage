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
define('StartPage', 'StartPage');
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
  <?="\n\t".link_tag(base_url().'Assets/css/Default-Css.css', 'stylesheet')."\n";?>

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
      <img class="mb-3" style="height:50px;" src="<?=base_url()?>Assets/images/startpage-header.png" alt="Logo">
    </div>
    <div class="col-4"></div>
  </div>
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

            <li class="nav-item d-none">
              <a href="#" class="btn" data-bs-toggle="modal">
                Add Link / Category
              </a>
            </li>
            <li class="nav-item me-2">
              <button type="button" class="mb-2 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_link">
                Add Link
              </button>
            </li>
            <li class="nav-item me-2">
              <button type="button" class="mb-2 btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#add_category">
                Add Category
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
  <div class="row mx-0">
    <div class="col">&nbsp;</div>

<?php
$i = 1;
$a = 0;
$more_modal = '';
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
      if($logged_in === TRUE)
        $edit_cat_button = '<button style="float: right;" type="button" class="py-0 m-0 btn btn-transparent btn-sm" data-bs-toggle="modal" data-bs-target="#Edit_Modal_Cat'.$value['id'].'"><i class="fa-solid fa-pencil"></i></button>';
      else
        $edit_cat_button = '';
?>

      <div class="card mx-0 mb-1 rounded-0">
        <div class="card-header rounded-0 p-1<?=$bg_header?><?=$text_color_header?>">
          <?=(!empty($value['side_icon']) AND $value['side_icon'] = '1') ? $value['icon'] : ''?> <?=$value['name']?>&nbsp;<?=(!empty($value['side_icon']) AND $value['side_icon'] = '0') ? $value['icon'] : ''?> <?=$edit_cat_button?>
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
          if($logged_in === TRUE)
            $edit_link_button = '<button style="float: right;" type="button" class="py-0 m-0 btn btn-transparent btn-sm" data-bs-toggle="modal" data-bs-target="#Edit_Modal_Link'.$linkvalue['id'].'"><i class="fa-solid fa-pencil"></i></button>';
          else
            $edit_link_button = '';
          // Switch betwee "list", "img" and "html"
          switch ($linkvalue['type'])
          {
            case 'list':
              if(($linkvalue['category_id'] == $value['id']) AND ($a < $value['numb_links']))
              {
                $target = ($linkvalue['target'] === '1') ? ' target="_blank"' : ' target="_self"';

                if(!empty($linkvalue['icon']))
                  $link = ($linkvalue['side_icon'] === '1') ? $linkvalue['icon'].'&nbsp;<a title="'.$linkvalue['title'].'" class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a>' : '<a title="'.$linkvalue['title'].'" class="icon-link link-dark" href="'.$linkvalue['url'].'"'.$target.'>'.$linkvalue['name'].'</a>&nbsp;'.$linkvalue['icon'];
                else
                  $link = '<a title="'.$linkvalue['title'].'" class="icon-link link-dark" href="'.$linkvalue['url'].'"'.$target.'>'.$linkvalue['name'].'</a>';

                echo '<li class="list-group-item p-0 m-0">'.$link.'&nbsp;'.$edit_link_button.'</li>';
                $a++;
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

        </div><!-- End Category Card Body -->

<?php
  if($more[$value['id']] == '1')
  {
    $bg_header          = (!empty($value['background_color_header'])) ? ' '.$value['background_color_header'] : '';
    $link_color_header  = (!empty($value['link_color_header'])) ? ' '.$value['link_color_header'] : '';
    $link_color_footer  = (!empty($value['link_color_footer'])) ? ' '.$value['link_color_footer'] : '';
    $bg_footer          = (!empty($value['background_color_footer'])) ? ' '.$value['background_color_footer'] : '';
?>

        <div class="card-footer <?=$bg_footer?> py-0 ps-2">
          <button type="button" class="btn btn-link<?=$link_color_footer?>" data-bs-toggle="modal" data-bs-target="#more_<?=$value['id']?>">
            More
          </button>
        </div>

<?php
    $more_modal .= '<!-- The More Modal -->
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

                          if($logged_in === TRUE)
                            $edit_link_button = '<button style="float: right;" type="button" class="py-0 m-0 btn btn-transparent btn-sm" data-bs-toggle="modal" data-bs-target="#Edit_Modal_Link'.$linkvalue['id'].'"><i class="fa-solid fa-pencil"></i></button>';
                          else
                          $edit_link_button = '';

                          if(!empty($linkvalue['icon']))
                            $link = ($linkvalue['side_icon'] == '1') ? $linkvalue['icon'] . ' <a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a>' : '<a class="icon-link link-dark" href="' . $linkvalue['url'] . '"' . $target . '>' . $linkvalue['name'] . '</a> ' . $linkvalue['icon'];
                          else
                            $link = '<a title="' . $linkvalue['title'] . '" class="icon-link link-dark" href="' . $linkvalue['url'] . '"'.$target.'>'.$linkvalue['name'].'</a>';

                          $more_modal .= '<li class="list-group-item p-0 m-0">' . $link . ' '.$edit_link_button.'</li>';
                        }
                      }
                    }
    $more_modal .= '
                  </ul>
                </div>
              </div>
            </div>
          </div>';
  }
?>

      </div>  <!-- End Category Card -->

<?php
    }
  }
  echo '</div>'; 
  $i++;
} // End while loop for the output of all the categories and links
?>

    <div class="col">&nbsp;</div>
    <div class="col">&nbsp;</div>
  </div>

<?php
if($logged_in === TRUE)
{
  // Here are all the edit Modal's of every category
  echo $this->include('Include-Modal-Edit-Category');
  //All the edit link modals
  echo $this->include('Include-Modal-Edit-Link');
  // Here are all the edit Modal's of the startpage settings
  echo $this->include('Include-Modal-Edit-Settings');
  // Here are all the add Modal's of the links and categories
  echo $this->include('Include-Modal-Add-Link-Add-Category');

}
// Here are all the Modal's of the more links in every category unless there aren't any
echo isset($more_modal) ? $more_modal : ''; 

// if user want's a footer here we show it
if (!empty($settings['show_footer']) == '1')
  echo $settings['html_footer'];
?>

</div>
<?=(empty($settings['foot']))?$settings['foot']:'';?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>