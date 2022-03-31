<?php
/*
 * категория
 */

// data for category
$category    = get_queried_object();
$taxonomy    = $category->taxonomy;
$term_id     = $category->term_id;
$titleParent = get_cat_name($category->category_parent);
$term        = ($taxonomy . '_' . $term_id);
$term_name   = $category->cat_name;
$h1          = get_field('h1', $term) ?: $term_name;

?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let _breadcrumb = document.querySelector('.breadcrumb');
    if (_breadcrumb) _breadcrumb.classList.add('_white');
  });
</script>

<section class="top" data-lozy-bgimg="<?= get_field('fon', $term) ?: get_bloginfo("template_directory") . '/img/pProgramsTop.jpg' ?>" data-an="_fadeIn">
  <div class="container">

    <?php breadcrumb($term_name); ?>

    <h1 class="top__title title88" data-an="_fadeUp20"><?= $h1 ?></h1>

  </div>
  <div class="container">
    <a href="#nextB" class="down" data-an="_zoom">
      <img class="down__img imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/down.svg" alt="down-ic" width="33" height="33">
    </a>
  </div>
</section>

<section class="pProg" id="nextB">

  <div class="container">

    <div class="bTitle" data-an="_fadeUp20">
      <h3 class="pProg__title title56"><?php the_field('prog_t', $term); ?></h3>
    </div>


    <div class="pProg__desc desc desc_660" data-an="_fadeUp20"><?php the_field('prog_d', $term); ?></div>

    <?php $items = get_field('prog_items', $term);
    if ($items) { ?>
      <div class="pProg__row">
        <?php foreach ($items as $it) { ?>
          <?php
          $post = $it;
          setup_postdata($post);
          $tumb = get_field('prev_img1') ?: get_bloginfo("template_directory") . "/img/program1.jpg";
          $t    = get_field('prev_t') ?: get_the_title();
          $d    = get_field('prev_d');
          ?>
          <div class="program">
            <div class="program__lt">
              <div class="program__title title64" data-an="_fadeUp20"><?= $t ?></div>
              <div class="program__txt txt txt_320" data-an="_fadeUp20">
                <p><?= $d ?></p>
              </div>
              <a href="<?php the_permalink(); ?>" class="program__btn btn-transparent" data-an="_fadeUp20"><?php _e('Детальніше', 'theme-sp'); ?></a>
            </div>
            <div class="program__rt" data-lozy-bgimg="<?= $tumb ?>" data-an="_imgL2R"></div>
          </div>
        <?php }
        wp_reset_postdata(); ?>
      </div>
    <?php } ?>

  </div>


</section>

<?php if (get_field('other_check', $term)): ?>
  <section class="bProgram">

    <div class="container">

      <div class="bTitle" data-an="_fadeUp20">
        <h3 class="bProgram__title title56"><?php the_field('other_t', $term); ?></h3>
      </div>

      <div class="bProgram__desc desc desc_660" data-an="_fadeUp20"><?php the_field('other_d', $term); ?></div>

      <div class="bProgram__row">

        <div class="bProgram__b">

          <?php require_once get_template_directory() . '/template/prog.php'; ?>

        </div>

        <?php
        $lang = pll_current_language();
        if ($lang == 'en')
          $ic = "sliderDragIcEng.svg";
        else if ($lang == 'ru')
          $ic = "sliderDragIcRu.svg";
        else $ic = "sliderDragIcUk.svg";
        ?>
        <img class="bProgram__dragIc imgSize" data-src="<?php bloginfo("template_directory"); ?>/img/<?= $ic ?>" alt="drag-ic" data-an="_rotateL2R" data-del="0.5" width="120" height="120">

      </div>

    </div>
  </section>
<?php endif; ?>

<?php if($seo = get_field('seo', $term)): ?>
<section class="seo">
  <div class="container">
    <div class="seo__row">
      <div class="seo__b">
        <div class="seo__desc desc" data-seo><?= $seo ?></div>
        <a href="#" class="btn-gray seo__btn" data-title="<?php pll_e('Показати більше') ?>" data-hide="<?php pll_e('Приховати') ?>" data-seo-btn><?php pll_e('Показати більше') ?></a>
      </div>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        let bSeo = $('[data-seo]');
        let btn = $('[data-seo-btn]');
        let btnT = btn.data('title');
        let btnH = btn.data('hide');
        let hBtn = 258;

        seoB();

        function seoB(){
          bSeo.css('max-height', bSeo[0].scrollHeight);
          console.log(bSeo[0].scrollHeight)
          if(window.outerWidth < 1023.5) hBtn = 220;
          else if(window.outerWidth < 767.5) hBtn = 214;
          else hBtn = 258;
          if(bSeo[0].scrollHeight < hBtn) btn.hide();
          else btn.show();
        }

        window.addEventListener('resize', function () {
          setTimeout(function () {
            seoB();
          },400);
        });

        btn.click(function () {
          let _this = $(this);
          bSeo.toggleClass('_active');
          if (btn.hasClass('_active')) btn.text(btnT);
          else btn.text(btnH);
          btn.toggleClass('_active');
        });
      });
    </script>

  </div>
</section>
<?php endif; ?>