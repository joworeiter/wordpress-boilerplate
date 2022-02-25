<?php

/* Add any custom values between this line and the "stop editing" line. */

/**
* REITER.WORK customs
*/

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    $_SERVER['HTTP_HOST'] = $_SERVER['SERVER_NAME'];
}

define( 'WP_DEBUG_LOG', true );
define( 'RW_WP_ROOT_DIR', dirname(__FILE__, 3) . '/app/site');
define( 'RW_WP_ROOT_URL', 'https://' . $_SERVER['HTTP_HOST']);
define( 'WP_CONTENT_DIR', RW_WP_ROOT_DIR . '/content' );
define( 'WP_CONTENT_URL', RW_WP_ROOT_URL . '/content' );
define( 'UPLOADS', 'content/uploads' );
define( 'DISALLOW_FILE_EDIT', true );
define( 'FORCE_SSL_ADMIN', true );
define( 'WP_CACHE', false );
define( 'WP_AUTO_UPDATE_CORE', false );
define('WPLANG', 'de_AT');

/** WP_HOME URL */
define('WP_HOME', 'https://wohlbekannt-2022.ddev.site');

/** WP_SITEURL location */
define('WP_SITEURL', WP_HOME . '/');