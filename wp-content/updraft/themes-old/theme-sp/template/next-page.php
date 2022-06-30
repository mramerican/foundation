<?php $link = get_field('next_link');
if ($link) {
  $url = $link['url'] ?: '#';
  $title = $link['title'] ?: __('Наступна програма','theme-sp');
  $target = $link['target'] ? ' target="_blank"' : '';
  ?>
<section class="bNext" data-lozy-bgimg="<?= get_field('next_fon')?: get_bloginfo("template_directory") . '/img/bNext.jpg' ?>">
  <div class="container">

    <div class="bNext__row">

      <h4 class="bNext__untitle"><?php _e('Наступна програма','theme-sp'); ?></h4>
      <h3 class="bNext__title title44"><?= $title ?></h3>
      <a href="<?= $url ?>" class="bNext__link"><?php _e('Перейти до програми','theme-sp'); ?></a>
      
    </div>
    
  </div>
</section>

  <?php
} ?>