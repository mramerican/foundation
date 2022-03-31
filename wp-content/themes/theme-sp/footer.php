<?php $dir = get_bloginfo("template_directory") . "/"; ?>

<?php require_once get_template_directory() . '/template/popup.php'; ?>

<footer class="footer">

  <div class="container smmHide">
    <div class="footer__smHead">
      <a href="<?= pll_home_url(); ?>" class="footer__logo">
        <?php
        if ($img = get_field('f_logo', 'option')) {
          $imgId = attachment_url_to_postid($img);
          $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
        }
        else $alt = get_field('h1')?: get_the_title();?>
        <img data-src="<?= get_field('f_logo', 'options') ?: get_bloginfo("template_directory") . '/img/logo.svg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="footer__logoImg imgSize" width="166" height="48">
      </a>
      <div class="footer__desc"><?php the_field('f_d', 'options'); ?></div>
    </div>
  </div>

  <div class="footer__top">
    <div class="footer__topBox container" data-an="_fadeIn">
      <div class="subscribe">
        <div class="subscribe__lt">
          <div class="subscribe__title"><?php the_field('f_form_t', 'options'); ?></div>
        </div>
        <div class="subscribe__rt">
          <form class="subscribe__form form" method="post" action="<?php bloginfo("template_directory"); ?>/mail/mail.php" novalidate data-form-share>
            <input type="hidden" name="form_name" value="<?php the_field('f_form_t', 'options'); ?>">
            <input name="email" type="email" class="subscribe__input" placeholder="<?php the_field('form_emailP', 'options'); ?>" required>
            <button type="submit" class="subscribe__btn"><?php the_field('form_btnSend', 'options'); ?></button>
          </form>
        </div>
      </div>

      <div class="footer__topBorder" data-an="_border"></div>

    </div>
  </div>

  <div class="footer__cont">

    <div class="container" data-an="_fadeIn">

      <div class="footer__main">
        <div class="footer__b1">
          <a href="<?= pll_home_url(); ?>" class="footer__logo">
            <?php
            if ($img = get_field('f_logo', 'option')) {
              $imgId = attachment_url_to_postid($img);
              $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
            }
            else $alt = get_field('h1')?: get_the_title();?>
            <img data-src="<?= get_field('f_logo', 'options') ?: get_bloginfo("template_directory") . '/img/logo.svg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="footer__logoImg imgSize" width="166" height="48">
          </a>
          <div class="footer__desc"><?php the_field('f_d', 'options'); ?></div>
        </div>

        <div class="footer__b2">
          <?php $menu = get_field('f_nav', 'options');
          if ($menu) { ?>
            <div class="footer__item">
              <h4 class="footer__item-title"><?php the_field('f_navT', 'options'); ?></h4>
              <ul class="footer__ul">
                <?php foreach ($menu as $it) { ?>
                  <li>
                    <?php
                    $url    = $it['link']['url'] ?: '#';
                    $title  = $it['link']['title'] ?: 'link';
                    $target = $it['link']['target'] ? ' target="_blank"' : '';
                    ?>
                    <a href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          <?php } ?>

          <div class="footer__item footer__item-cont">
            <h4 class="footer__item-title"><?php the_field('f_cT', 'options'); ?></h4>
            <?php if ($email = get_field('f_email', 'options')): ?>
              <p>
                <a href="mailto:<?= $email ?>"><?= $email ?></a>
              </p>
            <?php endif; ?>
            <?php $tels = get_field('f_tels', 'options');
            if ($tels) { ?>
              <?php foreach ($tels as $n => $it) { ?>
                <?php
                $tel     = $it['tel'];
                $telLink = str_replace(array (
                  "(",
                  ")",
                  "-",
                  " "
                ), "", $tel);
                ?>
                <p>
                  <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                </p>
              <?php } ?>
            <?php } ?>
          </div>

          <div class="footer__item footer__item-cont">
            <h4 class="footer__item-title"><?php the_field('f_addressT', 'options'); ?></h4>
            <div class="footer__address"><?php the_field('f_address', 'options'); ?></div>
          </div>

          <div class="footer__item footer__item-cont">
            <h4 class="footer__item-title"><?php the_field('f_socT', 'options'); ?></h4>

            <div class="social">
              <a href="<?= get_field('f_instagram', 'options') ?: '#' ?>" class="social__item" target="_blank" rel="nofollow">
                <img class="social__ic imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/instagram.svg" alt="instagram" width="24" height="24">
              </a>
              <a href="<?= get_field('f_facebook', 'options') ?: '#' ?>" class="social__item" target="_blank" rel="nofollow">
                <img class="social__ic imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/facebook.svg" alt="facebook" width="24" height="24">
              </a>
            </div>

          </div>


          <a href="#_body" class="footer__btnUp">
            <img class="footer__btnUp-ic imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/btnUp.svg" alt="btn-up" width="56" height="56">
          </a>

        </div>

      </div>

      <div class="footer__mainSm">

        <div class="footer__b2">
          <?php $menu = get_field('f_nav', 'options');
          if ($menu) { ?>
            <div class="footer__item">
              <h4 class="footer__item-title"><?php the_field('f_navT', 'options'); ?></h4>
              <ul class="footer__ul">
                <?php foreach ($menu as $it) { ?>
                  <li>
                    <?php
                    $url    = $it['link']['url'] ?: '#';
                    $title  = $it['link']['title'] ?: 'link';
                    $target = $it['link']['target'] ? ' target="_blank"' : '';
                    ?>
                    <a href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          <?php } ?>

          <div class="footer__item footer__item-cont">
            <h4 class="footer__item-title"><?php the_field('f_addressT', 'options'); ?></h4>
            <div class="footer__address"><?php the_field('f_address', 'options'); ?></div>

            <div class="footer__itemBrother">
              <h4 class="footer__item-title"><?php the_field('f_cT', 'options'); ?></h4>
              <?php if ($email = get_field('f_email', 'options')): ?>
                <p>
                  <a href="mailto:<?= $email ?>"><?= $email ?></a>
                </p>
              <?php endif; ?>
              <?php $tels = get_field('f_tels', 'options');
              if ($tels) { ?>
                <?php foreach ($tels as $n => $it) { ?>
                  <?php
                  $tel     = $it['tel'];
                  $telLink = str_replace(array (
                    "(",
                    ")",
                    "-",
                    " "
                  ), "", $tel);
                  ?>
                  <p>
                    <a href="tel:<?= $telLink ?>"><?= $tel ?></a>
                  </p>
                <?php } ?>
              <?php } ?>
            </div>
          </div>

          <div class="footer__item footer__item-cont footer__itemSoc">
            <div class="footer__itemSocLt">
              <h4 class="footer__item-title"><?php the_field('f_socT', 'options'); ?></h4>
              <div class="social">
                <a href="<?= get_field('f_instagram', 'options') ?: '#' ?>" class="social__item" target="_blank" rel="nofollow">
                  <img class="social__ic imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/instagram.svg" alt="instagram" width="24" height="24">
                </a>
                <a href="<?= get_field('f_facebook', 'options') ?: '#' ?>" class="social__item" target="_blank" rel="nofollow">
                  <img class="social__ic imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/facebook.svg" alt="facebook" width="24" height="24">
                </a>
              </div>
            </div>

            <div class="footer__itemSocRt">
              <a href="#_body" class="footer__btnUp">
                <img class="footer__btnUp-ic imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/btnUp.svg" alt="btn-up"  width="56" height="56">
              </a>
            </div>

          </div>

        </div>

      </div>


      <div class="footer__bottom">
        <p class="footer__copy"><?php the_field('f_copy', 'options'); ?></p>
		<a href="https://in-create.com/" class="footer__made" target="_blank" rel="nofollow">
          <img data-src="<?php bloginfo("template_directory"); ?>/img/made.svg" class="footer__made-img imgSize" alt="made" width="103" height="10">
        </a>
      </div>
    </div>

  </div>
</footer>

<?php require_once get_template_directory() . '/template/cookie.php'; ?>

<!--directory url for ajax-->
<input type="hidden" class="dir_url" value="<?php bloginfo("template_directory"); ?>/">

<!--cursor-->
<div class="cursor">
  <div class="cursor__slider">
    <img data-src="<?php bloginfo("template_directory"); ?>/img/draqLogo.svg" alt="cursor-drag" class="cursor__logo">
  </div>
</div>

<script>
  /*form message*/
  var messageRequire = "<?php _e('Обов\'язкове поле', 'theme-sp'); ?>",
    messageFormat = "<?php _e('Не коректний формат', 'theme-sp'); ?>";
</script>

<?php wp_footer(); ?>

<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Parimatch Foundation",
    "url": "<?php echo get_site_url(null, '/') ?>",
    "sameAs": [
      "https://www.youtube.com/channel/...",
      "https://www.facebook.com/.../",
      "https://t.me/...",
      "https://www.instagram.com/.../"
    ]
  }
</script>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "url": "<?php echo get_site_url(null, '/') ?>",
    "logo": "<?php bloginfo("template_directory"); ?>/img/logo.svg"
  }
</script>
</div><!--bodyWr-->
</body>
</html>