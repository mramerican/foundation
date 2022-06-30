<a href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;hashtags=my_hashtag" class="share__link" target="_blank" rel="nofollow">
  <img src="<?php bloginfo("template_directory"); ?>/img/tw.svg" alt="twitter" class="share__ic">
</a>
<a class="share__link" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=&source=<?php bloginfo('name'); ?>" target="_blank" rel="nofollow">
  <img src="<?php bloginfo("template_directory"); ?>/img/in.svg" alt="linkedin" class="share__ic">
</a>
<a href="https://telegram.me/share/url?url=<?php the_permalink(); ?>" class="share__link" target="_blank" rel="nofollow">
  <img src="<?php bloginfo("template_directory"); ?>/img/te.svg" alt="telegram" class="share__ic">
</a>



<a href="<?= get_field('popup_twitter', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
  <img src="<?php bloginfo("template_directory"); ?>/img/tw.svg" alt="twitter" class="share__ic">
</a>
<a href="<?= get_field('popup_linkedin', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
  <img src="<?php bloginfo("template_directory"); ?>/img/in.svg" alt="linkedin" class="share__ic">
</a>
<a href="<?= get_field('popup_telegram', 'options') ?: '#' ?>" class="share__link" target="_blank" rel="nofollow">
  <img src="<?php bloginfo("template_directory"); ?>/img/te.svg" alt="telegram" class="share__ic">
</a>