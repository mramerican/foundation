<section class="bPartners">
  <div class="container">

    <?php
    $post = pll_get_post(40); // page home
    setup_postdata($post);
    ?>

    <div class="bTitle" data-an="_fadeUp _border">
      <h3 class="bPartners__title title56"><?php the_field('partners_t'); ?></h3>
    </div>

    <div class="bPartners__desc desc desc_600" data-an="_fadeUp"><?php the_field('partners_d'); ?></div>

    <?php $items = get_field('partners_items');
    if ($items) { ?>
      <div class="bPartners__row" data-an="_fadeIn">
        <div class="sPartner swiper-js">
          <div class="swiper-container sPartner__container">
            <div class="swiper-wrapper sPartner__items">
              <?php foreach ($items as $it) { ?>

                <div class="swiper-slide sPartner__item">
                  <div class="sPartner__itemWr">
                    <div class="sPartner__itemPic">
                      <?php
                      if ($img = $it['img']) {
                        $imgId = attachment_url_to_postid($img);
                        $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
                      }
                      else $alt = get_field('h1')?: get_the_title();?>
                      <img class="sPartner__itemImg imgSize" data-src="<?= $img ?>" alt="Parimatch Foundation - <?= $alt ?>" width="158" height="106">

                    </div>
                    <div class="sPartner__itemTxt"><?= $it['t']; ?></div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>

          <div class="sPartner__wNav mdShow">
            <div class="sPartner__b-nav">
              <div class="sPartner__nav sPartner__nav_prev" data-prev>
                <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedLt.svg" alt="left-red-ic" width="28" height="21">
              </div>
              <div class="sPartner__nav sPartner__nav_next" data-next>
                <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedRt.svg" alt="right-red-ic" width="28" height="21">
              </div>
            </div>
            <div class="swiper-pagination" data-pagination></div>
          </div>
        </div>
      </div>
    <?php }
    wp_reset_postdata(); ?>

  </div>
</section>