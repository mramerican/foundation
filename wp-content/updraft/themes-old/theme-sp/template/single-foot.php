<?php
$posts = get_posts([
  'numberposts'      => 3,
  'category'         => pll_get_term(1),
  'orderby'          => 'rand',
  'order'            => 'DESC',
  'exclude'          => get_the_ID(),
  'post_type'        => 'post',
  'post_status'      => 'publish',
  'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
]);
if ($posts):?>
  <div class="bBlog__row">

    <div class="bNews">
      <?php
      foreach ($posts as $post) {
        setup_postdata($post);
        $tumb = get_field('prev_img') ? : get_bloginfo("template_directory") . "/img/bNews1.jpg";
        $t = get_field('prev_t') ? : get_the_title();
        $d = get_field('prev_d');
        $par = get_field('prev_cat') ? : __('Новини', 'theme-sp');
        $date = get_the_date("d.m.Y");
        ?>
        <a href="<?php the_permalink(); ?>" class="bNews__item" data-an="_fadeIn">
          <div class="bNews__txt">
            <div class="bNews__info">
              <div class="bNews__date"><?= $date ?></div>
              <div class="bNews__cat"><?= $par ?></div>
            </div>
            <h4 class="bNews__title"><?= $t ?></h4>
          </div>
          <div class="bNews__wImg" data-an="_imgR2L">
            <?php
            if ($img = $tumb) {
              $imgId = attachment_url_to_postid($img);
              $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
            }
            else $alt = get_field('h1')?: get_the_title();?>
            <img class="bNews__img" data-src="<?= kama_thumb_src( 'w=364 &h=232 &crop=top', $tumb ) ?>" alt="Parimatch Foundation - <?= $alt ?>" width="364" height="232">
          </div>
        </a>
      <?php }
      wp_reset_postdata(); // сброс
      ?>
    </div>

  </div>
<?php endif; ?>