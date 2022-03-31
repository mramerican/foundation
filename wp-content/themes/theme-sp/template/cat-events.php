<?php
/*
 * категория
 */

// data for category
$category = get_queried_object();
$taxonomy = $category->taxonomy;
$term_id = $category->term_id;
$titleParent = get_cat_name($category->category_parent);
$term = ($taxonomy . '_' . $term_id);
$term_name = $category->cat_name;
$h1 = get_field('h1', $term) ?: $term_name;

?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let _breadcrumb = document.querySelector('.breadcrumb');
    if (_breadcrumb) _breadcrumb.classList.add('_white');
  });
</script>

<section class="top1" data-lozy-bgimg="<?= get_field('fon', $term) ?: get_bloginfo("template_directory") . '/img/newsTop.jpg' ?>">
  <div class="container">

    <?php breadcrumb($term_name); ?>

    <div class="top1__row row">

      <div class="top1__lt c5 c8-md">
        <h1 class="top1__title title64 title64_white" data-an="_fadeUp20"><?= $h1 ?></h1>
      </div>
    </div>

  </div>
  <div class="container">
    <div class="top1__row1 row jcsb">

      <div class="top1__lt1">
        <div class="top1__nav">
          <div href="#" class="top1__navLink _active" data-an="_fadeUp20">
            <span class="top1__navTitle"><?php _e('Найближчі','theme-sp') ?></span>
          </div>
          <!--<a href="#" class="top1__navLink" data-an="_fadeUp20">
            <span class="top1__navTitle">Минулі події</span>
          </a>-->
        </div>
      </div>

      <div class="top1__rt1">

        <div class="top1__filter">

          <div class="top1__filterItem" data-an="_fadeUp20">
            <div class="drop">
              <span class="drop__top">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/select.svg" alt="select-ic" class="drop__ic">
                <span class="drop__title"><?php _e('Онлайн-вебінар','theme-sp') ?></span>
              </span>
              <span class="drop__select">
                <a href="#" class="drop__selectTitle"><?php _e('Онлайн-вебінар','theme-sp') ?></a>
              </span>
            </div>
          </div>

        </div>
      </div>
      
    </div>
  </div>
</section>

<section class="bBlog pCat">
  <div class="container">

    <?php if (have_posts()) : ?>
      <div class="bEvents">
        <?php while (have_posts()): the_post(); ?>

          <?php $link = get_the_permalink() ?: '#'; ?>
          <div class="events row">
            <div class="events__col events__col_1 c1 c3-md">
              <div class="events__date">
                <div class="events__day" data-an="_fadeUp20"><?php the_field('prev_day'); ?></div>
                <div class="events__dateRt" data-an="_fadeUp20">
                  <div class="events__month"><?php the_field('prev_month'); ?></div>
                  <div class="events__week"><?php the_field('prev_week'); ?></div>
                </div>
              </div>
            </div>
            <div class="events__col events__col_2 c2 c8-md" data-an="_imgR2L">
              <a href="<?= $link ?>" class="events__pic" data-lozy-bgimg="<?= get_field('prev_img') ?: get_bloginfo("template_directory") . '/event1' ?>"></a>
            </div>
            <div class="events__col events__col_3 c4 c8-md">
              <div class="events__info">
                <?php if ($detail = get_field('prev_detail')): ?>
                  <div class="events__detail" data-an="_fadeUp20"><?= $detail ?></div>
                <?php endif; ?>
                <a href="<?= $link ?>" class="events__title" data-an="_fadeUp20"><?= get_field('prev_t') ?: get_the_title(); ?></a>
                <a href="<?= $link ?>" class="events__btn" data-an="_fadeUp20"><?php _e('Детальніше', 'theme-sp'); ?></a>
              </div>
            </div>
            <div class="events__col events__col_4 c1 c5-md">
              <div class="events__start" data-an="_fadeUp20"><?php _e('Початок', 'theme-sp'); ?><?php the_field('prev_start'); ?></div>
              <?php if ($req = get_field('prev_req')): ?>
                <div class="events__req" data-an="_fadeUp20"><?= $req ?></div>
              <?php endif; ?>
            </div>
          </div>

        <?php endwhile; ?>
        <!--post navigation-->

      </div>

    <?php else: ?>
      <!--no posts found-->
      <p><?php _e('Йде наповнення розділу...', 'theme-sp'); ?></p>
    <?php endif; ?>


    <!--<div class="pCat__foot" data-an="_fadeUp20">

      <a href="#" class="pCat__btn btn-transparent"><?php /*_e('Показати більше','theme-sp'); */ ?></a>

    </div>-->


  </div>
</section>