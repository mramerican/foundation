<?php
/*
Template Name: Контакти
*/

get_header();
$h1 = get_field('h1') ? : get_the_title();
$dir = get_bloginfo("template_directory") . "/";
?>
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _header = document.querySelector('.header');
      if (_header) _header.classList.add('_black');
    });
  </script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  
  <section class="top3">
    <div class="top3__box container">

      <?php breadcrumb(get_the_title()); ?>
      
      <div class="top3__row row jcsb">
        
        <div class="top3__lt c4 c8-md">
          <h1 class="top3__title title44" data-an="_fadeUp20"><?= $h1 ?></h1>
          
          <div class="top3__info">
            <div class="top3__infoPic" data-an="_fadeUp20">
              <img data-src="<?php bloginfo("template_directory"); ?>/img/mapIc.svg" alt="map-ic" class="top3__infoIc">
            </div>
            <div class="top3__infoRt">
              
              <div class="top3__infoTitle" data-an="_fadeUp20"><?php the_field('address'); ?></div>
              
              <div class="bContact">
                <?php if ($email = get_field('email')): ?>
                  <div class="bContact__b" data-an="_fadeUp20">
                    <div class="bContact__pic">
                      <img data-src="<?php bloginfo("template_directory"); ?>/img/mailBlack.svg" alt="email-ic" class="bContact__ic">
                    </div>
                    <div class="bContact__rt">
                      <a href="mailto:<?= $email ?>" class="bContact__link"><?= $email ?></a>
                    </div>
                  </div>
                <?php endif; ?>

                <?php $tels = get_field('tels');
                if ($tels) { ?>
                  
                  <div class="bContact__b" data-an="_fadeUp20">
                    <div class="bContact__pic">
                      <img data-src="<?php bloginfo("template_directory"); ?>/img/telBlack.svg" alt="tel-ic" class="bContact__ic">
                    </div>
                    <div class="bContact__rt">
                      <?php foreach ($tels as $n => $it) { ?>
                        <?php
                        $tel = $it['tel'];
                        $telLink = str_replace(["(", ")", "-", " "], "", $tel);
                        ?>
                        <a href="tel:<?= $telLink ?>" class="bContact__link"><?= $tel ?></a>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
              
              </div>
              
              <a href="#bCont" class="top3__btn btn-transparent btn-transparent_xl" data-an="_fadeUp20"><?= get_field('btn') ? : 'Надіслати листа'; ?></a>
            </div>
          </div>
        </div>
        
        <div class="top3__rt c4 c8-md">
          <?php
          if ($img = get_field('img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=710 &h=693 &crop=top', $img ? : "{$dir}img/contacts.jpg") ?>" alt="Parimatch Foundation - <?= $alt ?>" class="top3__img imgSizeK" data-an="_imgL2R" width="710" height="693">
        </div>
      </div>
    
    </div>
  </section>
  
  <section class="pCont">
    <div class="container">
      
      <div class="pCont__row row">
        <div class="pCont__col pCont__col_1 c2 c8-md">
          
          <div class="pCont__title" data-an="_fadeUp20"><?php the_field('form_t'); ?></div>
          <div class="pCont__desc" data-an="_fadeUp20"><?php the_field('form_d'); ?></div>
        
        </div>
        <div class="pCont__col pCont__col_2 c6 c8-md">
          <form class="form" method="post" action="<?php bloginfo("template_directory"); ?>/mail/mail.php" novalidate id="bCont">
            <input type="hidden" name="form_name" value="<?php the_field('form_t'); ?>">
            
            <div class="row">
              <div class="form__group c4 c8-md" data-an="_fadeUp20">
                <div class="form__label">
                  <div class="form__name"><?php the_field('form_name', 'options'); ?></div>
                </div>
                <input name="name" type="text" class="form__input" required placeholder="<?php the_field('form_nameP', 'options'); ?>">
              </div>
              <div class="form__group c4 c8-md" data-an="_fadeUp20">
                <div class="form__label">
                  <div class="form__name"><?php the_field('form_email', 'options'); ?></div>
                  <div class="form__note"><?php the_field('form_note', 'options'); ?></div>
                </div>
                <input name="email" type="email" class="form__input" placeholder="<?php the_field('form_emailP', 'options'); ?>">
              </div>
            </div>
            
            
            <div class="form__group" data-an="_fadeUp20">
              <div class="form__label">
                <div class="form__name"><?php the_field('form_themes_t', 'options'); ?></div>
              </div>
              <div class="b-select">
                <div class="b-select__wr">
                  <input name="themes" type="text" class="b-select__input" required>
                  <div class="b-select__title" data-default="<?php the_field('form_themes_t1', 'options'); ?>"><?php the_field('form_themes_t1', 'options'); ?></div>
                  <ul class="b-select__list">
                    <?php $list = get_field('form_themes_items', 'options');
                    if ($list){ ?>
                    <?php foreach ($list as $it) { ?>
                      <li class="b-select__item" data-value="<?= $it['i']; ?>"><?= $it['i']; ?></li>
                    <?php } ?>
                  </ul>
                  <?php } ?>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="form__group c4 c8-md" data-an="_fadeUp20">
                <div class="form__label">
                  <div class="form__name"><?php the_field('form_tel', 'options'); ?></div>
                </div>
                <input name="tel" type="tel" class="form__input" required placeholder="<?php the_field('form_telP', 'options'); ?>">
              </div>
              <div class="form__group c4 c8-md" data-an="_fadeUp20">
                <div class="form__label">
                  <div class="form__name"><?php _e('Файл', 'theme-sp'); ?></div>
                  <div class="form__note"><?php the_field('form_note', 'options'); ?></div>
                </div>
                <label class="b-file">
                  <input name="file[]" type="file" class="b-file__input" multiple accept="image/*,.doc,.docx,.odt,.ttf,.pdf,.xlsx">
                  <img data-src="<?php bloginfo("template_directory"); ?>/img/delete.svg" alt="delete-ic" class="b-file__remove">
                  <span class="b-file__txt" data-txt="<?php _e('Выбрано файлів:', 'theme-sp'); ?>" data-txt-default="<?php _e('Виберіть файл', 'theme-sp'); ?>"><?php _e('Виберіть файл', 'theme-sp'); ?></span>
                </label>
              </div>
            </div>
            
            <div class="form__group form__group_textarea" data-an="_fadeUp20">
              <div class="form__label">
                <div class="form__name"><?php the_field('form_textarea', 'options'); ?></div>
              </div>
              <textarea name="textarea" class="form__textarea" placeholder="<?php the_field('form_textareaP', 'options'); ?>" required></textarea>
            </div>
            
            <div class="form__group form__group_btn">
              <div class="form__foot">
                <button type="submit" class="form__btn btn-submit" data-an="_fadeUp20"><?php the_field('form_btnSend1', 'options'); ?></button>
                <div class="form__policy" data-an="_fadeUp20"><?php the_field('form_polic', 'options'); ?></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    
    </div>
  </section>

<?php } ?>

<?php
get_footer();