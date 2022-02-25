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

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db' );

/** Database username */
define( 'DB_USER', 'db' );

/** Database password */
define( 'DB_PASSWORD', 'db' );

/** Database hostname */
define( 'DB_HOST', 'ddev-wohlbekannt-2022-db:3306' );

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
define( 'AUTH_KEY',          '<sH``?t)a5[:C]> ;<*Ph+Tj8N,<sM`cc[~Bk5pTJ[uo9q-@^,{,s#d?,n%-7-hx' );
define( 'SECURE_AUTH_KEY',   'J>,.{Rn)@]+&N{k$==@ovC*3<x~,f|WV3raw!x;^?=ql!W<IvMbc}*a K|n!^5_p' );
define( 'LOGGED_IN_KEY',     'XS1-(jGw,x(^&[H;`WqZRy-~[p*Z0M<<swp[[M;JaedCqz%u|1B>g_bb|Js!`! V' );
define( 'NONCE_KEY',         'e2YmJyqN <cJeTn3{/Q9S;nB)uP[;(kp+!9|N|-?~R]#ns0,+P)_=ER ].d|+WC<' );
define( 'AUTH_SALT',         'Yx)C97aKD+pEP6~%n88F#Ll{eNNKa_H 4/R~QSh}/wexC&l`8`pJc{?aFGi+JA~ ' );
define( 'SECURE_AUTH_SALT',  '|*!TUvqqAm` vFLg4k#%yFa;Q:Sl+VF*4LaH&BT3;L-^z@/aS7O])9n{p2fP(Sx6' );
define( 'LOGGED_IN_SALT',    '-y~SP|u9C8=|<s0k-6x{x7b3!x].>,}>2N)/JkEJ++B.qpKVCXP@f_qjip+oIP7s' );
define( 'NONCE_SALT',        'B=qa a@InyIjvuJQlP!~x/XM 9u?2c_K__pu,sm$%7[Jp`7_*7wTswEPBH~S=PoJ' );
define( 'WP_CACHE_KEY_SALT', 'K>EGWXA l*xH}<uW%q<TS/2tFBXTYf4JS5W6[5a%hsBRqJH2ep#B[=tD]d]- JM]' );


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
define( 'WP_DEBUG', true );

require_once (__DIR__ . '/wp-config-rw.php');


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
