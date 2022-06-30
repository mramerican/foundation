<?php
if (!isset($_COOKIE['cookiePopupClose'])): ?>

  <div class="pupup-cookie" data-an="_fadeIn" data-del="5">
    <div class="pupup-cookie__lt">
      <div class="pupup-cookie__title"><?php the_field('popup_cookie_t', 'options'); ?></div>
      <div class="pupup-cookie__desc"><?php the_field('popup_cookie_d', 'options'); ?></div>
    </div>
    <div class="pupup-cookie__rt">
      <a href="#" class="btn-transparent pupup-cookie__btn"><?php the_field('popup_cookie_accept', 'options'); ?></a>
      <a href="#" class="pupup-cookie__close">
        <img class="pupup-cookie__close-img" data-src="<?php bloginfo("template_directory"); ?>/img/close.svg" alt="close-ic">
      </a>
    </div>
  </div>

<?php endif;