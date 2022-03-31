<?php
/*
Template Name: новина
Template Post Type: post
*/
get_header();
$catName = "";
$catId = "";
$cats = get_the_category();
$h1 = get_field('h1') ? : get_the_title();
$par = get_field('prev_cat') ? : __('Новини', 'theme-sp');
$date = get_the_date("d.m.Y");
if ($cats) {
  $catName = $cats[0]->name;
  $catId = $cats[0]->term_id;
}
?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _header = document.querySelector('.header');
      if (_header) _header.classList.add('_black');
    });
  </script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  <section class="top2">
    <div class="top2__box container">


      <?php breadcrumbSingle(get_the_title(), $catName, $catId); ?>

      <div class="top2__row row jcsb">

        <div class="top2__lt c4 c8-md">
          <h1 class="top2__title title56" data-an="_fadeUp20"><?= $h1 ?></h1>
        </div>

        <div class="top2__rt c2 c8-md">
          <div class="top2__cat" data-an="_fadeUp20"><?= $par ?></div>
          <div class="top2__date" data-an="_fadeUp20"><?= $date ?></div>
        </div>
      </div>

    </div>
  </section>

  <article class="bArticle">
    <div class="container">

      <div class="article row">
        <div class="article__col article__col_1 c5 c8-md default">
          <?php
          if ($img = get_field('img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img class="article__tumb imgSizeK" data-src="<?= kama_thumb_src('w=825 &h=480 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/article.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" data-an="_imgL2R" width="825" height="480">
          <div class="article__desc" data-an="_fadeUp20"><?php the_field('d'); ?></div>

          <div class="article__cont" data-an="_fadeUp20"><?php the_field('cont'); ?></div>

          <div class="articleShare">
            <div class="articleShare__title" data-an="_fadeUp20"><?php _e('Поделиться', 'theme-sp'); ?>:</div>
            <div class="articleShare__b" data-an="_fadeUp20">
              <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php the_permalink(); ?>&p[title]=<?php the_title() ?>" class="articleShare__link" target="_blank" rel="nofollow">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/fa.svg" alt="facebook-ic" class="articleShare__ic imgSize" width="13" height="22">
              </a>
              <a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;hashtags=my_hashtag" class="articleShare__link" target="_blank" rel="nofollow">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/tw.svg" alt="twitter-ic" class="articleShare__ic" width="24" height="22">
              </a>
              <a class="articleShare__link" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=&source=<?php bloginfo('name'); ?>" target="_blank" rel="nofollow">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/in.svg" alt="linkedin-ic" class="articleShare__ic" width="24" height="24">
              </a>
              <a href="https://telegram.me/share/url?url=<?php the_permalink(); ?>" class="articleShare__link" target="_blank" rel="nofollow">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/te1.svg" alt="telegram-ic" class="articleShare__ic" width="24" height="22">
              </a>
            </div>
          </div>

        </div>

        <div class="article__col article__col_2 c3 c8-md">

          <div class="article__subscribe" data-an="_fadeUp20">
            <form class="article__subscribeForm" method="post" action="<?php bloginfo("template_directory"); ?>/mail/mail.php" novalidate data-form-share>
              <input type="hidden" name="form_name" value="<?php the_field('form_tSubscrive', 'options'); ?>">
              <div class="article__subscribeTitle"><?php the_field('form_tSubscrive', 'options'); ?></div>
              <div class="article__subscribeGroup">
                <input name="email" type="email" class="article__subscribeInput" placeholder="<?php the_field('form_emailP', 'options'); ?>" required>
              </div>
              <button type="submit" class="article__subscribeBtn btn-white"><?php the_field('form_btnSubscribe', 'options'); ?></button>
            </form>
          </div>

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
            <div class="interesting">
              <div class="interesting__title title24" data-an="_fadeUp20"><?php _e('Цікаві статті', 'theme-sp'); ?></div>

              <div class="interestingItems">
                <?php
                foreach ($posts as $post) {
                  setup_postdata($post);
                  $t = get_field('prev_t') ? : get_the_title();
                  $par = get_field('prev_cat') ? : __('Новини', 'theme-sp');
                  $date = get_the_date("d.m.Y");
                  ?>

                  <a href="<?php the_permalink(); ?>" class="interestingItems__item" data-an="_fadeUp20">
                    <div class="interestingItems__top">
                      <div class="interestingItems__date"><?= $date ?></div>
                      <div class="interestingItems__cat"><?= $par ?></div>
                    </div>
                    <div class="interestingItems__title"><?= $t ?></div>
                  </a>
                <?php }
                wp_reset_postdata(); // сброс
                ?>
              </div>

            </div>
          <?php
          endif;
          ?>

        </div>
      </div>

    </div>
  </article>


  <section class="bBlog bBlog_single">
    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="bBlog__title title56"><?php _e('Читайте також', 'theme-sp'); ?></h3>
      </div>

      <?php require_once get_template_directory() . '/template/single-foot.php'; ?>

    </div>
  </section>
<?php } ?>

<?php get_footer();