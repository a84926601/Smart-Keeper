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
define('DB_NAME', 'smartkeep');

/** MySQL database username */
define('DB_USER', 'admin');

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
define('AUTH_KEY',         'Mjv920=9{xk0//Ap*9$ z]Noll+0w;cqJ>n=h*E_cA0Vc}e>~3WOsi=~-@*^=O%@');
define('SECURE_AUTH_KEY',  'tX9W8X3/YcRB{@ePRcJX-1Bu}D%ca=FHJxK`tLD,i gwhoqt4*,<vs~C}<#:p&Xg');
define('LOGGED_IN_KEY',    'flsZnB~0MhWVIvzn`,VV<g+cQmQ*<bh--!`Y(dvGq J8jCe0_1}TZ*JGobh3+w|-');
define('NONCE_KEY',        'xP$^5i^tySp{]QdHB(?Q,^q+M;$Ao+ddh./s4~u7QUxc6$&I`A7-Eq%thcz&mo_f');
define('AUTH_SALT',        'C(+{.X1yw+ MY`F,FB&LFtsyxcKiOotnJd9S^bi-6z/++D1^c2I]4,@;IZ# hxVa');
define('SECURE_AUTH_SALT', 'JVORNU^FlLrE$)_Ah[F)ivbZL7g6zuG/VUo=#vAEzjg#-Vi=!+Ej#9z=B74|xe-|');
define('LOGGED_IN_SALT',   '7:2m`9Tr]h|+| 9yKXCSQ5<vR5*0Ks`EmNA_k#u%/Hs; B2x`wXPv/5J4$@M$doE');
define('NONCE_SALT',       'Uy6!Q{8$hJVi(g08Ehh)z3ATp#&*A-fzW$V5rOYB [@2*o81Kg>J1YTekC*66,d9');

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
