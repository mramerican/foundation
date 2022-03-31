<?php
/*
Template Name: Головна
*/
$dir = get_bloginfo("template_directory") . "/";
?>
<?php get_header(); ?>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') || strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh;')) { ?>

  <section class="mainTop">
    <?php $ban = get_field('ban'); ?>

    <?php if ($ban) { ?>
      <?php foreach ($ban as $n => $it) {
        $n++; ?>
        <div class="mainTop__img<?php if ($n < 2)
          echo ' _active'; ?>" data-slide-img="<?= $n ?>">
          <div class="mainTop__imgFon" data-lozy-bgimg="<?= kama_thumb_src('w=1920 &h=970 &crop=top', $it['fon'] ? : get_bloginfo("template_directory") . '/img/homeTop.jpg') ?>"></div>
        </div>
      <?php } ?>
    <?php } ?>

    <div class="mainTop__wr">
      <div class="container">
        <?php if ($ban) {
          $titleH1 = false;
          ?>
          <?php foreach ($ban as $n => $it) {
            $n++; ?>
            <div class="mainTop__img<?php if ($n < 2)
              echo ' _active'; ?>" data-slide-img="">
              <div class="mainTop__imgFon" data-lozy-bgimg="<?= $it['fon'] ? : get_bloginfo("template_directory") . '/img/homeTop.jpg' ?>"></div>
            </div>

            <div class="mainTop__item<?php if ($n < 2)
              echo ' _active'; ?>" data-slide-info="<?= $n ?>">
              <div class="mainTop__row row" data-an="_fadeIn">
                <div class="c5 c4-lg c8-sm mainTop__lt">
                  <?php if ($it['checkH1']): $titleH1 = true; ?>
                    <h1 class="mainTop__title title88"><?= $it['t']; ?></h1>
                  <?php else: ?>
                    <?php if ($titleH1): ?>
                      <h2 class="mainTop__title title88"><?= $it['t']; ?></h2>
                    <?php else: ?>
                      <div class="mainTop__title title88"><?= $it['t']; ?></div>
                    <?php endif ?>
                  <?php endif ?>

                </div>
                <div class="c3 c4-lg c8-sm mainTop__rt">

                  <div class="mainTop__desc"><?= $it['d']; ?></div>

                  <?php $link = $it['link'];
                  if ($link) {
                    $url = $link['url'] ? : '#';
                    $title = $link['title'] ? : __('Детальніше', 'theme-sp');
                    $target = $link['target'] ? ' target="_blank"' : '';
                    $nofollow = mb_stripos($url, 'trener1.com.ua') !== false ? ' rel="nofollow"' : '';
                    ?>
                    <a
                        href="<?= $url ?>"
                        class="mainTop__btn btn-circle"
                        data-an="_fadeBtnCircle"
                        <?= $target ?>
                        <?= $nofollow ?>
                    >
                        <?= $title ?>
                    </a>
                    <?php
                  } ?>
                </div>

              </div>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>

    <div class="mainTopNav" data-an="_fadeIn">
      <div class="container">
        <div class="mainTopNav__items">
          <?php if ($ban) {
            $res = count($ban); ?>
            <?php foreach ($ban as $n => $it) {
              $n++; ?>
              <div class="mainTopNav__item<?php if ($n < 2)
                echo ' _active'; ?>" data-slide="<?= $n ?>">
                <div class="mainTopNav__title"><?= $n ?>/<?= $res ?></div>
                <div class="mainTopNav__ic"></div>
              </div>
            <?php } ?>
          <?php } ?>

        </div>
      </div>

    </div>
  </section>
  <?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>

    <section class="bAbout">
      <div class="container">

        <div class="bAbout__bTitle bTitle" data-an="_border">
          <h2 class="bAbout__title title56" data-an="_fadeUp"><?php the_field('about_t'); ?></h2>
        </div>

        <div class="bAbout__row">

          <div class="bAbout__lt">

            <div class="bAbout__desc desc" data-an="_fadeUp"><?php the_field('about_q'); ?></div>

            <div class="bAbout__b mdHide">
              <div class="bAbout__desc1" data-an="_fadeUp"><?php the_field('about_d'); ?></div>
              <?php $link = get_field('about_link');
              if ($link) {
                $url = $link['url'] ? : '#';
                $title = $link['title'] ? : __('Детальніше', 'theme-sp');
                $target = $link['target'] ? ' target="_blank"' : '';
                ?>
                <a href="<?= $url ?>" class="bAbout__btn_white btn-transparent" data-an="_fadeUp"<?= $target ?>><?= $title ?></a>
                <?php
              } ?>
            </div>

            <?php if ($img = get_field('about_img')): ?>
              <div class="bAbout__pic mdHide" data-an="_imgR2L">
                <?php
                if ($img) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>

                <img data-src="<?= kama_thumb_src('w=592 &h=401 &crop=top', $img) ?>" alt="Parimatch Foundation - <?= $alt ?>" class="bAbout__img imgSizeK" width="592" height="401">
              </div>
            <?php endif; ?>

          </div>

          <div class="bAbout__rt">
            <svg class="bAbout__logo jsSvgPathLength" data-an="_svgPath" width="1220" height="863" viewBox="0 0 1220 863" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M950.538 29.0544L871.355 306.322C1030.5 305.931 1170.23 200.241 1213.97 47.0704L1219.12 29.0544H950.538Z" stroke="#FCF3F7" stroke-width="1.33333"/>
              <path d="M975.631 462.096L1001.46 371.476H849.985L782.372 608.703C872.187 608.313 950.986 548.582 975.631 462.096L976.272 462.279L975.631 462.096Z" stroke="#FCF3F7" stroke-width="1.33333"/>
              <path d="M704.121 655.131L882.902 29.034C756.426 29.423 645.303 113.248 610.176 234.898L429.121 861.814H430.273C557.435 861.814 669.187 777.473 704.121 655.131Z" stroke="#FCF3F7" stroke-width="1.33333"/>
              <path
                d="M180.843 325.304L181.509 325.333L180.843 325.304C182.898 278.867 203.745 237.005 239.599 207.462C285.575 169.526 351.719 172.979 393.547 215.445L393.072 215.913L393.547 215.445L505.3 328.99C508.408 332.148 511.827 334.775 515.314 337.366L552.117 209.913L552.758 210.098L552.117 209.913C558.569 187.582 568.312 167.071 579.481 147.585L521.835 89.0255C414.105 -20.4015 243.566 -29.2557 125.116 68.4196C50.4895 129.974 5.23351 220.732 0.993119 317.396C-3.23985 414.06 33.8547 508.422 102.815 576.255L102.347 576.73L102.815 576.255L254.643 725.67L254.176 726.145L254.643 725.67C269.967 740.754 289.872 759.341 311.427 779.468L312.482 780.454L312.027 780.941L312.482 780.454C331.211 797.944 351.687 817.161 371.294 836.038L427.49 641.45C409.985 625.088 393.611 609.766 380.885 597.248L381.353 596.772L380.885 597.248L229.049 447.84C195.937 415.255 178.804 371.719 180.843 325.304Z"
                stroke="#FCF3F7" stroke-width="1.33333"/>
            </svg>

            <div class="bAbout__foto bAbout__foto_home">
              <div class="bFoto bFoto_home">
                <div class="bFoto__pic bFoto__pic_home" data-an="_imgL2R">
                  <?php
                  if ($img = get_field('about_foto')) {
                    $imgId = attachment_url_to_postid($img);
                    $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                  } else $alt = get_field('h1') ? : get_the_title(); ?>
                  <img data-src="<?= kama_thumb_src('w=487 &h=640 &crop=top', $img) ?>" alt="Parimatch Foundation - <?= $alt ?>" class="bFoto__img imgSizeK" width="487" height="640">
                </div>

                <div class="bAbout__desc1" data-an="_fadeUp"><?php the_field('about_d1'); ?></div>

                <div class="bFoto__foot">
                  <div class="bAbout__quote" data-an="_fadeUp"></div>
                  <div class="bFoto__title" data-an="_fadeUp20"><?php the_field('about_name'); ?></div>
                  <div class="bFoto__desc" data-an="_fadeUp20" data-del="0.1"><?php the_field('about_position'); ?></div>
                </div>
              </div>
            </div>

            <div class="mdShow">
              <div class="bAbout__b">
                <div class="bAbout__desc1" data-an="_fadeUp"><?php the_field('about_d'); ?></div>
                <?php $link = get_field('about_link');
                if ($link) {
                  $url = $link['url'] ? : '#';
                  $title = $link['title'] ? : __('Детальніше', 'theme-sp');
                  $target = $link['target'] ? ' target="_blank"' : '';
                  ?>
                  <a href="<?= $url ?>" class="bAbout__btn btn-transparent" data-an="_fadeUp"<?= $target ?>><?= $title ?></a>
                  <?php
                } ?>
              </div>

              <?php if ($img = get_field('about_img')): ?>
                <div class="bAbout__pic" data-an="_imgR2L">
                  <?php
                  if ($img) {
                    $imgId = attachment_url_to_postid($img);
                    $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                  } else $alt = get_field('h1') ? : get_the_title(); ?>
                  <img data-src="<?= kama_thumb_src('w=592 &h=401 &crop=top', $img) ?>" alt="Parimatch Foundation - <?= $alt ?>" class="bAbout__img imgSizeK" width="592" height="401">
                </div>
              <?php endif; ?>
            </div>
          </div>

        </div>

      </div>

      <?php
      $titers1 = get_field('about_titers1');
      $titers2 = get_field('about_titers2');
      $titers3 = get_field('about_titers3');
      if ($titers1 || $titers2 || $titers3): ?>
        <script type="text/javascript">
          function insertTiters (elId, titers, speed = 40, isReverse = false) {
            const el = window.document.getElementById(elId);

            if (el) {
              let titersLi = '';
              const reverseClass = isReverse ? 'titers__list_revers' : '';

              for (let i = 0; i < 10; i++) {
                  titersLi += `<li class="titers__item">${titers}</li>`;
              }

              const titersUl = `<ul class="titers__list ${reverseClass}">${titersLi}</ul>`;
              el.innerHTML = `<div class="titers__main" data-titers data-speed="${speed}">${titersUl}${titersUl}</div>`;
            }
          }
        </script>
        <div class="titers" data-an="_fadeIn">
          <?php if (!empty($titers1)): ?>
            <div id="titers1"></div>
            <script type="text/javascript">insertTiters('titers1','<?= $titers1 ?>')</script>
          <?php endif; ?>
          <?php if (!empty($titers2)): ?>
            <div id="titers2"></div>
            <script type="text/javascript">insertTiters('titers2','<?= $titers2 ?>', 40, true)</script>
          <?php endif; ?>
          <?php if (!empty($titers3)): ?>
            <div id="titers3"></div>
            <script type="text/javascript">insertTiters('titers3','<?= $titers3 ?>', 20)</script>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <div class="container">
        <div class="bAbout__video" data-video-click data-an="_imgR2L" data-lozy-bgimg="<?= get_field('about_videoFon') ? : get_bloginfo("template_directory") . '/img/video.jpg' ?>">
          <div class="bAbout__videoBtn">
            <img data-src="<?php bloginfo("template_directory"); ?>/img/play.svg" alt="video-play" class="bAbout__videoBtnIc imgSize" width="14" height="16">
            <div class="bAbout__videoBtnTitle"><?php _e('Дивитися відео', 'theme-sp'); ?></div>
          </div>
          <video class="bAbout__videoB" loop muted playsinline data-video>
            <source src="<?= get_field('about_mp4') ? : get_bloginfo("template_directory") . '/others/Photographer%20in%20Mountains.mp4'; ?>" type="video/mp4">
          </video>
        </div>
      </div>

    </section>
    <section class="pAbTop">
      <div class="container">

        <div class="pAbB row">
          <?php $bnew = get_field('mission')['d'] ?>
          <div class="pAbB__col pAbB__col_1 c4 c8-md">

            <h2 class="pAbTop__title title56" data-an="_fadeUp20"><?= get_field('mission')['t']; ?></h2>
            <?php
            if ($img = get_field('mission')['img']) {
              $imgId = attachment_url_to_postid($img);
              $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
            } else $alt = get_field('h1') ? : get_the_title(); ?>
            <img data-src="<?= kama_thumb_src('w=774 &h=599 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pProgram1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="imgBorder mdHide imgSizeK" data-an="_imgR2L" width="774" height="599">
            <?php if ($bnew): ?>
              <div class="pAbTop__desc desc desc_660 mdHide" data-an="_fadeUp20"><?= $bnew ?></div>
            <?php endif; ?>
          </div>

          <div class="pAbB__col pAbB__col_2 pAbB__col_pt0 c3 c8-md">

            <div class="desc" data-an="_fadeUp20"><?= get_field('mission')['d1']; ?></div>
            <?php
            if ($img = get_field('mission')['img']) {
              $imgId = attachment_url_to_postid($img);
              $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
            } else $alt = get_field('h1') ? : get_the_title(); ?>
            <img data-src="<?= kama_thumb_src('w=774 &h=599 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pProgram1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="imgBorder mdShow imgSizeK" data-an="_imgR2L" width="774" height="599">

            <div class="pAbB__txt txt txt_320" data-an="_fadeUp20"><?= get_field('mission')['d2']; ?></div>
            <?php
            if ($img = get_field('mission')['img1']) {
              $imgId = attachment_url_to_postid($img);
              $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
            } else $alt = get_field('h1') ? : get_the_title(); ?>
            <img data-src="<?= kama_thumb_src('w=487 &h=320 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pProgram2.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__img imgSizeK" data-an="_imgL2R" width="487" height="320">

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
          <h2 class="block__title title56"><?= get_field('goals')['t']; ?></h2>
        </div>

        <div class="block row jcsb">
          <div class="block__col c3 c8-md">
            <div class="desc" data-an="_fadeUp20"><?= get_field('goals')['d']; ?></div>
            <div class="block__txt txt txt_320" data-an="_fadeUp20"><?= get_field('goals')['d1']; ?></div>
            <?php
            if ($img = get_field('goals')['img']) {
              $imgId = attachment_url_to_postid($img);
              $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
            } else $alt = get_field('h1') ? : get_the_title(); ?>
            <img data-src="<?= kama_thumb_src('w=487 &h=320 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/plan1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="block__img imgSizeK" data-an="_imgR2L" width="487" height="
320">
          </div>

          <?php $items = get_field('goals')['items'];
          if ($items) { ?>
            <div class="block__col c4 c8-md">
              <div class="acc" data-acc>
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

    <section class="bProgram">

      <div class="container">

        <div class="bTitle" data-an="_border">
          <h2 class="bProgram__title title56" data-an="_fadeUp"><?php the_field('prog_t'); ?></h2>
        </div>

        <div class="bProgram__desc desc desc_660" data-an="_fadeUp"><?php the_field('prog_d'); ?></div>

        <div class="bProgram__row" data-an="_fonR2L">

          <div class="bProgram__b">

            <?php require_once get_template_directory() . '/template/prog.php'; ?>

            <div class="bProgram__foot">
              <div class="bProgram__desc1 txt txt_490" data-an="_fadeUp"><?php the_field('prog_d1'); ?></div>

              <?php $link = get_field('prog_link');
              if ($link) {
                $url = $link['url'] ? : '#';
                $title = $link['title'] ? : __('Всі програми', 'theme-sp');
                $target = $link['target'] ? ' target="_blank"' : '';
                ?>
                <a href="<?= $url ?>" class="bAbout__btn btn-transparent" data-an="_fadeUp"<?= $target ?>><?= $title ?></a>
                <?php
              } ?>
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
          <img class="bProgram__dragIc imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/<?= $ic ?>" alt="drag-cursor" data-an="_rotateL2R" data-del="0.5" width="120" height="120">

        </div>

      </div>

    </section>

    <section class="bBlog">
      <div class="container">

        <div class="bTitle" data-an="_border">
          <h3 class="bBlog__title title56"><?php the_field('blog_t'); ?></h3>
        </div>

        <?php require_once get_template_directory() . '/template/blog.php'; ?>

      </div>
    </section>

    <?php require_once get_template_directory() . '/template/partners.php'; ?>
  <?php } ?>
<?php } ?>

<?php get_footer(); ?>