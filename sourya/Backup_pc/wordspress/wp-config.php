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
define('DB_NAME', 'unitetoh_mansfieldmenswear');

/** MySQL database username */
define('DB_USER', 'unitetoh_mansfie');

/** MySQL database password */
define('DB_PASSWORD', 'mansfieldmenswear');

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
define('AUTH_KEY',         '@!KOKosN)_w=o]*7p|(Pg]K-GX~5irvs,@7I=6P-NPMl[g=-HX(n0b{YHv&kJ} v');
define('SECURE_AUTH_KEY',  'e&j8pl[-Ap1q*vV$*.[%;eunt/ 4CoD4n.A2CH*&f;]}ArtPJsIZ=0w^Z%[8*W*7');
define('LOGGED_IN_KEY',    '-Sn0Gt[_/~2fRH^r*HY/Rf*G;e#<`fxHK5[-Dk+J<ptEf)F J5<}/o,uxH=/ 23!');
define('NONCE_KEY',        '(4eM_UV#<oa?++is}N?P*UT]UZSL%+tkU}kBfi&{enS4h|{T>^4pE+c:sVFglJS+');
define('AUTH_SALT',        'R%5y]hF5QI8~+FFgIU`$!+P9G:JgYI.?wTBkoQENAZ[{eK!hf}g7:IVR5i8{ o#N');
define('SECURE_AUTH_SALT', '8P =C6(;}*e}a;{)G.q}dimS!!`,h}5vT|S#uA?0B<rfBL8&+O/OLrd[)Ep33;+C');
define('LOGGED_IN_SALT',   'RI$-IoY]N+_mz0eedv,BI{5aP4NeH,t=n`[jsP-E>>]_ KQo}yn.%`87_M(:rQHD');
define('NONCE_SALT',       '5clQ5q-66y0} GH&Vnx*RY{wTE0JDrxVU?gv;%0w1d3B($uYbCu{b]V.=- JN ge');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'man_';

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
