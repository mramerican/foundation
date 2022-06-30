<?php

get_header();
?>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _body = document.querySelector('.body');
      if (_body) _body.classList.add('_page404');
      let _footer = document.querySelector('.footer');
      if (_footer) _footer.classList.add('_footer404');
    });
  </script>

  <section class="b404">
    <div class="container">

      <div class="b404__row row">
        <div class="c5 c4-lg c8-sm b404__lt">
          <h2 class="b404__title title88" data-an="_fadeIn"><?php the_title(); ?></h2>
        </div>
        <div class="c3 c4-lg c8-sm b404__rt">
          <div class="b404__desc" data-an="_fadeIn"><?php the_content(); ?></div>
          <a href="<?= pll_home_url(); ?>" class="b404__btn btn-circle" data-an="_fadeBtnCircle"><?php _e('На головну', 'theme-sp'); ?></a>
        </div>
      </div>

    </div>

    <div class="b404__foot" data-an="_fadeIn">
      <div class="container">
        <div class="b404__footWr">
          <div class="subscribe">
            <div class="subscribe__lt">
              <div class="subscribe__title"><?php the_field('f_form_t', 'options'); ?></div>
            </div>
            <div class="subscribe__rt">
              <form class="subscribe__form subscribe__form_white form" method="post" action="<?php bloginfo("template_directory"); ?>/mail/mail.php" novalidate data-form-share>
                <input type="hidden" name="form_name" value="<?php the_field('f_form_t', 'options'); ?>">
                <input name="email" type="email" class="subscribe__input subscribe__input_white" placeholder="Ваш email" required>
                <button type="submit" class="subscribe__btn"><?php the_field('form_btnSend', 'options'); ?></button>
              </form>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

<?php
get_footer();
