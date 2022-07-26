<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */


/** @desc this loads the composer autoload file */
require_once dirname(__DIR__, 2) . '/vendor/autoload.php';
/** @desc this instantiates Dotenv and passes in our path to .env */
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db' );

/** Database username */
define( 'DB_USER', 'db' );

/** Database password */
define( 'DB_PASSWORD', 'db' );

/** Database hostname */
define( 'DB_HOST', 'ddev-atract-db:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '9%,r01ZBab-$P9II1.NCbu?~;bG%Fu$:`( piZ/p?!9Yv?)cy[73T-e(tSvJX:YC' );
define( 'SECURE_AUTH_KEY',   'H6r@abMHYASQLrT_p5kYZS :f5~XDB+$124?}Pi$k2aLvw25QF29H}YTzAtsAdG<' );
define( 'LOGGED_IN_KEY',     '%B[y)NX0%oaz$r`;_xh)yJp%%oZd-H^RA)4.*);CP!9&R1eL#q9XhDqW{GVO@,Ry' );
define( 'NONCE_KEY',         'F;)g^MFF#m^LzN}m/V3elWb)6xBJd}7pY*n%w%[7Mdl6ehWfgGlKNTr}<9LW6UO&' );
define( 'AUTH_SALT',         'XpsS@H[hh4ta:h7y`jm8*vM`QKAMArW}O!8~9)zX2GHm+=m-t+P?jU_)v%:s4QY>' );
define( 'SECURE_AUTH_SALT',  '?fL+Osm]U;JwH2sMHl6lERUe2D[%=)NSPT(?@|QGM-3`$DYjq%AU}BCG_X-~fTi1' );
define( 'LOGGED_IN_SALT',    'FQ>HE6nU<Hj-8A)A7>)KpCk6bRYj1pAI4z0/f$U-c?aBN8n~~jjg]iX+f,W$H4#v' );
define( 'NONCE_SALT',        'MGlY<,5c+r@n8`caTNc rC*io+f.[0[=;]wj2]?$vS=VFJX)l@d*(^Zw.?#z9=&F' );
define( 'WP_CACHE_KEY_SALT', 'oG+G-dY$:-+.bD8bUuBGw xsF/vd~V(/[-a2IV&yihiCGvKh,s>IB}VmQ-eyDY/p' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

/* Add any custom values between this line and the "stop editing" line. */
/**
 * REITER.WORK customs
 */

require_once (__DIR__ . '/wp-config-rw.php');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
