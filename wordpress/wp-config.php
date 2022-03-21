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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', '');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         's,s77(+c7-^hkz.3m]r^d4Qw>/56E9`)ohWSBf4WEr.eInVN&&/J=Yu+#I Df6I_');
define('SECURE_AUTH_KEY',  '#la>0b06).N-K_B2[e)8atVyO8uJKhGyud#?hYu&,rg$WE5HP}b@`@,Drcgh/.Qb');
define('LOGGED_IN_KEY',    'o]__fJIWj}/gG<) sK3![(e/bao;VYazBdyX*^>fL<V%2_)p=q#lY|3h8N*A(dQN');
define('NONCE_KEY',        'z6T(b<L>U4=3N1|v!NSNw[S#ueG^~8N(xN_~hwy4>uXy&Xb[HMf1DJBvHCY7>+EG');
define('AUTH_SALT',        '}qYdYMTa5*mQ52c+,|1~`F_trwdjV[eoT|{BiLm~#>FEMR!m&,9]hQh$z8J!sw5&');
define('SECURE_AUTH_SALT', '!f5JwuJXv3;eEt>}i$DQ0fL1a+M5eV%$kzO$ ?<raf?2IdWno&jmPoLTV40ModeQ');
define('LOGGED_IN_SALT',   '-9w/oE.WtxEK?~FNO(`|o%0v1GW0F3%w>;;S(m>u^Dx,SZ|m(*C eWg2C~:^gi3&');
define('NONCE_SALT',       '$V<]=_D^E-GVMwZ9)*7Jpt%3doz/qBELVg:i<a/w2d>K|{>7z2`B5bPk8:R>>T,O');
define('JWT_AUTH_SECRET_KEY', '(KXMi/#:N3-B4=*i??4(ULMpk,LZU3Vbz|C&e{UZ]BG`K]1k|-f FRwb:#uY J2?');
define('JWT_AUTH_CORS_ENABLE', true);

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'test_wp_';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
