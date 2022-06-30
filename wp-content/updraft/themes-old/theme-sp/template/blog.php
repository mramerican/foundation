<?php $cat = get_field('blog_cat');
if ($cat) { ?>
  <div class="bBlog__row">
    <div class="bNews">
      <?php $the_query = new WP_Query( 'posts_per_page=3' ); ?>
      <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
      <?php
        $tumb = get_field('prev_img') ? : get_bloginfo("template_directory") . "/img/bNews1.jpg";
        $t = get_field('prev_t') ? : get_the_title();
        $d = get_field('prev_d');
        $par = get_field('prev_cat') ? : __('Новини','theme-sp');
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
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
    <?php $link = get_field('blog_link');
    if ($link) {
      $url = $link['url'] ? : '#';
      $title = $link['title'] ? : __('Більше новин', 'theme-sp');
      $target = $link['target'] ? ' target="_blank"' : '';
      ?>
      <a href="<?= $url ?>" class="bBlog__btn btn-transparent" data-an="_fadeUp20"<?= $target ?>><?= $title ?></a>
      <?php
    } ?>
  </div>
<?php } ?>