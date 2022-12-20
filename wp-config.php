<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'axel-vair_wp_b3lqo' );

/** MySQL database username */
define( 'DB_USER', 'wp_s0fwe' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Zltjfm0nY075E*j_' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'b4~@C-r0[Mx51T*2G8lC3ZQ|YWq67a9J[WN_OYDDc+4#Z[V4UgV44]gX@]KU!zX)');
define('SECURE_AUTH_KEY', 'iBD/#h/)dzPh~8m)yI([+4R];(%heB3Es5@2w0TV@C[[613L(vTbmhGr8Ed*@g01');
define('LOGGED_IN_KEY', '!%ztN1a4:7|l12b4(7[vLck26x9m2GTlRcXgc;g+dG2%-Bu3-:~i27/Xp|6jp|b9');
define('NONCE_KEY', 'mV~vX566wEf02C;nRt1Mh+I;Rk8Ns/EP|)924H2@tM_+pbla8sx)2P3e01@q3;!l');
define('AUTH_SALT', 'eB5E0-6zm3])t#Udc7noo:K#f40%6Y/O3G8%p)p3DD|PSJ%3c9U4#4b_U2mZH[u)');
define('SECURE_AUTH_SALT', 'Bt_)zZM1Z0MMNTC[#R*|6xA4Rn)*1;87w-*hi8)4Xq-n|7(]b+p!Wa_ec3)1yUBu');
define('LOGGED_IN_SALT', '041vOy[]4d:Mke@@i6OL1U*WO;yojx:/1c[Knf#vN14!_d8lnM5(U[_j]e;6fs1c');
define('NONCE_SALT', 'p&4ibL55M7Fb4iXLye@z-d:9UozGxZ%Va79#|555[66[&UG0Nwb9)BH3g[MAhMcl');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '1p14NxLA6_';


define('WP_ALLOW_MULTISITE', true);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
