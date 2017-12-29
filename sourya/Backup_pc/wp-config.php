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
define('AUTH_KEY',         'e`y0D}:D26X]Nx=44Q4FFX#|4et;Rs`nDHE~UIaQF?*p1=|9qPKzV;|7guOH(KJu');

define('SECURE_AUTH_KEY',  '(UCOSn(/4(B1:?7r[?c?^]k 3[n^u2*:<0<uP^k24ei`Ef-#*tu@%$j+ P}6`-iV');

define('LOGGED_IN_KEY',    'vVt0$}Hu&fO0Y0VjT*_Mjp;[GvD~ZT/fM1n:]Yn>:)w4%YQ1L,5K1oTr=9fdC89z');

define('NONCE_KEY',        '%&MV?=eh2Pbk$]L5UVWX/3]e3J)W sr}M1Zw$PVaTJYmt}c!hF/ef;d&kg{92pdo');

define('AUTH_SALT',        'KsS=G)&SIsBX}Iy{A.=[#Ur3`-)w<z-)&:tei!0|9q/trB3U1k~>DaQ)peG8`3pf');

define('SECURE_AUTH_SALT', 'pNy3<R3pk0j>v@039Od(LH(=Nrm^)UH,UyDS6,2#d5rAwOgFi,P|}):TPiAN;Tcx');

define('LOGGED_IN_SALT',   '=o{IM7qP<C-}$ppE{2?_u#HS0b7D%=NRziTX-Zetb#H,WJ&1%{ 0.5&_x#TFp7X]');

define('NONCE_SALT',       '<)2[MA`nO~VHmIw03s63ux3hp2S`q^?jip*0TH)e7IGc_I)GhA_.h-C~e?zqZ/wU');


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mansfieldwp_';


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
