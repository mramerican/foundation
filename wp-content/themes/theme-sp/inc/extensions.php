<?php

/**
 * current-menu-item на acrive
 */
function special_nav_class($classes, $item)
{
  if (in_array('current-menu-item', $classes)) {
    $classes[] = 'active ';
  }
  return $classes;
}

add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

//разрешаем новый тип записи
add_filter('upload_mimes', 'upload_allow_types');
function upload_allow_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}


function breadcrumb($title)
{ ?>
  <div class="b-breadcrumb" data-an="_fadeIn">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?php echo pll_home_url(); ?>" class="breadcrumb__link">
          <span itemprop="name"><?php _e('Головна','theme-sp'); ?></span>
        </a>
        <meta itemprop="position" content="1"/>
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span class="breadcrumb__cur" itemprop="name"><?= $title; ?></span>
        <meta itemprop="position" content="2"/>
      </li>
    </ul>
  </div>
<?php }

function breadcrumbSingle($title, $catName, $catId)
{
  ?>
  <div class="b-breadcrumb" data-an="_fadeIn">
    <ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
      <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?php echo pll_home_url(); ?>" class="breadcrumb__link">
          <span itemprop="name"><?php _e('Головна','theme-sp'); ?></span>
        </a>
        <meta itemprop="position" content="1"/>
      </li>
      <li class="breadcrumb__item" itemscope itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="<?= get_category_link($catId) ?>" class="breadcrumb__link">
          <span itemprop="name"><?= $catName; ?></span>
        </a>
        <meta itemprop="position" content="2"/>
      </li>
      <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
        <span class="breadcrumb__cur" itemprop="name"><?= $title; ?></span>
        <meta itemprop="position" content="3"/>
      </li>
    </ul>
  </div>
  <?php
}

function breadcrumbCat($title, $catName)
{
  ?>
  <div class="b-breadcrumb">
    <div class="container">
      <ul class="breadcrumb">
        <li class="breadcrumb__item" typeof="v:Breadcrumb">
          <?php $postid = url_to_postid(pll_home_url()); ?>
          <a class="breadcrumb__link" href="<?php echo pll_home_url(); ?>" rel="v:url" property="v:title"><?php _e('Главная', 'theme-sp'); ?></a>
        </li>
        <?php if (!empty($catName)): ?>
          <li class="breadcrumb__item" typeof="v:Breadcrumb">
            <span class="breadcrumb__current" property="v:title"><?= $catName; ?></span>
          </li>
        <?php endif; ?>
        <li class="breadcrumb__item" typeof="v:Breadcrumb">
          <span class="breadcrumb__current" property="v:title"><?= $title; ?></span>
        </li>
      </ul>
    </div>
  </div>
  <?php
}

add_action('after_setup_theme', 'true_load_theme_textdomain');

function true_load_theme_textdomain()
{
  load_theme_textdomain('theme-sp', get_template_directory() . '/languages');
}

/**
 * admin ajax url
 */
add_action('wp_enqueue_scripts', 'ajaxurl_data', 99);
function ajaxurl_data()
{
  wp_localize_script('main', 'ajaxurl',
    array(
      'url' => admin_url('admin-ajax.php'),
    )
  );
}

/**
 * option for admin email
 */
add_action('admin_init', 'ps_custom_settings');
function ps_custom_settings()
{
  add_settings_section(
    'ps_main_section', // section
    'Настройка для отправки уведомлений',
    'ps_section_cb',
    'reading' // page
  );
  add_settings_field(
    'ps_main_email',
    'Email - уведомлений',
    'ps_option_email_cb',
    'reading', // page
    'ps_main_section' // section
  );
  register_setting('reading', 'ps_main_email');
}

function ps_section_cb()
{
  echo '<p>Введите корректный email, на него будут приходить все заявки с форм на сайте</p>';
}

function ps_option_email_cb()
{
  echo '<input name="ps_main_email" type="email" value="' . get_option('ps_main_email') . '" class="code2" require>';
}
