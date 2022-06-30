<?php
/**
 * cat post
 */
function cat()
{
  global $post;
  $catId = !empty($_POST['catId']) ? explode(',', $_POST['catId']) : false;
  $child = !empty($_POST['child']) ? (int)$_POST['child'] : 0;
  $count = !empty($_POST['count']) ? (int)$_POST['count'] : 0;

  if (!$catId) die();

  $args = [
    'numberposts'      => ($count + 1),
    'offset'           => $child,
    'category'         => $catId,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true,
  ];
  $res = get_posts($args);

  foreach ($res as $n => $post):
    setup_postdata($post);
    $n++;
    if($n > $count) break;
    ?>

    <div class="projCont__item" <?php if (count($res) <= (int)$count) echo 'data-post'; ?>>
      <div class="skew" data-an="_show">
        <a href="<?php the_permalink(); ?>" class="projCont__hover">
          <div class="projCont__hoverFon">
            <div class="projCont__hoverFonBtn"></div>
          </div>
          <div class="projCont__img" style="background-image:url(<?= get_field('prevImg') ? : get_bloginfo("template_directory") . '/img/bProj1.jpg'; ?>);"></div>
        </a>
      </div>
      <div class="projCont__info" data-an="_fadeDown">
        <div class="projCont__name"><?php the_title(); ?></div>
        <div class="projCont__txt">
          <span><?= get_field('prevSquare') ? : '125 кв.м'; ?></span>
          <span><?= get_field('place') ? : 'Киев. БЦ "Senator"'; ?></span>
        </div>
      </div>
    </div>
  <?php endforeach;
  wp_reset_postdata();
  die();
}

add_action('wp_ajax_cat', 'cat');
add_action('wp_ajax_nopriv_cat', 'cat');



/**
 * cookie
 */
function setcookieFun()
{
  setcookie("cookiePopupClose", "cookieTrue", time() + 15768000 , '/');
  /*session_start([
    'cookie_lifetime' => 15768000, // 1 год 31536000
	]);
  $_SESSION['cookiePopupClose'] = 'cookieTrue';*/

  die();
}

add_action('wp_ajax_setCookie', 'setcookieFun');
add_action('wp_ajax_nopriv_setCookie', 'setcookieFun');

/**
 * pagination
 */
function ps_pagenavi ($query = '', $echo = false, $pageLink = '', $pageFirst = '')
{
  // параметры по умолчанию
  $before          = '';        // Текст до навигации.
  $after           = '';        // Текст после навигации.
  $text_num_page   = '';        // Текст перед пагинацией. {current} - текущая. {last} - последняя (пр: 'Страница {current} из {last}' получим: "Страница 4 из 60").
  $num_pages       = 3;         // Сколько ссылок показывать.
  $step_link       = 10;        // Ссылки с шагом (если 10, то: 1,2,3...10,20,30. Ставим 0, если такие ссылки не нужны.
  $dotright_text   = '…';       // Промежуточный текст "до".
  $dotright_text2  = '…';       // Промежуточный текст "после".
  $back_text       = '&lsaquo;';// Текст "перейти на предыдущую страницу". Ставим 0, если эта ссылка не нужна.
  $next_text       = '&rsaquo;';// Текст "перейти на следующую страницу".  Ставим 0, если эта ссылка не нужна.
  $first_page_text = '&laquo;'; // Текст "к первой странице".    Ставим 0, если вместо текста нужно показать номер страницы.
  $last_page_text  = '&raquo;'; // Текст "к последней странице". Ставим 0, если вместо текста нужно показать номер страницы.

  if (!$query) {
    global $wp_query;
    $paged    = (int)$wp_query->query_vars['paged'] ?: 1;
    $max_page = $wp_query->max_num_pages;
  }
  else {
    $paged    = (int)$query->query_vars['paged'];
    $max_page = $query->max_num_pages;
  }
  if ($max_page <= 1)
    return false; //проверка на надобность в навигации

  if (empty($paged) || $paged == 0)
    $paged = 1;

  $pages_to_show         = intval($num_pages);
  $pages_to_show_minus_1 = $pages_to_show - 1;

  $half_page_start = floor($pages_to_show_minus_1 / 2); //сколько ссылок до текущей страницы
  $half_page_end   = ceil($pages_to_show_minus_1 / 2);  //сколько ссылок после текущей страницы

  $start_page = $paged - $half_page_start; //первая страница
  $end_page   = $paged + $half_page_end;   //последняя страница (условно)

  if ($start_page <= 0)
    $start_page = 1;
  if (($end_page - $start_page) != $pages_to_show_minus_1)
    $end_page = $start_page + $pages_to_show_minus_1;
  if ($end_page > $max_page) {
    $start_page = $max_page - $pages_to_show_minus_1;
    $end_page   = (int)$max_page;
  }

  if ($start_page <= 0)
    $start_page = 1;

  // создаем базу чтобы вызвать get_pagenum_link один раз
  $link_base = !empty($pageLink) ? $pageLink : str_replace(99999999, '___', get_pagenum_link(99999999));
  $first_url = !empty($pageFirst) ? $pageFirst : get_pagenum_link(1);
  if (false === strpos($first_url, '?'))
    $first_url = user_trailingslashit($first_url);

  // собираем елементы
  $els = array ();

  if ($text_num_page) {
    $text_num_page = preg_replace('!{current}|{last}!', '%s', $text_num_page);
    $els['pages']  = sprintf('<span>' . $text_num_page . '</span>', $paged, $max_page);
  }

  // в начало
  if ($start_page >= 2 && $pages_to_show < $max_page) {
    $els['first'] = '<li class="pagination__first"><a href="' . $first_url . '">' . ($first_page_text ?: 1) . '</a></li>';
  }

  // назад
  if ($back_text != false && $paged != 1)
    $els['prev'] = '<li class="pagination__prev"><a href="' . (($paged - 1) == 1 ? $first_url : str_replace('___', ($paged - 1), $link_base)) . '">' . $back_text . '</a></li>';

  // ...
  if ($start_page >= 2 && $pages_to_show < $max_page) {
    if ($dotright_text && $start_page != 2)
      $els[] = '<li class="pagination__dots"><span>' . $dotright_text . '</span></li>';
  }

  for ($i = $start_page; $i <= $end_page; $i++) {
    if ($i == $paged)
      $els['current'] = '<li class="pagination__item active"><span>' . $i . '</span></li>';
    else if ($i == 1)
      $els[] = '<li class="pagination__item"><a href="' . $first_url . '">1</a></li>';
    else
      $els[] = '<li class="pagination__item"><a href="' . str_replace('___', $i, $link_base) . '">' . $i . '</a></li>';
  }

  // ...
  if ($end_page < $max_page) {
    if ($dotright_text && $end_page != ($max_page - 1))
      $els[] = '<li class="pagination__dots"><span>' . $dotright_text2 . '</span>';
  }

  // ссылки с шагом
  $dd = 0;
  if ($step_link && $end_page < $max_page) {
    for ($i = $end_page + 1; $i <= $max_page; $i++) {
      if ($i % $step_link == 0 && $i !== $num_pages) {
        if (++$dd == 1)
          $els[] = '<li class="pagination__item"><a href="' . str_replace('___', $i, $link_base) . '">' . $i . '</a></li>';
      }
    }
  }

  // вперед
  if ($next_text != false && $paged != $end_page)
    $els['next'] = '<li class="pagination__next"><a href="' . str_replace('___', ($paged + 1), $link_base) . '">' . $next_text . '</a></li>';

  // в конец
  if ($end_page < $max_page) {
    $els['last'] = '<li class="pagination__last"><a href="' . str_replace('___', $max_page, $link_base) . '">' . ($last_page_text ?: $max_page) . '</a></li>';
  }

  // обвертка
  $out = $before . '<ul class="pagination">' . implode(' ', $els) . '</ul>' . $after;
  if ($echo) {
    echo $out;
    return false;
  }
  else return $out;
}


/**
 * more post
 */
function morePost ()
{
  session_start();
  global $post;
  $args        = !empty($_POST['args']) ? $_POST['args'] : 0;
  if (!$args) die();

  $query = new WP_Query($args);

  if ($query->have_posts()):
    while ($query->have_posts()): $query->the_post(); ?>
      <?php
      $tumb = get_field('prev_img') ?: get_bloginfo("template_directory") . "/img/bNews1.jpg";
      $t    = get_field('prev_t') ?: get_the_title();
      $d    = get_field('prev_d');
      $par  = get_field('prev_cat') ?: __('Новини', 'theme-sp');
      $date = get_the_date("d.m.Y");
      ?>
      <a href="<?php the_permalink(); ?>" class="bNews__item _animated _fadeIn _pointer"<?php if ($query->max_num_pages <= $query->query_vars['paged']) echo ' data-no' ?>>
        <div class="bNews__txt">
          <div class="bNews__info">
            <div class="bNews__date"><?= $date ?></div>
            <div class="bNews__cat"><?= $par ?></div>
          </div>
          <h4 class="bNews__title"><?= $t ?></h4>
        </div>
        <div class="bNews__wImg _animated _imgR2L _pointer">
          <?php
          if ($img = $tumb) {
            $imgId = attachment_url_to_postid($img);
            $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
          }
          else $alt = get_field('h1')?: get_the_title();?>
          <img class="bNews__img" src="<?= kama_thumb_src( 'w=364 &h=232 &crop=top', $tumb ) ?>" alt="Parimatch Foundation - <?= $alt ?>" width="364" height="232">
        </div>
      </a>
    <?php endwhile;
    wp_reset_postdata(); // сброс
  endif;
  die();
}

add_action('wp_ajax_morePost', 'morePost');
add_action('wp_ajax_nopriv_morePost', 'morePost');

function paginationAjax(){
  session_start();
  global $post;
  $args        = !empty($_POST['args']) ? $_POST['args'] : 0;

  $pageLink = !empty($_POST['pageLink']) ? $_POST['pageLink'] : false;
  $pageFirst = !empty($_POST['pageFirst']) ? $_POST['pageFirst'] : false;

  $query = new WP_Query($args);


  $res = ps_pagenavi($query, false, $pageLink, $pageFirst);
  if($res) echo $res;
  die();
}

add_action('wp_ajax_paginationAjax', 'paginationAjax');
add_action('wp_ajax_nopriv_paginationAjax', 'paginationAjax');