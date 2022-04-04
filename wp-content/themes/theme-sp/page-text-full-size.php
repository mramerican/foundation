<?php
/*
Template Name: Тільки текст
*/
?>

<?php get_header(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let _header = document.querySelector('.header');
        if (_header) _header.classList.add('_black');
    });
</script>

<?php if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) { ?>

    <section class="top3 full-size-wrapper">
        <div class="top3__box container">

            <?php breadcrumb(get_the_title()); ?>

            <div class="top3__row row jcsb">
                <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="top3__title title44" data-an="_fadeUp20"><?= get_the_title() ?></h1>
                <div class="pCont__desc" data-an="_fadeUp20"><?php the_content(); ?></div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php } ?>

<?php get_footer(); ?>