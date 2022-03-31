<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

define( 'FORCE_SSL_LOGIN', 0);
define( 'FORCE_SSL_ADMIN', 0);

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'username' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'password' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '|w~$gsO^rq:DT.Mnh%y_?C5uww#bX5R>C#Tv)YP ,uMQ{EW&hj;aZW< oaW|12bf' );
define( 'SECURE_AUTH_KEY',  'GW4dVw$k8LR.W5#{QLByMFmf-|,]Jr_EJcWD7v,}zUsIGa#+l}1gOTvWiIKd5fg7' );
define( 'LOGGED_IN_KEY',    '4YlUgyUMAaXE]eynoG!@U}uEs4PU[#[>QDLCG5zfc6?,QJ Sd.rVux^ZaY`Y5p>)' );
define( 'NONCE_KEY',        'tdJ/X!l8817QnZbHevum-cF2D7[.Gh ZgP=8]l@fUEA)Zl.,<J{B$fxZ PMd/WNc' );
define( 'AUTH_SALT',        '^YXEJ-2:v6wTp,xKM.Nq+F&AV4_9wIeJJ8%s:^L5A!lGO]~Imt/0iL]*.sOv3/6V' );
define( 'SECURE_AUTH_SALT', ')s^3Z#T,0vOtS#nfeI>1pE,}2O(+~sD<#u/807zAv2HpB,U(m@CTCWP2VWQyHPZd' );
define( 'LOGGED_IN_SALT',   'U&9^qfPo 6Jd0.tcvQ*O:(OdTJ^;<h]51.4.+gw9z?RW[9yk!3#s[;Fm&c>PIG,i' );
define( 'NONCE_SALT',       '1-4d$D05fp<(N!L<fCn`9D0r8M@ukEvaX(OM@-/ac] &U0*mn~m~yY1pGLXA8<KA' );

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
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
