<?php $cat = get_field('prog_cat', pll_get_post(40));
if ($cat) { ?>
  <div class="sProgram swiper-js">
    <div class="swiper-container sProgram__container">
      <div class="swiper-wrapper sProgram__items">
        <?php foreach ($cat as $it) { ?>
          <?php
          $post = $it;
          setup_postdata($post);
          $tumb = get_field('prev_img') ?: get_bloginfo("template_directory") . "/img/sProgram1.jpg";
          $t    = get_field('prev_t') ?: get_the_title();
          $d    = get_field('prev_d');
          ?>
          <a href="<?php the_permalink(); ?>" class="swiper-slide sProgram__item" data-an="_imgR2L">
            <div class="sProgram__itemWr sProgram__itemWr_parallax">
              <div class="sProgram__itemFon" data-lozy-bgimg="<?= $tumb ?>"></div>
              <div class="sProgram__itemB" data-an="_fadeIn" data-del="1.5">
                <div class="sProgram__itemTitle"><?= $t ?></div>
                <div class="sProgram__itemTxt"><?= $d ?></div>
              </div>
            </div>
          </a>
        <?php }
        wp_reset_postdata(); ?>


      </div>
      <div class="sProgram__wNav">
        <div class="sProgram__b-nav">
          <div class="sProgram__nav sProgram__nav_prev" data-prev>
            <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedLt.svg" alt="left-red-ic" width="28" height="21">
          </div>
          <div class="sProgram__nav sProgram__nav_next" data-next>
            <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedRt.svg" alt="right-red-ic" width="28" height="21">
          </div>
        </div>
        <div class="swiper-pagination" data-pagination></div>
      </div>
    </div>
  </div>
<?php } ?>
