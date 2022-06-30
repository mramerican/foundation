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
$terms       = get_term_children($term_id, $taxonomy);

$outCountPost = get_option('posts_per_page');
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

          <a href="#" class="top1__navLink _active" data-an="_fadeUp20">
            <img data-src="<?php bloginfo("template_directory"); ?>/img/hash.svg" alt="hash-ic" class="top1__navIc">
            <span class="top1__navTitle"><?= $term_name ?></span>
          </a>

          <?php if ($terms) {
            foreach ($terms as $n => $child) {
              if ($n == 2)
                break;
              $term = get_term_by('id', $child, $taxonomy); ?>
              <a href="<?= get_term_link($term->term_id, $term->taxonomy) ?>" class="top1__navLink" data-an="_fadeUp20">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/hash.svg" alt="ash-ic" class="top1__navIc">
                <span class="top1__navTitle"><?= $term->name ?></span>
              </a>
              <?php
            }
          } ?>

          <?php if ($terms && count($terms) > 2) { ?>

            <div class="drop drop_mb" data-an="_fadeUp20">
              <span class="drop__top">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/dot.svg" alt="dot-ic" class="drop__ic">
                <span class="drop__title"><?php _e('Більше', 'theme-sp'); ?></span>
              </span>
              <span class="drop__select">
                <?php
                foreach ($terms as $n => $child) {
                  if ($n < 2)
                    continue;
                  $term = get_term_by('id', $child, $taxonomy); ?>
                  <a href="<?= get_term_link($term->term_id, $term->taxonomy) ?>" class="drop__selectTitle"><?= $term->name ?></a>
                  <?php
                } ?>
              </span>
            </div>
            <?php
          } ?>
        </div>
      </div>

      <div class="top1__rt1">

        <div class="top1__filter">

          <!--<div class="top1__filterItem" data-an="_fadeUp20">
            <div class="drop">
              <span class="drop__top">
                <img data-src="<?php /*bloginfo("template_directory"); */ ?>/img/select.svg" alt="select-ic" class="drop__ic">
                <span class="drop__title">Країна</span>
              </span>
              <span class="drop__select">
                <a href="#" class="drop__selectTitle">Країна 1</a>
                <a href="#" class="drop__selectTitle">Країна 2</a>
                <a href="#" class="drop__selectTitle">Країна 3</a>
              </span>
            </div>
          </div>-->

          <div class="top1__filterItem" data-an="_fadeUp20">

            <form class="formSearch" role="search" method="get" action="<?= pll_home_url(); ?>" novalidate>
              <button type="submit" class="formSearch__btn">
                <img data-src="<?php bloginfo("template_directory"); ?>/img/search.svg" alt="search-ic" class="formSearch__ic">
              </button>
              <input name="s" type="text" class="formSearch__input" required placeholder="<?php _e('Пошук новин', 'theme-sp'); ?>" value="">
            </form>

          </div>

        </div>


      </div>
    </div>
  </div>
</section>


<section class="bBlog pCat">
  <div class="container">


    <?php
    $current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args         = array (
      'posts_per_page'   => $outCountPost,
      'paged'            => $current_page,
      'cat'              => $term_id,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'post_status'      => 'publish',
      'suppress_filters' => true,
    );

    $query = new WP_Query($args);
    if ($query->have_posts()): ?>
    <div class="bNews" data-main>
      <?php
      while ($query->have_posts()): $query->the_post(); ?>

        <?php
        $tumb = get_field('prev_img') ?: get_bloginfo("template_directory") . "/img/bNews1.jpg";
        $t    = get_field('prev_t') ?: get_the_title();
        $d    = get_field('prev_d');
        $par  = get_field('prev_cat') ?: __('Новини', 'theme-sp');
        $date = get_the_date("d.m.Y");
        ?>
        <a href="<?php the_permalink(); ?>" class="bNews__item" data-an="_fadeIn">
          <div class="bNews__txt">
            <div class="bNews__info">
              <div class="bNews__date"><?= $date ?></div>
              <div class="bNews__cat"><?= $par ?></div>
            </div>
            <h4 class="bNews__title"><?= $t ?></h4>
          </div>
          <div class="bNews__wImg" data-an="_imgR2L">
            <?php
            if ($img = $tumb) {
              $imgId = attachment_url_to_postid($img);
              $alt   = get_post_meta($imgId, '_wp_attachment_image_alt', true) ?: pathinfo($img, PATHINFO_FILENAME);
            }
            else $alt = get_field('h1')?: get_the_title();?>
            <img class="bNews__img" data-src="<?= kama_thumb_src( 'w=364 &h=232 &crop=top', $tumb ) ?>" alt="Parimatch Foundation - <?= $alt ?>" width="364" height="232">
          </div>
        </a>

      <?php endwhile;
      wp_reset_postdata();
      else: ?>
        <p><?php _e('Йде наповнення розділу...', 'theme-sp'); ?></p>
      <?php endif; ?>
    </div>

    <?php if ($query->found_posts > $outCountPost): ?>
      <div class="pCat__foot" data-an="_fadeUp20">
        <?php if ($query->post_count >= $outCountPost): ?>
        <a href="#" class="pCat__btn btn-transparent" data-more><?php _e('Показати більше', 'theme-sp'); ?></a>
        <?php endif; ?>
        <div class="paginationWr" data-pagination><?php
          if (function_exists('ps_pagenavi')) {
            echo ps_pagenavi($query);
          } ?></div>
      </div>
    <?php endif; ?>

  </div>
</section>


<script>
  document.addEventListener('DOMContentLoaded', function () {

    let paged = <?= $current_page ?>;
    let btnMore = $('[data-more]');
    let pagination = $('[data-pagination]');

    // more
    if (btnMore.length) {
      btnMore.click(function (e) {
        e.preventDefault();
        let _this = $(this),
          par = $('[data-main]');

        let data = {
          'action' : 'morePost',
          'args'   : <?= json_encode($args) ?>,
        };
        data.args.paged = ++paged;

        $.ajax({
          url        : "<?= admin_url('admin-ajax.php') ?>",
          data       : data,
          type       : 'POST',
          dataType   : 'html',
          beforeSend : function () {
            _this.addClass('_loading');
          },
          success    : function (data) {
            if (data) {
              par.append(data); /* insert new posts*/

              if (par.find('[data-no]').length) {
                _this.remove();
              }
            }
            else {
              _this.remove();
            }
          },
          complete   : function () {
            _this.removeClass('_loading');
          }
        });

        paginationGet(data);
      });
    }

    function paginationGet(data) {
      data.action = "paginationAjax";
      data.pageLink = "<?= str_replace(99999999, '___', get_pagenum_link(99999999)) ?>";
      data.pageFirst = "<?= get_pagenum_link(1) ?>";

      $.ajax({
        url        : "<?= admin_url('admin-ajax.php') ?>",
        data       : data,
        type       : 'POST',
        dataType   : 'html',
        beforeSend : function () {
          pagination.children().remove();
        },
        success    : function (data) {
          if (data) {
            pagination.html(data);
          }
        }
      });
    }

  });
</script>

