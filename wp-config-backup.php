<?php


//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

//Begin Really Simple SSL Load balancing fix
if ((isset($_ENV["HTTPS"]) && ("on" == $_ENV["HTTPS"]))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "1") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_SSL"]) && (strpos($_SERVER["HTTP_X_FORWARDED_SSL"], "on") !== false))
|| (isset($_SERVER["HTTP_CF_VISITOR"]) && (strpos($_SERVER["HTTP_CF_VISITOR"], "https") !== false))
|| (isset($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_CLOUDFRONT_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_FORWARDED_PROTO"]) && (strpos($_SERVER["HTTP_X_FORWARDED_PROTO"], "https") !== false))
|| (isset($_SERVER["HTTP_X_PROTO"]) && (strpos($_SERVER["HTTP_X_PROTO"], "SSL") !== false))
) {
$_SERVER["HTTPS"] = "on";
}


define( 'WP_DEBUG', true );
// define( 'WP_DEBUG', false );
define( 'SCRIPT_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );


//END Really Simple SSL
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', "foundation" );


/** Имя пользователя MySQL */
define( 'DB_USER', "foundation" );


/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', "DcGbpc5m73e5wmA" );


/** Имя сервера MySQL */
define( 'DB_HOST', "localhost" );


/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );


/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'q%qgVM,sm7v|Kz~b_/?T{-J.#XE!FT&T*_=4H8gO?fc3*yhTJ;45/no:duw%_-dd' );

define( 'SECURE_AUTH_KEY',  '@J_B9[irgB@s(RVvbtDJdX$^xsK7r|IH#*&JEVniSfKw[t2zU)=``bz5`a1sPD%t' );

define( 'LOGGED_IN_KEY',    's0v-zroER,HMzO7EkEg;K4,>:37d%euOa8Zp7UQhv?yS^C@jii-dYr:fjGR}AsM1' );

define( 'NONCE_KEY',        '4W,fPdCY|On/Uc`^W;mJqj-5Sm#w778eF(>n8/:56d99Q1;/pjE*Z13~P,7RwS*U' );

define( 'AUTH_SALT',        'SwRt~+ZDzjF=lz>}VKw)X>%]RrP1/1*PX$|`;%|6mRG<1aDta90U W,noSo%*L}L' );

define( 'SECURE_AUTH_SALT', 'iOcA-TEF!~xr.tZi|UC=iH+xmBmEEF]NyRu7s:gR*x5S9ux}C3T/8UiO[MP7X2QA' );

define( 'LOGGED_IN_SALT',   'nn/tQ>OzZxqwoX(v#(K8BQ1J{8+%B<cPXE{-Kwn~e1^V3ZF)]&6Qp;HP]?/Y}x}n' );

define( 'NONCE_SALT',       '~t|$:p<9%xTL~Ij.[YYyCToA4Lv4suID|;y3drUoPvK@%9l s@ZvRS_g_Ae:(bIf' );


/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';


/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
//define ('ALLOW_UNFILTERED_UPLOADS', true); // in wp-config
/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );

define('FS_METHOD','direct');
