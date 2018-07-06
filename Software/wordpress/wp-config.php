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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'smartkeeper');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123EWQasd');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=/0)_zvJC28X?p4:c9frL}Ci1on5}DpfJL2lgm4TrkMAW8l:xl4CfE<LrxM{ RFF');
define('SECURE_AUTH_KEY',  '[3*g+/BIc~u(a^/D,leL?hJwOYEU].Xop;Kx}[k4_W_7.v]h]SsshOD%Cdu[*V@h');
define('LOGGED_IN_KEY',    '4[gQ|u5gycK.7lzzs/s,G*zg^sJMs_ugFwJ}JlA#C^ lD.P+hOCw$/R=fr>M(R4I');
define('NONCE_KEY',        '2Yk<*Xo0T|7/`(L]eS1h8A?!oBxafv.m]h1mKS(pV?-3JyHZbXWVw~-4m|KNz@mS');
define('AUTH_SALT',        '`u`$2-Xo>EdB$wS90Z?Z34- rhuK#fk(q4C>TxGoXJr]zaawPSt_A@>mDfY2NQT(');
define('SECURE_AUTH_SALT', ';1QikqQn2V(Nx=P<Ws|bR/ ?]$O~5=./429Z B0gow{6h;Yrp~)$)([fD:!Eu(^I');
define('LOGGED_IN_SALT',   '{kD^7dD`s91YVR`CE]Cw,8Vxud*sv/6$z8BF~$Fbn7C`2>lTa;ify-->Y+^k^5wA');
define('NONCE_SALT',       'yAA@087>_<bt Wr8hYq[h:a]o?&RrK:V/z&hhDa;pXeNor?*xAg})k.7PDzvf+}w');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
