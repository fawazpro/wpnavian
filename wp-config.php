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
define( 'DB_NAME', 'firat' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'hjzcuj-=4l<9eI(#%?zz4W,Cl;N<LbwV_sZ~^C6^2-G3M7XLSPc#&r%:+3<gO5/q' );
define( 'SECURE_AUTH_KEY',  '[9.l*BKQ?>/dTw)}QezmB`!<q%$90E81wt0Xt%_Qk~P*wwY|wWx&3&N!;j+c*@.D' );
define( 'LOGGED_IN_KEY',    '0{cUfDY9#jjD7 >Ih~G=:`WYm?K[1h.e,W(>@hY7#}^z9r4HNtKtunnIqi5A}JYt' );
define( 'NONCE_KEY',        '?>B09.VBhlp*K=7r!,^hi)maZ/+0h9rA{!Vt^~rb}[J$qm{.DyK+W9i6{]=e<J!w' );
define( 'AUTH_SALT',        'o96g<$i4|,)g1{g{bouG[&hOl`exkf*Q.M%e/0Np41@[iKX;D(B@<=G02z#ojxbe' );
define( 'SECURE_AUTH_SALT', '`DJ9y(8=dw0cpc|BYADW8`+s~dyX@WACi}O-cF0m]*usxn@e+[<;tOF>f9i{YIqi' );
define( 'LOGGED_IN_SALT',   'n*cBU<O#sQvuRCo)Q#_7avtfTabJ| [`X8uc,]Lk4o]OlWzg)@AW+K8h),B/P0Lt' );
define( 'NONCE_SALT',       '1`d(*S;yNLHi}GQbpHwo3c#~1Nc|ms@V%v#<IN&*/RkIF:xWv-ua8+?r^sj=w}0!' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
