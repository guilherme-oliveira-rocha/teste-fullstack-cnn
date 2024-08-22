<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'teste-cnn-bd' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '6+EQf!i0^M^~8`/v^c=yrnP`tX:P6]c 2-!WAjm/&wX@81=7(E?97<b}j.a]Y~NO' );
define( 'SECURE_AUTH_KEY',  'A[Pb#fzo^8kP,~r@W<x`|Pi;@fO>C/L-n+N|Q_ms7U;bG1eEGQg}&ITu]k/X`q*t' );
define( 'LOGGED_IN_KEY',    'c$1)U Iqgy/?AcW|w=OWU0j#g`3A16_8Nt2P6<u9}_rq&sGUqYF:/Nvs5#CV<(tY' );
define( 'NONCE_KEY',        'w.WD;PlEGuXPi&chTGTi@#wF.8tVllX9v{/u&OfaTo6V1aPIRZI{J$fnZY6oX;TX' );
define( 'AUTH_SALT',        '&n~1B}z7!qtA/7d)_J!*#Hws9fW^Hp` A7!:af](3jc%@(IEJSz<XWbl~{jMX^q#' );
define( 'SECURE_AUTH_SALT', 'T]q.#B`$9VZ2ZEWQ:Ibl/*C$_;DCe#SQESq6oj3bhBNU8%m[`%|1xuVAHPy/Owk*' );
define( 'LOGGED_IN_SALT',   'x[L~pPbz8LHAPE=H[MUf%G|Ovu{g(`$(4o}{)tl$WR!:;:aOp+~t06MU4~vO#`1<' );
define( 'NONCE_SALT',       'U-c7~AH_}I){_dtMgi#&{v7fH<YklC::=YoI%&Z!^QGd|M/k}uv<UXnaW.o8%jeY' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
