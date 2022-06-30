<section class="pAbPerform">
  <div class="container">

    <div class="bTitle" data-an="_border _fadeUp20">
      <h3 class="pAbValues__title title56"><?php the_field('numbers_t'); ?></h3>
    </div>

    <?php $items = get_field('numbers_items');
    if ($items) { ?>
      <div class="performance" data-num-main>
        <?php foreach ($items as $it) { ?>


          <div class="performance__item">
            <div class="performance__title" data-an="_fadeUp20"><?= $it['t']; ?></div>
            <div class="performance__sub" data-an="_fadeUp20"><?= $it['s']; ?></div>
            <div class="performance__pic" data-lozy-bgimg="<?= $it['ic'] ? : get_bloginfo("template_directory") . '/img/performance1.png' ?>" data-an="_fadeIn">
              <div class="performance__num">
                <span data-an="_num" data-num="<?= $it['num']; ?>">0</span>
                <?php if ($units = $it['units']): ?>
                  <span><?= $units ?></span>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php } ?>
</section>