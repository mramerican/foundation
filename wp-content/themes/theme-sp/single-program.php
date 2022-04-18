<?php
/*
Template Name: програма
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
      let _bodyWr = document.querySelector('.bodyWr');
      if (_bodyWr) _bodyWr.classList.add('_overVisible');
    });
  </script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  <section class="top" data-lozy-bgimg="<?= get_field('fon') ? : get_bloginfo("template_directory") . '/img/programTop.jpg' ?>">
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
      <a href="#nextB" class="down" data-an="_zoom">
        <img class="down__img imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/down.svg" alt="down-ic" width="33" height="33">
      </a>
    </div>
  </section>


  <?php
  if (have_rows('flex')):

    while (have_rows('flex')) : the_row();

      // block
      if (get_row_layout() == 'top'): ?>
        <section class="pAbTop" id="nextB" data-test>
          <div class="container">

            <div class="pAbB row">
              <?php $bnew = get_sub_field('about')['d'] ?>

              <div class="pAbB__col pAbB__col_1 c4 c8-md">
                <h2 class="pAbTop__title title64" data-an="_fadeUp20"><?= get_sub_field('about')['t']; ?></h2>

                <?php
                if ($img = get_sub_field('about')['img']) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>
                <?php $img_link = get_sub_field('about')['img_link']; ?>
                <?php if ($img_link): ?><a href="<?= $img_link ?>"><?php endif; ?>
                <img data-src="<?= kama_thumb_src('w=656 &h=458 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pProgram1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="imgBorder mdHide imgSizeK" data-an="_imgR2L" width="656" height="458">
                <?php if ($img_link): ?></a><?php endif; ?>

                <?php if ($bnew): ?>
                  <div class="pAbTop__desc desc desc_660 mdHide" data-an="_fadeUp20"><?= $bnew ?></div>
                <?php endif; ?>
              </div>

              <div class="pAbB__col pAbB__col_2 pAbB__col_pt0 c3 c8-md">
                <div class="desc" data-an="_fadeUp20"><?= get_sub_field('about')['d1']; ?></div>

                <?php
                if ($img = get_sub_field('about')['img']) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>
                <?php if ($img_link): ?><a href="<?= $img_link ?>"><?php endif; ?>
                <img data-src="<?= kama_thumb_src('w=656 &h=458 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pProgram1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="imgBorder mdShow imgSizeK" data-an="_imgR2L" width="656" height="458">
                <?php if ($img_link): ?></a><?php endif; ?>

                <div class="pAbB__txt txt txt_320" data-an="_fadeUp20"><?= get_sub_field('about')['d2']; ?></div>

                <?php
                if ($img = get_sub_field('about')['img1']) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>
                <?php $img1_link = get_sub_field('about')['img1_link']; ?>
                <?php if ($img1_link): ?><a href="<?= $img1_link ?>"><?php endif; ?>
                <img data-src="<?= kama_thumb_src('w=487 &h=320 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pProgram2.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__img imgSizeK" data-an="_imgL2R" width="487" height="320">
                <?php if ($img1_link): ?></a><?php endif; ?>

                <?php if ($bnew): ?>
                  <div class="pAbTop__desc desc desc_660 mdShow" data-an="_fadeUp20"><?= $bnew ?></div>
                <?php endif; ?>
              </div>
            </div>

          </div>
        </section>
      <?php

      // block
      elseif (get_row_layout() == 'video'): ?>
        <?php $link = get_sub_field('link') ?>
        <div class="videoYou">
          <div class="container">
            <div class="videoYou__b" data-an="_imgR2L">
              <iframe class="videoYou__video" data-src="<?= $link ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
          </div>
        </div>

      <?php

      // block
      elseif (get_row_layout() == 'numbers'): ?>
        <div class="pProgNum">
          <section class="pAbPerform">
            <div class="container">

              <div class="bTitle" data-an="_border _fadeUp20">
                <h3 class="pAbValues__title title56"><?= get_sub_field('numbers')['t'] ?></h3>
              </div>

              <?php $items = get_sub_field('numbers')['items'];
              if ($items) { ?>
                <div class="performance" data-num-main>
                  <?php foreach ($items as $it) { ?>
                    <div class="performance__item">
                      <div class="performance__title" data-an="_fadeUp20"><?= $it['t']; ?></div>
                      <div class="performance__sub" data-an="_fadeUp20"><?= $it['s']; ?></div>
                      <div class="performance__pic" data-lozy-bgimg="<?= $it['ic'] ? : get_bloginfo("template_directory") . '/img/performance1.png' ?>" data-an="_fadeIn">
                        <div class="performance__num">
                          <span data-an="_num" data-num="<?= $it['num']; ?>">0</span>
                          <?php if ($units = $it['units']): ?>
                            <span><?= $units ?></span>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
          </section>
        </div>
      <?php

      // block
      elseif (get_row_layout() == 'b1'): ?>
        <section class="bAs">
          <div class="container">

            <div class="bTitle" data-an="_fadeUp20">
              <h3 class="bAs__title title56"><?= get_sub_field('b1')['t']; ?></h3>
            </div>

            <?php $items = get_sub_field('b1')['items'];
            if ($items) { ?>
              <div class="implement row">
                <div class="implement__col implement__col_1 c2 c8-md">


                  <div class="implement__wNav" data-an="_fadeUp20">
                    <div class="implement__progress">
                      <div class="implement__progressBar" data-progressBar></div>
                    </div>
                    <ul class="implement__nav">
                      <?php foreach ($items as $n => $it) { ?>
                        <li class="implement__navItem">
                          <a href="#implement<?= $n ?>" class="implement__navLink<?php if ($n < 1) echo ' _active'; ?>" data-anchorScroll><?= $it['t']; ?></a>
                        </li>
                      <?php } ?>
                    </ul>
                  </div>

                  <div class="implement__scroll" data-an="_fadeUp20">

                    <svg class="implement__scrollBtn" width="150" height="150" viewbox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg" data-anchor="nextBl2">
                      <circle r="74" cx="75" cy="75" fill="none" stroke-width="1" stroke="#F2F2F2"/>
                      <circle class="circleProgress" r="74" cx="75" cy="75" fill="none" stroke-width="1" stroke="#CB0D58" stroke-linecap="round" stroke-dasharray="0 471" stroke-dashoffset="-235"/>
                      <!--L=2πR-->
                      <path d="M75.4286 60L75.4286 92M75.4286 92L60 77.1429M75.4286 92L90.8571 77.1429" stroke="#CB0D58"/>
                    </svg>
                    <div class="implement__scrollTitle"><?php _e('скроль далі', 'theme-sp'); ?></div>
                  </div>

                </div>

                <div class="implement__items" data-progressDetect>
                  <?php foreach ($items as $n => $it) { ?>
                    <div class="implement__item" id="implement<?= $n ?>" data-anchorScrollIt="implement<?= $n ?>">
                      <div class="implement__itemLt">
                        <h4 class="implement__title title44" data-an="_fadeUp20"><?= $it['t']; ?></h4>
                        <div class="implement__txt txt_320" data-an="_fadeUp20"><?= $it['d']; ?></div>
                        <?php $link = $it['link'];
                        if ($link) {
                          $url = $link['url'] ? : '#';
                          $target = $link['target'] ? ' target="_blank"' : '';
                          ?>
                          <a href="<?= $url ?>" class="implement__btn btn-transparent" data-an="_fadeUp20"<?= $target ?>><?php _e('Детальніше', 'theme-sp'); ?></a>
                          <?php
                        } ?>
                      </div>

                      <div class="implement__itemRt" data-an="_imgL2R">
                        <?php
                        if ($img = $it['img']) {
                          $imgId = attachment_url_to_postid($img);
                          $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                        } else $alt = get_field('h1') ? : get_the_title(); ?>
                        <img data-src="<?= kama_thumb_src('w=487 &h=626 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/implement1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="implement__img imgSizeK" width="487" height="626">
                      </div>
                    </div>
                  <?php } ?>
                </div>

              </div>
            <?php } ?>

          </div>
        </section>
      <?php

      // block
      elseif (get_row_layout() == 'b2'): ?>

        <section class="block" id="nextBl2">
          <div class="container">

            <div class="bTitle" data-an="_fadeUp20">
              <h3 class="block__title title56"><?= get_sub_field('b2')['t']; ?></h3>
            </div>

            <div class="block row jcsb">
              <div class="block__col c3 c8-md">
                <div class="desc" data-an="_fadeUp20"><?= get_sub_field('b2')['d']; ?></div>
                <div class="block__txt txt txt_320" data-an="_fadeUp20"><?= get_sub_field('b2')['d1']; ?></div>
                <?php
                if ($img = get_sub_field('b2')['img']) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>
                <img data-src="<?= kama_thumb_src('w=487 &h=320 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/plan1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="block__img imgSizeK" data-an="_imgR2L" width="487" height="320">
              </div>

              <?php $items = get_sub_field('b2')['items'];
              if ($items) { ?>
                <div class="block__col c4 c8-md">
                  <div class="acc" data-acc>
                    <?php foreach ($items as $n => $it) { ?>
                      <div class="acc__item" data-acc-item data-an="_fadeUp20">
                        <div class="acc__head<?php if ($n < 1) echo ' _active'; ?>" data-acc-click>
                          <div class="acc__title title32"><?= $it['t']; ?></div>
                          <div class="acc__btn"></div>
                        </div>
                        <div class="acc__cont<?php if ($n < 1) echo ' _active'; ?>" data-acc-cont>
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
      <?php
      endif;

    endwhile;
  endif;
  ?>

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