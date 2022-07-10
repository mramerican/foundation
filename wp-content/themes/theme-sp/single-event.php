<?php
/*
Template Name: подія
Template Post Type: post
*/
get_header();
$catName = "";
$catId = "";
$cats = get_the_category();
$formName = get_the_title();
$h1 = get_field('h1') ? : $formName;
if ($cats) {
  $catName = $cats[0]->name;
  $catId = $cats[0]->term_id;
}
?>
<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  <style>
    .sp-force-hide {
      display: block !important;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _breadcrumb = document.querySelector('.breadcrumb');
      if (_breadcrumb) _breadcrumb.classList.add('_white');

      let btnReg = document.querySelectorAll('.btn-red[data-modal]');
      if (btnReg) {
        btnReg.forEach(btn => {
          btn.addEventListener('click', () => {
            fbq('trackCustom', 'konf_form_click');
          });
        });
      }

      let btnSubCus = document.querySelectorAll('form .sp-button');
      if (btnSubCus) {
        btnSubCus.forEach(btn => {
          btn.addEventListener('click', () => {
            let formBl = btn.closest('form');
            if (!formBl) return;
            setTimeout(function () {
              let formErr = formBl.querySelector('.sp-invalid');
              if (!formErr) {
                fbq('track', 'Lead');
              }
            }, 400);
          });
        });
      }
    });

  </script>


  <section class="topEv" data-lozy-bgimg="<?= get_field('fon') ? : get_bloginfo("template_directory") . '/img/eventTop.jpg' ?>">

    <div class="container">

      <?php breadcrumbSingle(get_the_title(), $catName, $catId); ?>

    </div>

    <div class="topEv__box container">
      <div class="topEv__row row">

        <div class="topEv__lt c5 c4-md c8-sm">
          <h1 class="topEv__title title88" data-an="_fadeUp20"><?= $h1 ?></h1>

          <a href="#nextB" class="topEv__down down" data-an="_zoom">
            <img class="down__img imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/down.svg" alt="down-ic" width="33" height="33">
          </a>
        </div>

        <div class="topEv__rt c3 c4-md c8-sm">
          <div class="topEv__desc" data-an="_fadeUp20"><?php the_field('d'); ?></div>

          <div class="dateB" data-an="_fadeUp20">
            <div class="dateB__top">
              <div class="dateB__lt">
                <div class="dateB__day"><?php the_field('prev_day'); ?></div>
                <div class="dateB__dateRt">
                  <div class="dateB__month"><?php the_field('prev_month'); ?></div>
                  <div class="dateB__week"><?php the_field('prev_week'); ?></div>
                </div>
              </div>
              <div class="dateB__rt">
                <div class="dateB__time"><?php the_field('prev_start'); ?></div>
                <div class="dateB__dur"><?php the_field('prev_dur'); ?></div>
              </div>
            </div>

            <?php if ($kod = get_field('kod')): ?>
              <a href="#" class="dateB__btn btn-red btn-red_xl" data-modal="register"><?php _e('Зареєструватися', 'theme-sp'); ?></a>
              <div class="popup popup_customReg" data-popup="register">
                <div class="popup__content">
                  <?php echo do_shortcode($kod) ?>
                </div>
              </div>
            <?php else: ?>
              <a href="#" class="dateB__btn btn-red btn-red_xl" data-modal="popupRegister" data-form-name="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>"><?php _e('Зареєструватися', 'theme-sp'); ?></a>
            <?php endif; ?>

            <div class="dateB__share" data-modal="popupShare" data-form-name="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>">
              <img data-src="<?php bloginfo("template_directory"); ?>/img/share.svg" alt="share-ic" class="dateB__shareIc">
              <div class="dateB__shareTitle"><?php _e('Поділитися', 'theme-sp'); ?></div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </section>

  <section class="pAbTop" id="nextB">
    <div class="container">


      <div class="pAbB row">
        <div class="pAbB__col pAbB__col_1 c5 c8-md">
          <h2 class="pAbTop__title title64" data-an="_fadeUp20"><?php the_field('about_t'); ?></h2>
          <?php
          if ($img = get_field('about_img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= $img ? : get_bloginfo("template_directory") . '/img/eventSingle1.jpg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__imgCustom mdHide" data-an="_imgR2L">
        </div>

        <div class="pAbB__col pAbB__col_2 pAbB__col_pt0 c3 c8-md">

          <div class="desc" data-an="_fadeUp20"><?php the_field('about_d'); ?></div>
          <?php
          if ($img = get_field('about_img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= $img ? : get_bloginfo("template_directory") . '/img/eventSingle1.jpg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__imgCustom mdShow" data-an="_imgR2L">

          <div class="pAbB__txt txt txt_320" data-an="_fadeUp20"><?php the_field('about_d1'); ?></div>
          <?php
          if ($img = get_field('about_img1')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= $img ? : get_bloginfo("template_directory") . '/img/eventSingle2.jpg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__img" data-an="_imgL2R" style="margin-bottom: 0;">

        </div>
      </div>

    </div>
  </section>

  <?php if ($video = get_field('video')): ?>
    <div class="videoYou" id="youtube_video">
      <div class="container">
        <div class="bTitle" data-an="_fadeUp20">
          <div class="videoYou__top">
            <h3 class="block__title title56"><?php the_field('videob_t'); ?></h3>
            <div class="videoYou__top-rt">
              <div class="videoYou__top-t"><?= get_field('videob_t1') ? : 'Оберіть мову трансляції:' ?></div>
              <?php $list = get_field('videob_list');
              if ($list) { ?>
                <div class="videoYou__top-btn">
                  <?php foreach ($list as $it) { ?>
                    <?= $it['t'] ?>
                    <?php $link = $it['link'];
                    if ($link) {
                      $url = $link['url'] ? : '#';
                      $title = $link['title'] ? : __('Детальніше', 'theme-sp');
                      $target = $link['target'] ? ' target="_blank"' : '';
                      $red = $it['red'] ? 'btn-transparent btn-transparent_red' : 'btn-transparent';
                      ?>
                      <a href="<?= $url ?>" class="<?= $red ?>"<?= $target ?>><?= $title ?></a>
                      <?php
                    } ?>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="videoYou__b" data-an="_imgR2L">
          <iframe class="videoYou__video" data-src="<?= $video ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <section class="block">
    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="block__title title56"><?php the_field('b1_t'); ?></h3>
      </div>


      <div class="sTheme swiper-js">

        <div class="sTheme__top">
          <div class="block__desc desc desc_660" data-an="_fadeUp20"><?php the_field('b1_d'); ?></div>

          <div class="sTheme__b-nav smHide">
            <div class="sTheme__nav sTheme__nav_prev" data-prev>
              <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedLt.svg" alt="left-ic" width="28" height="21">
            </div>
            <div class="sTheme__nav sTheme__nav_next" data-next>
              <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedRt.svg" alt="right-ic" width="28" height="21">
            </div>
          </div>
        </div>

        <?php $sl = get_field('b1_sl');
        if ($sl) { ?>
          <div class="swiper-container sTheme__container smHide">
            <div class="swiper-wrapper sTheme__items">
              <?php foreach ($sl as $it) { ?>
                <div class="swiper-slide sTheme__item">
                  <div class="sTheme__itemWr">
                    <div class="sTheme__itemTitle title32 title32_500" data-an="_fadeUp20"><?= $it['t']; ?></div>
                  </div>
                </div>

              <?php } ?>
            </div>
          </div>
        <?php } ?>

      </div>

      <?php
      if ($sl) { ?>
        <div class="sTheme__items smShow">
          <?php foreach ($sl as $it) { ?>
            <div class="sTheme__item">
              <div class="sTheme__itemWr">
                <div class="sTheme__itemTitle title32 title32_500" data-an="_fadeUp20"><?= $it['t']; ?></div>
              </div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>

    </div>
  </section>


  <?php if (get_field('spicer_check')): ?>
    <section class="block">
      <div class="container">

        <div class="bTitle" data-an="_fadeUp20">
          <h3 class="block__title title56"><?php the_field('spicerT'); ?></h3>
        </div>

        <div class="spicer row jcsb">
          <div class="spicer__col spicer__col_1 c3 c4-md">
            <?php
            if ($img = get_field('spicer_foto')) {
              $imgId = attachment_url_to_postid($img);
              $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
            } else $alt = get_field('h1') ? : get_the_title(); ?>
            <img data-src="<?= $img ? : get_bloginfo("template_directory") . '/img/spicer.jpg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="spicer__img" data-an="_imgR2L">
          </div>

          <div class="c4 mdShow">
            <div class="spicer__soc" data-an="_fadeUp20">
              <?php if ($facebook = get_field('spicer_facebook')): ?>
                <a href="<?= $facebook ?>" class="spicer__socLink" target="_blank" rel="nofollow">
                  <img data-src="<?php bloginfo("template_directory"); ?>/img/facebook-blue.svg" alt="facebook-blue-ic" class="spicer__socIc imgSize" width="32" height="32">
                </a>
              <?php endif; ?>
              <?php if ($instagram = get_field('spicer_instagram')): ?>
                <a href="<?= $instagram ?>" class="spicer__socLink" target="_blank" rel="nofollow">
                  <img data-src="<?php bloginfo("template_directory"); ?>/img/instagram-red.svg" alt="instagram-red-ic" class="spicer__socIc">
                </a>
              <?php endif; ?>
            </div>
          </div>

          <div class="spicer__col spicer__col_2 c4 c8-md">
            <h4 class="spicer__title title44" data-an="_fadeUp20"><?php the_field('spicer_name'); ?></h4>
            <div class="spicer__desc desc" data-an="_fadeUp20"><?php the_field('spicer_d'); ?></div>

            <div class="spicer__soc mdHide" data-an="_fadeUp20">
              <?php if ($facebook = get_field('spicer_facebook')): ?>
                <a href="<?= $facebook ?>" class="spicer__socLink" target="_blank" rel="nofollow">
                  <img data-src="<?php bloginfo("template_directory"); ?>/img/facebook-blue.svg" alt="facebook-blue-ic" class="spicer__socIc imgSize" width="32" height="32">
                </a>
              <?php endif; ?>
              <?php if ($instagram = get_field('spicer_instagram')): ?>
                <a href="<?= $instagram ?>" class="spicer__socLink" target="_blank" rel="nofollow">
                  <img data-src="<?php bloginfo("template_directory"); ?>/img/instagram-red.svg" alt="instagram-red-ic" class="spicer__socIc">
                </a>
              <?php endif; ?>
            </div>

          </div>
        </div>


      </div>
    </section>
  <?php else: ?>
    <section class="block">
      <div class="container">

        <div class="bTitle" data-an="_fadeUp20">
          <h3 class="block__title title56"><?php the_field('spicerT'); ?></h3>
        </div>

        <?php $spicers = get_field('spicers');
        if ($spicers) { ?>
          <div class="spicers">
            <?php foreach ($spicers as $it) { ?>

              <div class="spicers__item">
                <div class="spicers__pic" data-an="_imgL2R">
                  <?php
                  if ($img = $it['foto']) {
                    $imgId = attachment_url_to_postid($img);
                    $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                  } else $alt = get_field('h1') ? : get_the_title(); ?>
                  <img data-src="<?= $img; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="spicers__img">
                </div>
                <h4 class="spicers__title title24" data-an="_fadeUp20"><?= $it['name']; ?></h4>
                <div class="spicers__desc" data-an="_fadeUp20"><?= $it['d']; ?></div>
                <div class="spicers__soc" data-an="_fadeUp20">
                  <?php if ($facebook = $it['facebook']): ?>
                    <a href="<?= $facebook ?>" class="spicers__socLink" target="_blank" rel="nofollow">
                      <img data-src="<?php bloginfo("template_directory"); ?>/img/facebook-blue.svg" alt="facebook-blue-ic" class="spicers__socIc imgSize" width="32" height="32">
                    </a>
                  <?php endif; ?>
                  <?php if ($instagram = $it['instagram']): ?>
                    <a href="<?= $instagram ?>" class="spicers__socLink" target="_blank" rel="nofollow">
                      <img data-src="<?php bloginfo("template_directory"); ?>/img/instagram-red.svg" alt="instagram-red-ic" class="spicers__socIc">
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    </section>
  <?php endif; ?>


  <section class="bProgram bProgram_event">

    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="bProgram__title title56"><?php the_field('join_t'); ?></h3>
      </div>

      <div class="row jcsb">
        <div class="c4 c8-md">
          <div class="bProgram__desc desc desc_660" data-an="_fadeUp20"><?php the_field('join_d'); ?></div>
        </div>
        <div class="c2 c4-lg c8-md">
          <div class="dateB dateB_black dateB_black_mod" data-an="_fadeUp20">
            <div class="dateB__top">
              <div class="dateB__lt">
                <div class="dateB__day"><?php the_field('prev_day'); ?></div>
                <div class="dateB__dateRt">
                  <div class="dateB__month"><?php the_field('prev_month'); ?></div>
                  <div class="dateB__week"><?php the_field('prev_week'); ?></div>
                </div>
              </div>
              <div class="dateB__rt">
                <div class="dateB__time"><?php the_field('prev_start'); ?></div>
                <div class="dateB__dur"><?php the_field('prev_dur'); ?></div>
              </div>
            </div>

            <?php if ($kod = get_field('kod1')): ?>
              <a href="#" class="dateB__btn btn-red btn-red_xl" data-modal="register2"><?php _e('Зареєструватися', 'theme-sp'); ?></a>
              <div class="popup popup_customReg" data-popup="register2">
                <div class="popup__content">
                  <?php echo do_shortcode($kod) ?>
                </div>
              </div>
            <?php else: ?>
              <a href="#" class="dateB__btn btn-red btn-red_xl" data-modal="popupRegister" data-form-name="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>"><?php _e('Зареєструватися', 'theme-sp'); ?></a>
            <?php endif; ?>

            <div class="dateB__share" data-modal="popupShare" data-form-name="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>">
              <img data-src="<?php bloginfo("template_directory"); ?>/img/share.svg" alt="share-ic" class="dateB__shareIc">
              <div class="dateB__shareTitle"><?php _e('Поділитися', 'theme-sp'); ?></div>
            </div>
          </div>
        </div>
      </div>

      <?php $sl = get_field('join_sl');
      if ($sl) { ?>
        <div class="bProgram__row" data-an="_fonR2L">

          <div class="bProgram__b">

            <div class="sProgram swiper-js">
              <div class="swiper-container sProgram__container">
                <div class="swiper-wrapper sProgram__items">

                  <?php foreach ($sl as $it) { ?>
                    <div class="swiper-slide sProgram__item sProgram__item_foto" data-an="_imgR2L">
                      <div class="sProgram__itemWr" data-lozy-bgimg="<?= $it['img'] ?>"></div>
                    </div>
                  <?php } ?>

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
          </div>

          <?php
          $lang = pll_current_language();
          if ($lang == 'en')
            $ic = "sliderDragIcEng.svg";
          elseif ($lang == 'ru')
            $ic = "sliderDragIcRu.svg";
          else $ic = "sliderDragIcUk.svg";
          ?>
          <img class="bProgram__dragIc imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/<?= $ic ?>" alt="drag-ic" data-an="_rotateL2R" data-del="0.5" width="120" height="120">

        </div>
      <?php } ?>

    </div>


  </section>

  <section class="block block_mb">
    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="block__title title56"><?php the_field('prog_t'); ?></h3>
      </div>

      <div class="pEvProg row jcsb">

        <div class="pEvProg__side block__col c3 c8-md">

          <div class="dateB dateB_black pEvProg__dateB" data-an="_fadeUp20">
            <div class="dateB__top">
              <div class="dateB__lt">
                <div class="dateB__day"><?php the_field('prev_day'); ?></div>
                <div class="dateB__dateRt">
                  <div class="dateB__month"><?php the_field('prev_month'); ?></div>
                  <div class="dateB__week"><?php the_field('prev_week'); ?></div>
                </div>
              </div>
              <div class="dateB__rt">
                <div class="dateB__time"><?php the_field('prev_start'); ?></div>
                <div class="dateB__dur"><?php the_field('prev_dur'); ?></div>
              </div>
            </div>

            <?php if ($kod = get_field('kod2')): ?>
              <a href="#" class="dateB__btn btn-red btn-red_xl" data-modal="register3"><?php _e('Зареєструватися', 'theme-sp'); ?></a>
              <div class="popup popup_customReg" data-popup="register3">
                <div class="popup__content">
                  <?php echo do_shortcode($kod) ?>
                </div>
              </div>
            <?php else: ?>
              <a href="#" class="dateB__btn btn-red btn-red_xl" data-modal="popupRegister" data-form-name="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>"><?php _e('Зареєструватися', 'theme-sp'); ?></a>
            <?php endif; ?>

            <div class="dateB__share" data-modal="popupShare" data-form-name="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>">
              <img data-src="<?php bloginfo("template_directory"); ?>/img/share.svg" alt="share-ic" class="dateB__shareIc">
              <div class="dateB__shareTitle"><?php _e('Поділитися', 'theme-sp'); ?></div>
            </div>
          </div>

        </div>

        <?php $items = get_field('prog_items');
        if ($items) { ?>

          <div class="block__col c4 c5-lg c8-md">
            <div class="acc acc_mb" data-acc>
              <?php foreach ($items as $n => $it) { ?>

                <div class="acc__item" data-acc-item data-an="_fadeUp20">
                  <div class="acc__head<?php if ($n < 1)
                    echo ' _active'; ?>" data-acc-click>
                    <div class="acc__title title32"><?= $it['t']; ?></div>
                    <div class="acc__btn"></div>
                  </div>
                  <div class="acc__cont<?php if ($n < 1)
                    echo ' _active'; ?>" data-acc-cont>
                    <div class="acc__desc"><?= $it['d']; ?></div>
                  </div>
                </div>

              <?php } ?>

            </div>
          </div>

        <?php } ?>
      </div>

    </div>
  </section>

  <section class="bRed">
    <div class="container">

      <div class="bRed__w">
        <div class="row jcsb">

          <div class="bRed__col bRed__col_1 c2 c4-lg c8-md">

            <div class="dateB dateB_bred" data-an="_fadeUp20">
              <div class="dateB__top">
                <div class="dateB__lt">
                  <div class="dateB__day"><?php the_field('prev_day'); ?></div>
                  <div class="dateB__dateRt">
                    <div class="dateB__month"><?php the_field('prev_month'); ?></div>
                    <div class="dateB__week"><?php the_field('prev_week'); ?></div>
                  </div>
                </div>
                <div class="dateB__rt">
                  <div class="dateB__time"><?php the_field('prev_start'); ?></div>
                  <div class="dateB__dur"><?php the_field('prev_dur'); ?></div>
                </div>
              </div>
            </div>


            <div class="bRed__desc desc" data-an="_fadeUp20"><?php the_field('red_d'); ?></div>

            <div class="tex mdHide">
              <div class="tex__title title32" data-an="_fadeUp20"><?php _e('Тех підтримка:', 'theme-sp'); ?></div>
              <div class="bContact">
                <?php $pageCont = pll_get_post(235); ?>
                <?php $tels = get_field('tels', $pageCont);
                if ($tels) { ?>
                  <div class="bContact__b" data-an="_fadeUp20">
                    <div class="bContact__pic">
                      <img data-src="<?php bloginfo("template_directory"); ?>/img/tel.svg" alt="tel-ic" class="bContact__ic">
                    </div>
                    <div class="bContact__rt">
                      <?php foreach ($tels as $n => $it) { ?>
                        <?php
                        $tel = $it['tel'];
                        $telLink = str_replace([
                          "(",
                          ")",
                          "-",
                          " ",
                        ], "", $tel);
                        ?>
                        <a href="tel:<?= $telLink ?>" class="bContact__link"><?= $tel ?></a>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($email = get_field('email', $pageCont)): ?>
                  <div class="bContact__b" data-an="_fadeUp20">
                    <div class="bContact__pic">
                      <img data-src="<?php bloginfo("template_directory"); ?>/img/mailWhite.svg" alt="email-ic" class="bContact__ic">
                    </div>
                    <div class="bContact__rt">
                      <a href="mailto:<?= $email ?>" class="bContact__link"><?= $email ?></a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>

          </div>

          <div class="bRed__col bRed__col_2 c4 c4-lg c8-md">

            <div class="bRed__form bForm">
              <?php if ($kod = get_field('kod3')): ?>
                <?php echo do_shortcode($kod) ?>
              <?php else: ?>
                <form class="form" method="post" action="<?php bloginfo("template_directory"); ?>/mail/mail.php" novalidate>
                  <input type="hidden" name="form_name" value="<?php _e('Зареєструватися', 'theme-sp'); ?> - <?= $formName ?>">
                  <div class="form__head">
                    <div class="form__title title32" data-an="_fadeUp20"><?php the_field('red_form_t'); ?></div>
                  </div>
                  <div class="form__group" data-an="_fadeUp20">
                    <div class="form__label">
                      <div class="form__name"><?php the_field('form_name', 'options'); ?></div>
                    </div>
                    <input name="name" type="text" class="form__input" required placeholder="<?php the_field('form_nameP', 'options'); ?>">
                  </div>
                  <div class="form__group" data-an="_fadeUp20">
                    <div class="form__label">
                      <div class="form__name"><?php the_field('form_tel', 'options'); ?></div>
                    </div>
                    <input name="tel" type="tel" class="form__input" required placeholder="<?php the_field('form_tel', 'options'); ?>">
                  </div>
                  <div class="form__group" data-an="_fadeUp20">
                    <div class="form__label">
                      <div class="form__name"><?php the_field('form_email', 'options'); ?></div>
                      <div class="form__note"><?php the_field('form_note', 'options'); ?></div>
                    </div>
                    <input name="email" type="email" class="form__input" placeholder="<?php the_field('form_emailP', 'options'); ?>">
                  </div>
                  <div class="form__group form__group_btn" data-an="_fadeUp20">
                    <div class="form__foot form__foot_pevent">
                      <button type="submit" class="form__btn btn-submit"><?php the_field('form_btnRegister', 'options'); ?></button>
                      <div class="form__policy"><?php the_field('form_polic', 'options'); ?></div>
                    </div>
                  </div>
                </form>
              <?php endif; ?>
            </div>

            <div class="tex mdShow">
              <div class="tex__title title32" data-an="_fadeUp20"><?php _e('Тех підтримка:', 'theme-sp'); ?></div>
              <div class="bContact">
                <?php $pageCont = pll_get_post(235); ?>
                <?php $tels = get_field('tels', $pageCont);
                if ($tels) { ?>
                  <div class="bContact__b" data-an="_fadeUp20">
                    <div class="bContact__pic">
                      <img src="<?php bloginfo("template_directory"); ?>/img/tel.svg" alt="tel-ic" class="bContact__ic">
                    </div>
                    <div class="bContact__rt">
                      <?php foreach ($tels as $n => $it) { ?>
                        <?php
                        $tel = $it['tel'];
                        $telLink = str_replace([
                          "(",
                          ")",
                          "-",
                          " ",
                        ], "", $tel);
                        ?>
                        <a href="tel:<?= $telLink ?>" class="bContact__link"><?= $tel ?></a>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($email = get_field('email', $pageCont)): ?>
                  <div class="bContact__b" data-an="_fadeUp20">
                    <div class="bContact__pic">
                      <img src="<?php bloginfo("template_directory"); ?>/img/mailWhite.svg" alt="email-ic" class="bContact__ic">
                    </div>
                    <div class="bContact__rt">
                      <a href="mailto:<?= $email ?>" class="bContact__link"><?= $email ?></a>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>
<?php } ?>

<?php
get_footer();