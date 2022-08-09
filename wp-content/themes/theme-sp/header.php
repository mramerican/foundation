<?php
session_start();
$tY  = gmdate("D, d M Y");
$tH  = gmdate("H");
$tH = $tH >= 23 ? 23 : ($tH >= 15 ? 15 : 7);
$tI  = get_post_modified_time('i');
if(!$tI){
  $tI  = random_int(1, 59);
  $tI = $tI < 10 ? "0". $tI : $tI;
}
$tS  = get_post_modified_time('s');
if(!$tS){
  $tS  = '00';
}
$modified_time = strtotime(date('D, d M Y ' . $tH . ':' . $tI . ':' . $tS));
if ( !is_user_logged_in() ) {
  if ( isset( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) && strtotime( $_SERVER['HTTP_IF_MODIFIED_SINCE'] ) >= $modified_time ) {
    $protocol = (isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1');
    header( $protocol . ' 304 Not Modified' );
  }
}
header("Last-Modified: " . $tY . ' ' . $tH . ':' . $tI . ':' . $tS . " GMT");
$dir = get_bloginfo("template_directory") . "/";
/**
 * @package theme-sp
 */
?>
<!doctype html>
<?php $langAttr = get_language_attributes();
$langAttr = $langAttr === 'lang="ru-RU"'? 'lang="ru"':  $langAttr
?>
<html <?= $langAttr ?> prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="google-site-verification" content="yJ2oaspRwOsX2BKruHcPpGBBafNXDeV3AsvSIx6nd3Y" />
  <?php
  if (is_paged() || get_query_var('paged') >= 2) { ?>
    <meta name="robots" content="noindex, follow"/>
  <?php }
  if (is_search()): ?>
    <link rel="canonical" href="<?= pll_home_url() ?>">
  <?php else: ?>
    <link rel="canonical" href="<?= get_pagenum_link(1) ?>">
  <?php endif; ?>
  <link type="image/x-icon" rel="shortcut icon" href="<?php bloginfo("template_directory"); ?>/img/favicon/favicon-ico-258x258.ico">
  <link type="image/png" sizes="16x16" rel="icon" href="<?php bloginfo("template_directory"); ?>/img/favicon/favicon-16x16.png">
  <link type="image/png" sizes="32x32" rel="icon" href="<?php bloginfo("template_directory"); ?>/img/favicon/favicon-32x32.png">
  <link type="image/png" sizes="48x48" rel="icon" href="<?php bloginfo("template_directory"); ?>/img/favicon/favicon-48x48.png">
  <link sizes="180x180" rel="apple-touch-icon" href="<?php bloginfo("template_directory"); ?>/img/favicon/apple-touch-icon-180x180.png">
  <link color="#CB0D58" rel="mask-icon" href="<?php bloginfo("template_directory"); ?>/img/favicon/safari-pinned-tab-16x16.svg">
  <meta name="msapplication-TileColor" content="#CB0D58">
  <meta name="msapplication-TileImage" content="<?php bloginfo("template_directory"); ?>/img/favicon/mstile-144x144.png">
  <meta name="application-name" content="Parimatch">
  <meta name="msapplication-config" content="<?php bloginfo("template_directory"); ?>/others/browserconfig.xml">
  <link rel="manifest" href="<?php bloginfo("template_directory"); ?>/others/manifest.json">
  <meta name="theme-color" content="#ffffff">
  <meta name="facebook-domain-verification" content="mmlbot6ttbu1c4g75mfjtmih7wjq3i"/>
  <?php
  $languages = pll_the_languages([
    'raw'           => 1,
    'hide_if_empty' => 0,
  ]);
  foreach ($languages as $lang) {
    $strR = strtolower($lang['locale']);
    if (is_category()) {
      $category     = get_queried_object();
      $term_id      = $category->term_id;
      $translateUrl = get_category_link(pll_get_term($term_id, $lang['slug']));
      ?>
      <link rel="alternate" hreflang="<?= $strR ?>" href="<?= $translateUrl ?>"/>
    <?php } else { ?>
      <link rel="alternate" hreflang="<?= $strR ?>" href="<?= $lang['url'] ?>"/>
    <?php }
  } ?>

  <?php wp_head(); ?>
  <!--preloader-->
  <style>
    [data-an]:not(._animated) {
      opacity: 0;
    }

    .preloader {
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      background: #e5e5e5;
      z-index: 99999;
      transition: opacity 0.5s;
    }

    .preloader._complete {
      opacity: 0;
    }

    .preloader__b {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }
  </style>
  <?php if(!strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse')): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-202607010-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'UA-202607010-1');
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-RF0BTK52E8"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'G-RF0BTK52E8');
	</script>
    <!-- Facebook Pixel Code -->
    <script>
      !function (f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function () {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments);
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s);
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '420388292685511');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
           src="https://www.facebook.com/tr?id=420388292685511&ev=PageView&noscript=1"
      />
    </noscript>
    <!-- End Facebook Pixel Code -->
  <?php endif; ?>

  <link rel="dns-prefetch" href="https://www.cloudflare.com">

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push(
      {'gtm.start': new Date().getTime(),event:'gtm.js'}
    );var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-MWLW8GN');</script>
  <!-- End Google Tag Manager -->
</head>
<body <?php body_class(); ?> style="overflow:hidden;" id="_body">
<div class="bodyWr">

  <div class="preloader">
    <div class="preloader__b"></div>
  </div>

  <header class="header" data-an="_fadeIn">

    <div class="hMain">
      <div class="hMain__fon"></div>

      <div class="container">
        <div class="hMain__wr">

          <div class="hMain__lt">
            <a href="<?= pll_home_url(); ?>" class="hMain__logo">
              <?php
              if ($img = get_field('h_logo', 'option')) {
                $imgId = attachment_url_to_postid($img);
                $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
              }
              else $alt = get_field('h1')?: get_the_title();?>
              <img data-src="<?= get_field('h_logo', 'options') ?: get_bloginfo("template_directory") . '/img/logo.svg'; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="hMain__logo-img">
            </a>

            <?php $menu = get_field('h_nav', 'options');
            if ($menu) { ?>
              <ul class="hMain__nav">
                <?php foreach ($menu as $n => $it) { ?>
                  <?php if ($it['check']): ?>
                    <li class="hMain__navLi" data-hasSub>
                      <?php
                      $url    = $it['link']['url'] ?: '#';
                      $title  = $it['link']['title'] ?: 'link';
                      $target = $it['link']['target'] ? ' target="_blank"' : '';
                      ?>
                      <a class="hMain__navLink" href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                      <?php $menu1 = $it['nav2'];
                      if ($menu1) { ?>
                        <div class="bSub" data-sub>
                          <div class="bSub__fon"></div>
                          <ul class="sub">

                            <?php foreach ($menu1 as $it1) { ?>
                              <li class="sub__li">
                                <?php
                                $url    = $it1['link']['url'] ?: '#';
                                $title  = $it1['link']['title'] ?: 'link';
                                $target = $it1['link']['target'] ? ' target="_blank"' : '';
                                ?>
                                <a class="sub__link" href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                              </li>
                            <?php } ?>
                          </ul>
                          <?php if ($t = $it['t']): ?>
                            <div class="sub__title"><?= $t ?></div>
                          <?php endif; ?>
                        </div>
                      <?php } ?>
                    </li>
                  <?php else: ?>
                    <li class="hMain__navLi">
                      <?php
                      $url    = $it['link']['url'] ?: '#';
                      $title  = $it['link']['title'] ?: 'link';
                      $target = $it['link']['target'] ? ' target="_blank"' : '';
                      ?>
                      <a class="hMain__navLink" href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                    </li>
                  <?php endif; ?>
                <?php } ?>
              </ul>
            <?php } ?>
          </div>

          <div class="hMain__rt">

            <?php if ($btn = get_field('h_btn', 'options')):
              $url = $btn['url'] ?: '#';
              $title = $btn['title'] ?: 'link';
              $target = $btn['target'] ? ' target="_blank"' : '';
              ?>
              <a href="<?= $url ?>"<?= $target ?> class="btn-red hMain__btn"><?= $title ?></a>
            <?php endif; ?>

            <div class="hMainSoc">
              <?php if ($facebook = get_field('h_facebook', 'options')): ?>
                <a href="<?= $facebook ?>" class="hMainSoc__item" target="_blank" rel="nofollow">
                  <img data-src="<?= get_field('h_facebookIc', 'options') ?: get_bloginfo("template_directory") . '/img/facebook.svg'; ?>" alt="facebook" class="hMainSoc__ic imgSize" width="24" height="24">
                </a>
              <?php endif; ?>
              <?php if ($instagram = get_field('h_instagram', 'options')): ?>
                <a href="<?= $instagram ?>" class="hMainSoc__item" target="_blank" rel="nofollow">
                  <img data-src="<?= get_field('h_instagramIc', 'options') ?: get_bloginfo("template_directory") . '/img/instagram.svg'; ?>" alt="instagram" class="hMainSoc__ic imgSize" width="24" height="24">
                </a>
              <?php endif; ?>
              <?php if ($youtube = get_field('h_youtube', 'options')): ?>
                <a href="<?= $youtube ?>" class="hMainSoc__item" target="_blank" rel="nofollow">
                  <?php if ($youtubeIc = get_field('h_youtubeIc', 'options')): ?>
                    <img data-src="<?= $youtubeIc ?>" alt="youtube" class="hMainSoc__ic">
                  <?php else: ?>
                    <img data-src="<?= get_bloginfo("template_directory") . '/img/youtube_white.svg'; ?>" alt="youtube" class="hMainSoc__ic">
                  <?php endif; ?>
                </a>
              <?php endif; ?>
            </div>

            <div class="lang">
              <?php
              $languages = pll_the_languages([
                'raw'           => 1,
                'hide_if_empty' => 0,
              ]);
              ?>
              <div class="lang__list">
                <div class="lang__list-in">
                  <?php foreach ($languages as $lang) { ?>
                    <div class="lang__list-lan<?php echo $lang['current_lang'] ? ' _active' : ''; ?>"><?= $lang['name'] ?></div>
                  <?php } ?>
                </div>
                <div class="lang__list-down">
                  <?php foreach ($languages as $lang) {
                    if (is_category()) {
                      $category     = get_queried_object();
                      $term_id      = $category->term_id;
                      $translateUrl = get_category_link(pll_get_term($term_id, $lang['slug']));
                      ?>
                      <a href="<?= $translateUrl ?>" class="lang__list-item <?= $lang['current_lang'] ? ' current' : '' ?>"><?= $lang['name'] ?></a>
                      <?php
                    }
                    else { ?>
                      <a href="<?= $lang['url'] ?>" class="lang__list-item <?= $lang['current_lang'] ? ' current' : '' ?>"><?= $lang['name'] ?></a>
                    <?php }
                  } ?>
                </div>
              </div>
            </div>

            <div class="hMain__toggle" data-toggleNav></div>

          </div>
        </div>
      </div>

    </div>

    <div class="nav">
      <div class="nav__wr">
        <div class="nav__fon1"></div>
        <div class="nav__fon2"></div>
        <div class="container">
          <div class="nav__row">
            <div class="nav__lt">

              <?php $menu = get_field('h_nav', 'options');
              if ($menu) { ?>
                <ul class="nav__ul">
                  <?php foreach ($menu as $n => $it) { ?>
                    <?php if ($it['check']): ?>
                      <li class="nav__ulLi" data-hasSub>
                        <?php
                        $url    = $it['link']['url'] ?: '#';
                        $title  = $it['link']['title'] ?: 'link';
                        $target = $it['link']['target'] ? ' target="_blank"' : '';
                        ?>
                        <div class="nav__item">
                          <a class="nav__ulLink" href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                          <div class="nav__subToggle"></div>
                        </div>
                        <?php $menu1 = $it['nav2'];
                        if ($menu1) { ?>
                          <div class="nav__bSub">
                            <ul class="nav__sub">

                              <?php foreach ($menu1 as $it1) { ?>
                                <li class="nav__subLi">
                                  <?php
                                  $url    = $it1['link']['url'] ?: '#';
                                  $title  = $it1['link']['title'] ?: 'link';
                                  $target = $it1['link']['target'] ? ' target="_blank"' : '';
                                  ?>
                                  <a class="nav__subLink" href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                            <?php if ($t = $it['t']): ?>
                              <div class="nav__subTitle"><?= $t ?></div>
                            <?php endif; ?>
                          </div>
                        <?php } ?>
                      </li>
                    <?php else: ?>
                      <li class="nav__ulLi">
                        <?php
                        $url    = $it['link']['url'] ?: '#';
                        $title  = $it['link']['title'] ?: 'link';
                        $target = $it['link']['target'] ? ' target="_blank"' : '';
                        ?>
                        <a class="nav__ulLink" href="<?= $url ?>"<?= $target ?>><?= $title ?></a>
                      </li>
                    <?php endif; ?>
                  <?php } ?>
                </ul>
              <?php } ?>
            </div>

            <div class="nav__rt">

              <div class="nav__cont">
                <div class="nav__contItem">
                  <div class="nav__contItemTitle"><?php the_field('h_socT', 'options'); ?></div>
                  <div class="navSoc">
                    <?php if ($facebook = get_field('h_facebook', 'options')): ?>
                      <a href="<?= $facebook ?>" class="navSoc__item" target="_blank" rel="nofollow">
                        <img data-src="<?= get_field('h_facebookIcDrop', 'options') ?: get_bloginfo("template_directory") . '/img/facebook-black.svg'; ?>" alt="facebook" class="navSoc__ic imgSize" width="24" height="24">
                      </a>
                    <?php endif; ?>
                    <?php if ($instagram = get_field('h_instagram', 'options')): ?>
                      <a href="<?= $instagram ?>" class="navSoc__item" target="_blank" rel="nofollow">
                        <img data-src="<?= get_field('h_instagramIcDrop', 'options') ?: get_bloginfo("template_directory") . '/img/instagram-black.svg'; ?>" alt="instagram" class="navSoc__ic imgSize" width="24" height="24">
                      </a>
                    <?php endif; ?>
                    <?php if ($youtube = get_field('h_youtube', 'options')): ?>
                      <a href="<?= $youtube ?>" class="navSoc__item" target="_blank" rel="nofollow">
                        <?php if ($youtubeIc = get_field('h_youtubeIcDrop', 'options')): ?>
                          <img data-src="<?= $youtubeIc ?>" alt="youtube" class="navSoc__ic">
                        <?php else: ?>
                          <img data-src="<?= get_bloginfo("template_directory") . '/img/youtube_black.svg'; ?>" alt="youtube" class="hMainSoc__ic">
                        <?php endif; ?>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <?php if ($btn = get_field('h_btn', 'options')):
                $url = $btn['url'] ?: '#';
                $title = $btn['title'] ?: 'link';
                $target = $btn['target'] ? ' target="_blank"' : '';
                ?>
                <a href="<?= $url ?>"<?= $target ?> class="btn-red nav__btn"><?= $title ?></a>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>

  </header>