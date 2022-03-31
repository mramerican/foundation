<?php
/*
Template Name: Про нас
*/

get_header();
$h1 = get_field('h1') ? : get_the_title();
?>
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let _header = document.querySelector('.header');
      if (_header) _header.classList.add('_black');
    });
  </script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>
  
  <section class="pAbTop">
    <div class="container">

      <?php breadcrumb(get_the_title()); ?>
      
      <div class="pAbB row">
        <div class="pAbB__col pAbB__col_1 c4 c8-md">
          
          
          <h1 class="pAbTop__title title64" data-an="_fadeUp20"><?= $h1 ?></h1>
          <?php
          if ($img = get_field('top_img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=656 &h=458 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pAbTop1.jpg') ?>" width="656" height="458" class="imgBorder mdHide" data-an="_imgR2L" alt="Parimatch Foundation - <?= $alt ?>">
          
          <div class="pAbTop__desc desc desc_660 mdHide" data-an="_fadeUp20"><?php the_field('top_d'); ?></div>
        </div>
        
        <div class="pAbB__col pAbB__col_2 c3 lg4 c8-md">
          
          <div class="desc" data-an="_fadeUp20"><?php the_field('top_d1'); ?></div>
          <?php
          if ($img = get_field('top_img')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=656 &h=458 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pAbTop1.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="imgBorder mdShow" data-an="_imgR2L" width="656" height="458">
          
          <div class="pAbB__txt txt txt_320" data-an="_fadeUp20"><?php the_field('top_d3'); ?></div>

          <?php
          if ($img = get_field('top_img1')) {
            $imgId = attachment_url_to_postid($img);
            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
          } else $alt = get_field('h1') ? : get_the_title(); ?>
          <img data-src="<?= kama_thumb_src('w=487 &h=338 &crop=top', $img ? : get_bloginfo("template_directory") . '/img/pAbTop2.jpg') ?>" alt="Parimatch Foundation - <?= $alt ?>" class="pAbB__img" data-an="_imgL2R" width="487" height="338">
          
          <div class="pAbTop__desc desc desc_660 mdShow" data-an="_fadeUp20"><?php the_field('top_d'); ?></div>
        
        </div>
      </div>
      
      <div class="pAbB1 row">
        <svg class="pAbB1__logo jsSvgPathLength" data-an="_svgPath" width="1220" height="863" viewBox="0 0 1220 863" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M950.538 29.0544L871.355 306.322C1030.5 305.931 1170.23 200.241 1213.97 47.0704L1219.12 29.0544H950.538Z" stroke="#FCF3F7" stroke-width="1.33333"/>
          <path d="M975.631 462.096L1001.46 371.476H849.985L782.372 608.703C872.187 608.313 950.986 548.582 975.631 462.096L976.272 462.279L975.631 462.096Z" stroke="#FCF3F7" stroke-width="1.33333"/>
          <path d="M704.121 655.131L882.902 29.034C756.426 29.423 645.303 113.248 610.176 234.898L429.121 861.814H430.273C557.435 861.814 669.187 777.473 704.121 655.131Z" stroke="#FCF3F7" stroke-width="1.33333"/>
          <path
            d="M180.843 325.304L181.509 325.333L180.843 325.304C182.898 278.867 203.745 237.005 239.599 207.462C285.575 169.526 351.719 172.979 393.547 215.445L393.072 215.913L393.547 215.445L505.3 328.99C508.408 332.148 511.827 334.775 515.314 337.366L552.117 209.913L552.758 210.098L552.117 209.913C558.569 187.582 568.312 167.071 579.481 147.585L521.835 89.0255C414.105 -20.4015 243.566 -29.2557 125.116 68.4196C50.4895 129.974 5.23351 220.732 0.993119 317.396C-3.23985 414.06 33.8547 508.422 102.815 576.255L102.347 576.73L102.815 576.255L254.643 725.67L254.176 726.145L254.643 725.67C269.967 740.754 289.872 759.341 311.427 779.468L312.482 780.454L312.027 780.941L312.482 780.454C331.211 797.944 351.687 817.161 371.294 836.038L427.49 641.45C409.985 625.088 393.611 609.766 380.885 597.248L381.353 596.772L380.885 597.248L229.049 447.84C195.937 415.255 178.804 371.719 180.843 325.304Z"
            stroke="#FCF3F7" stroke-width="1.33333"/>
        </svg>
        
        <div class="pAbB1__col pAbB1__col_1 c3 c8-md">
          
          <div class="bAbout__foto">
            <div class="bFoto">
              <div class="bFoto__pic" data-an="_imgL2R">
                <?php
                if ($img = get_field('about_foto')) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>
                <img data-src="<?= kama_thumb_src('w=487 &h=640 &crop=top', $img) ?>" alt="Parimatch Foundation - <?= $alt ?>" class="bFoto__img imgSizeK" width="487" height="640">
              </div>
              <div class="bFoto__title" data-an="_fadeUp20"><?php the_field('about_name'); ?></div>
              <div class="bFoto__desc" data-an="_fadeUp20" data-del="0.1"><?php the_field('about_position'); ?></div>
            </div>
          </div>
          
          <div class="pAbB1__quote quote mdShow" data-an="_fadeUp20"></div>
        
        </div>
        
        <div class="pAbB1__col pAbB1__col_2 c4 c8-md">
          <div class="pAbB1__quote quote mdHide" data-an="_fadeUp20"></div>
          
          <div class="bAbout__desc desc desc_490" data-an="_fadeUp20"><?php the_field('about_q'); ?></div>
          
          <div class="txt txt_320" data-an="_fadeUp20"><?php the_field('about_d'); ?></div>
        </div>
      
      </div>
    
    </div>
  </section>
  
  <section class="pAbValues">
    <div class="container">
      
      
      <div class="bTitle bTitle_mt0" data-an="_border _fadeUp20">
        <h3 class="pAbValues__title title56"><?php the_field('values_t'); ?></h3>
      </div>
      
      <div class="pAbValues__desc desc desc_600" data-an="_fadeUp20"><?php the_field('values_d'); ?></div>

      <?php $items = get_field('values_items');
      if ($items) { ?>
        <div class="values">
          <?php foreach ($items as $it) { ?>
            
            <div class="values__item" data-an="_fadeUp20">
              <div class="values__pic">
                <?php
                if ($img = $it['ic']) {
                  $imgId = attachment_url_to_postid($img);
                  $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($img, PATHINFO_FILENAME);
                } else $alt = get_field('h1') ? : get_the_title(); ?>
                <img class="values__img imgSize" data-src="<?= $it['ic'] ? : get_bloginfo("template_directory") . '/img/values1.png'; ?>" alt="Parimatch Foundation - <?= $alt ?>" width="32" height="32">
              </div>
              <div class="values__desc"><?= $it['d']; ?></div>
            </div>

          <?php } ?>
        </div>
      <?php } ?>
    
    </div>
  </section>

  <?php require_once get_template_directory() . '/template/numbers.php'; ?>
  
  <section class="pAbSpec">
    <div class="container">
      
      
      <div class="bTitle" data-an="_border _fadeUp20">
        <h3 class="pAbValues__title title56"><?php the_field('spec_t'); ?></h3>
      </div>

      <?php $items = get_field('spec_items');
      if ($items) { ?>
        
        
        <div class="specTab" data-tabNav="specTab" data-tabContent="specTab"<?php if (count($items) === 1): ?> style="margin-bottom: 0;"<?php endif ?>>
          <?php foreach ($items as $n => $it) { ?>
            <?php if (count($items) !== 1): ?>
              <a href="#" class="specTab__item<?php if ($n < 1) echo ' _active'; ?>" data-tabLink="tab<?= $n ?>" data-an="_fadeUp20"><?= $it['t']; ?>
                <img data-src="<?php bloginfo("template_directory"); ?>/img/tabSmArrBlack.svg" alt="arrow-black" class="specTab__itemIc">
              </a>
            <?php endif; ?>
            
            <div class="specTab__sm<?php if ($n < 1) echo ' _active'; ?>" data-tabIt="tab<?= $n ?>">

              <?php $spec = $it['spec'];
              if ($spec) { ?>
                <div class="specCont__items">
                  <?php foreach ($spec as $n1 => $it1) { ?>
                    
                    <div class="specCont__item" data-an="_imgR2L">
                      <div class="spec">
                        <div class="spec__pic">
                          <?php
                          if ($it1['foto']) {
                            $imgId = attachment_url_to_postid($it1['foto']);
                            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($it1['foto'], PATHINFO_FILENAME);
                          } else $alt = get_field('h1') ? : get_the_title(); ?>
                          <img data-src="<?= kama_thumb_src('w=406 &h=536 &crop=top', $it1['foto']) ?>" alt="Parimatch Foundation - <?= $alt ?>" class="spec__img imgSizeK" width="406" height="536">
                          <div class="spec__hover">
                            <div class="spec__hoverTop">
                              <div class="spec__hoverTitle"><?= $it1['name']; ?></div>
                              <div class="spec__hoverSub"><?= $it1['position']; ?></div>
                            </div>
                            <div class="spec__hoverDesc"><?= $it1['d']; ?></div>
                            <a href="#" class="spec__hoverBtn" data-modal="popupSpec<?= $n . $n1 ?>"><?php _e('Подробнее', 'theme-sp'); ?></a>
                          </div>
                        </div>
                        <div class="spec__title"><?= $it1['name']; ?></div>
                        <div class="spec__sub"><?= $it1['position']; ?></div>
                      </div>
                    
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            
            </div>
          <?php } ?>
        </div>
        
        
        <div class="specCont smHide" data-tabContent="specTab">

          <?php foreach ($items as $n => $it) { ?>
            
            <div class="specCont__b<?php if ($n < 1) echo ' _active'; ?>" data-tabIt="tab<?= $n ?>">

              <?php $spec = $it['spec'];
              if ($spec) { ?>
                <div class="specCont__items">
                  <?php foreach ($spec as $n1 => $it1) { ?>
                    
                    <div class="specCont__item" data-an="_imgR2L">
                      <div class="spec">
                        <div class="spec__pic">
                          <?php
                          if ($it1['foto']) {
                            $imgId = attachment_url_to_postid($it1['foto']);
                            $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($it1['foto'], PATHINFO_FILENAME);
                          } else $alt = get_field('h1') ? : get_the_title(); ?>
                          <img data-src="<?= kama_thumb_src('w=406 &h=536 &crop=top', $it1['foto']) ?>" alt="Parimatch Foundation - <?= $alt ?>" class="spec__img imgSizeK" width="406" height="536">
                          <div class="spec__hover">
                            <div class="spec__hoverTop">
                              <div class="spec__hoverTitle"><?= $it1['name']; ?></div>
                              <div class="spec__hoverSub"><?= $it1['position']; ?></div>
                            </div>
                            <div class="spec__hoverDesc"><?= $it1['d']; ?></div>
                            <a href="#" class="spec__hoverBtn" data-modal="popupSpec<?= $n . $n1 ?>"><?php _e('Подробнее', 'theme-sp'); ?></a>
                          </div>
                        </div>
                        <div class="spec__title"><?= $it1['name']; ?></div>
                        <div class="spec__sub"><?= $it1['position']; ?></div>
                      </div>
                      
                      <!--popup-->
                      <div class="popupSpec" data-popup="popupSpec<?= $n . $n1 ?>">
                        <div class="popupSpec__row">
                          <div class="popupSpec__lt">
                            <?php
                            if ($it1['foto']) {
                              $imgId = attachment_url_to_postid($it1['foto']);
                              $alt = get_post_meta($imgId, '_wp_attachment_image_alt', true) ? : pathinfo($it1['foto'], PATHINFO_FILENAME);
                            } else $alt = get_field('h1') ? : get_the_title(); ?>
                            <img data-src="<?= $it1['foto']; ?>" alt="Parimatch Foundation - <?= $alt ?>" class="popupSpec__img">
                          </div>
                          <div class="popupSpec__rt">
                            <div class="popupSpec__top">
                              <h4 class="popupSpec__title"><?= $it1['name']; ?></h4>
                              <h4 class="popupSpec__sub"><?= $it1['position']; ?></h4>
                            </div>
                            <div class="popupSpec__desc"><?= $it1['d1']; ?></div>
                          </div>
                        </div>
                      </div>
                    
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            
            </div>
          <?php } ?>
        
        </div>

      <?php } ?>
    
    
    </div>
  </section>

  <?php require_once get_template_directory() . '/template/partners.php'; ?>

<?php } ?>

<?php
get_footer();