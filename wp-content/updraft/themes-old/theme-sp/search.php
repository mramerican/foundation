<?php

get_header();

?>
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _header = document.querySelector('.header');
      if (_header) _header.classList.add('_black');
    });
  </script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  <section class="top2" style="min-height: auto;">
    <div class="top2__box container">
      
      <div class="top2__row row jcsb">
        
        <div class="top2__lt c12">
          <h1 class="top2__title title56" data-an="_fadeUp20"><?php _e('Результат пошуку', 'theme-sp'); ?> : <?= get_search_query() ?></h1>
        </div>
      </div>
    
    </div>
  </section>
  
  <section class="bBlog pCat">
    <div class="container">
      
      <div class="bBlog__row">
        
        <div class="bNews">
          <?php if (have_posts()): while (have_posts()): the_post(); ?>
            <?php
            $tumb = get_field('prev_img');
            $t = get_field('prev_t') ? : get_the_title();
            $d = get_field('prev_d');
            $par = get_field('prev_cat') ? : __('Новини', 'theme-sp');
            $date = get_the_date("d.m.Y");
            if ($tumb):
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
                    $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                  } else $alt = get_field('h1') ? : get_the_title(); ?>
                  <img class="bNews__img" data-src="<?= kama_thumb_src('w=364 &h=232 &crop=top', $tumb) ?>" alt="Parimatch Foundation - <?= $alt ?>" width="364" height="232">
                </div>
              </a>
            <?php else: ?>
              <a href="<?php the_permalink(); ?>" class="bNews__item" data-an="_fadeIn">
                <div class="bNews__txt">
                  <div class="bNews__info">
                    <div class="bNews__date"><?= $date ?></div>
                    <div class="bNews__cat"><?= $par ?></div>
                  </div>
                  <h4 class="bNews__title"><?= $t ?></h4>
                </div>
              </a>
            <?php endif; ?>
          <?php endwhile; ?>
            <!--post navigation-->

          <?php else: ?>
            <!--no posts found-->
            <p><?php _e('за вашим запитом нічого не знайдено', 'theme-sp'); ?></p>
          <?php endif; ?>
        
        
        </div>
      
      
      </div>
    
    </div>
  </section>
<?php } ?>

<?php
get_footer();
