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
$title = get_field('title', $term) ?: $term_name;

get_header();

if (!strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse')) {
  if ($term_id === pll_get_term(17)):
    require_once get_template_directory() . '/template/cat-programs.php';
  elseif ($term_id === pll_get_term(19)):
    require_once get_template_directory() . '/template/cat-events.php';
  else:
    require_once get_template_directory() . '/template/cat-news.php';
  endif;
}
get_footer();