<?php

/** WP 2FA plugin data encryption key. For more information please visit melapress.com */
define( 'WP2FA_ENCRYPT_KEY', '966EN75UlX/sySWy4gCB8Q==' );

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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'employees' );

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
define( 'AUTH_KEY',         'Fw|AgKv):]ps2+SS|H*+P(&&fAyB!7v6X^}5D%:;:$@|+^Fd&/qAdA!=PTVJ%s}]' );
define( 'SECURE_AUTH_KEY',  '6,#g5EAys*59/<!1sZ@8 Y 7XB$duGg #0K;P77qx#cl>+[L`$.N2YZs&gT#1xr@' );
define( 'LOGGED_IN_KEY',    'Kd3[-SUhY4OndEFV~^2fxzEa&;9qRhyY9_]qdV:X$|9_|f44f7S9q4b<O0F%x;;U' );
define( 'NONCE_KEY',        'vY bR~c@#Xx@hlI[,zq$,w/POH=H}URo#mbPwSQoh $ J8Vy-[);UOT0[.wQO6Az' );
define( 'AUTH_SALT',        'Nx($tZ*_]2cnB Yei3-yidaSr2*=PMR*62=2;5c32`8vNxm$J7K-k<Pp&5D8<qFy' );
define( 'SECURE_AUTH_SALT', '1j@OCJ=jdXU^+=5aQ*n0ku*@.>5.s&!cVo{#fvwgCp&1=Lk)ew]#6@ YB~f~lgs.' );
define( 'LOGGED_IN_SALT',   'IuLnIL.81><+9aoucttdE2mQ>XC>[XQ6g;?4(E98lKS=fZaO!suknq/tyO^U|-=!' );
define( 'NONCE_SALT',       '#Jb~TGF Qf(s2Z[>1|y3] 96ZJ*#mj/n@kn5s~$T(Kg=2C*?/?w$GUAoD5h(*PpR' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
