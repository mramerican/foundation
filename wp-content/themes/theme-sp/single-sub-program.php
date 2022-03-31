<?php
/*
Template Name: підпрограма
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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _breadcrumb = document.querySelector('.breadcrumb');
      if (_breadcrumb) _breadcrumb.classList.add('_white');
    });
  </script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  <section class="top" data-lozy-bgimg="<?= get_field('fon') ? : get_bloginfo("template_directory") . '/img/programSubTop.jpg' ?>">
    <div class="container">

      <?php breadcrumbSingle(get_the_title(), $catName, $catId); ?>

      <div class="top__row row">

        <div class="top__lt c5 c8-md">
          <h1 class="top__title title88" data-an="_fadeUp20"><?= $h1 ?></h1>
        </div>

        <div class="top__rt c3 c8-md">
          <div class="top__desc" data-an="_fadeUp20"><?php the_field('d'); ?></div>
        </div>
      </div>

    </div>
    <div class="container">
      <a href="#nextB" class="down">
        <img class="down__img imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/down.svg" alt="down-ic" data-an="_zoom" width="33" height="33">
        >
      </a>
    </div>
  </section>

  <section class="pAbTop" id="nextB">
    <div class="container">


      <div class="pAbB row">
        <?php $bnew = get_field('about_dnew') ?>
        <div class="pAbB__col pAbB__col_1 c4 c8-md">
          <h2 class="pAbTop__title title64" data-an="_fadeUp20"><?php the_field('about_t'); ?></h2>
          <?php
          if ($img = get_field('about_img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=656 &h=458 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/programSub1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__imgCustom mdHide imgSizeK" data-an="_imgR2L" width="656" height="458">

          <?php if ($bnew): ?>
            <div class="pAbTop__desc desc desc_660 mdHide" data-an="_fadeUp20"><?= $bnew ?></div>
          <?php endif; ?>
        </div>

        <div class="pAbB__col pAbB__col_2 pAbB__col_pt0 c3 c8-md">

          <div class="desc" data-an="_fadeUp20"><?php the_field('about_d'); ?></div>

          <?php
          if ($img = get_field('about_img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=656 &h=458 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/programSub1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__imgCustom mdShow imgSizeK" data-an="_imgR2L" width="656" height="458">

          <div class="pAbB__txt txt txt_320" data-an="_fadeUp20"><?php the_field('about_d1'); ?></div>

          <?php
          if ($img = get_field('about_img1')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=487 &h=320 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/programSub2.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__img imgSizeK" data-an="_imgL2R" style="margin-bottom: 0;" width="487" height="320">

          <?php if ($bnew): ?>
            <div class="pAbTop__desc desc desc_660 mdShow" data-an="_fadeUp20"><?= $bnew ?></div>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </section>

  <section class="block">
    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="block__title title56"><?php the_field('b1_t'); ?></h3>
      </div>

      <?php $sl = get_field('b1_sl');
      if ($sl) { ?>

        <div class="sImplement swiper-js">

          <div class="sImplement__top">
            <div class="block__desc desc desc_660" data-an="_fadeUp20"><?php the_field('b1_d'); ?></div>

            <div class="sImplement__b-nav smHide">
              <div class="sImplement__nav sImplement__nav_prev" data-prev>
                <img class="sPartner__arr imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedLt.svg" alt="left-red-ic" width="28" height="21">
              </div>
              <div class="sImplement__nav sImplement__nav_next" data-next>
                <img class="sProgram__arr" data-src="<?php bloginfo("template_directory"); ?>/img/sliderRedRt.svg" alt="right-red-ic" width="28" height="21">
              </div>
            </div>
          </div>

          <div class="swiper-container sImplement__container smHide">
            <div class="swiper-wrapper sImplement__items">

              <?php foreach ($sl as $it) { ?>
                <div class="swiper-slide sImplement__item">
                  <div class="sImplement__itemWr">
                    <div class="sImplement__itemTitle title32 title32_500" data-an="_fadeUp20"><?= $it['t']; ?></div>
                    <div class="sImplement__itemDesc" data-an="_fadeUp20"><?= $it['d']; ?></div>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>

        <div class="sImplement__items smShow">
          <?php foreach ($sl as $it) { ?>
            <div class="sImplement__item">
              <div class="sImplement__itemWr">
                <div class="sImplement__itemTitle title32 title32_500" data-an="_fadeUp20"><?= $it['t']; ?></div>
                <div class="sImplement__itemDesc" data-an="_fadeUp20"><?= $it['d']; ?></div>
              </div>
            </div>
          <?php } ?>
        </div>

      <?php } ?>

    </div>
  </section>

  <?php if (get_field('num_check')): ?>
    <div class="pProgNum">
      <?php require_once get_template_directory() . '/template/numbersSelf.php'; ?>
    </div>
  <?php endif; ?>

  <section class="bBlog bBlog_single">
    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="bBlog__title title56"><?php _e('Цікаві статті, та новини', 'theme-sp'); ?></h3>
      </div>

      <?php require_once get_template_directory() . '/template/single-foot.php'; ?>

    </div>
  </section>

  <?php require_once get_template_directory() . '/template/next-page.php'; ?>
<?php } ?>

<?php
get_footer();