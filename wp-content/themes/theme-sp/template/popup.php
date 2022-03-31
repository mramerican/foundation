<!--popup register-->
<div class="popup popupFeedback" data-popup="popupRegister">
  <div class="popup__content">
    <form id="registerForm" class="form" method="post" action="<?php bloginfo("template_directory"); ?>/mail/mail.php" novalidate>
      <input type="hidden" name="form_name" value="<?php the_field('form_tRegister', 'options'); ?>">
      <div class="form__head">
        <div class="form__title title32"><?php the_field('form_tRegister', 'options'); ?></div>
      </div>
      <div class="form__group">
        <div class="form__label">
          <div class="form__name"><?php the_field('form_name', 'options'); ?></div>
        </div>
        <input name="name" type="text" class="form__input" required placeholder="<?php the_field('form_nameP', 'options'); ?>">
      </div>
      <div class="form__group">
        <div class="form__label">
          <div class="form__name"><?php the_field('form_tel', 'options'); ?></div>
        </div>
        <input name="tel" type="tel" class="form__input" required placeholder="<?php the_field('form_tel', 'options'); ?>">
      </div>
      <div class="form__group">
        <div class="form__label">
          <div class="form__name"><?php the_field('form_email', 'options'); ?></div>
          <div class="form__note"><?php the_field('form_note', 'options'); ?></div>
        </div>
        <input name="email" type="email" class="form__input" placeholder="<?php the_field('form_emailP', 'options'); ?>">
      </div>
      <div class="form__group form__group_btn">
        <div class="form__foot">
          <button type="submit" class="form__btn btn-submit"><?php the_field('form_btnRegister', 'options'); ?></button>
          <div class="form__policy"><?php the_field('form_polic', 'options'); ?></div>
        </div>
      </div>
    </form>
  </div>
</div>

<!--popup share-->
<div class="popup popupFeedback" data-popup="popupShare">
  <div class="popup__content">

    <div class="form__head">
      <div class="form__title title32"><?php the_field('form_tShareEvent', 'options'); ?></div>
    </div>

    <div class="form__share">
      <div class="share">
        <a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?php the_permalink(); ?>&p[title]=<?php the_title() ?>" class="share__link" target="_blank" rel="nofollow">
          <img data-src="<?php bloginfo("template_directory"); ?>/img/fa.svg" alt="facebook-ic" class="share__ic imgSize" width="13" height="22">
        </a>
      </div>
    </div>

  </div>
</div>

<!--popup subscribe alert-->
<div class="alert" data-popup="popupAlertSubscribe">
  <div class="alert__content">
    <h4 class="alert__title title32"><?php the_field('popup_thank_titleSub', 'options'); ?></h4>
    <div class="alert__soc">
      <div class="alert__socTitle"><?php the_field('popup_socT', 'options'); ?></div>
      <div class="alert__b">
        <div class="share">
          <a href="<?= get_field('popup_facebook', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
            <img data-src="<?= get_field('popup_facebookIc', 'options')?: get_bloginfo("template_directory") . '/img/fa.svg'; ?>" alt="facebook-ic" class="share__ic imgSize" width="13" height="22">
          </a>
          <a href="<?= get_field('popup_instagram', 'options')?>" class="share__link" target="_blank" rel="nofollow">
            <img data-src="<?= get_field('popup_instagramIc', 'options')?: get_bloginfo("template_directory") . '/img/instagram-black.svg'; ?>" alt="instagram" class="share__ic imgSize" width="24" height="24">
          </a>
          <a href="<?= get_field('popup_youtube', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
            <img data-src="<?= get_field('popup_youtubeIc', 'options')?: get_bloginfo("template_directory") . '/img/youtube_black.svg'; ?>" alt="youtube" class="share__ic">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!--popup alert-->
<div class="alert" data-popup="popupAlert">
  <div class="alert__content">
    <h4 class="alert__title title32"><?php the_field('popup_thank_title', 'options'); ?></h4>
    <div class="alert__soc">
      <div class="alert__socTitle"><?php the_field('popup_socT', 'options'); ?></div>
      <div class="alert__b">
        <div class="share">
          <a href="<?= get_field('popup_facebook', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
            <img data-src="<?= get_field('popup_facebookIc', 'options')?: get_bloginfo("template_directory") . '/img/fa.svg'; ?>" alt="facebook-ic" class="share__ic imgSize" width="13" height="22">
          </a>
          <a href="<?= get_field('popup_instagram', 'options')?>" class="share__link" target="_blank" rel="nofollow">
            <img data-src="<?= get_field('popup_instagramIc', 'options')?: get_bloginfo("template_directory") . '/img/instagram-black.svg'; ?>" alt="instagram" class="share__ic imgSize" width="24" height="24">
          </a>
          <a href="<?= get_field('popup_youtube', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
            <img data-src="<?= get_field('popup_youtubeIc', 'options')?: get_bloginfo("template_directory") . '/img/youtube_black.svg'; ?>" alt="youtube" class="share__ic">
          </a>
        </div>
      </div>
    </div>
  </div>
</div>