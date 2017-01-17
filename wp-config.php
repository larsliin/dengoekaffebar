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
define('DB_NAME', 'dengoekaffebar_dk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         ' `Ab};J@#!P[1xZfGgPUX4t?]h#qj)TxLM k9o4AdtuSU(w*kd5(r5d.F6%^j5d ');
define('SECURE_AUTH_KEY',  'WKHBcgtGJEBcu<+#0j@A^/L4XiRH`*KlZL3{sZ 0d96*tIT;1a^#qI#F/+!eD8%&');
define('LOGGED_IN_KEY',    'c`^PDXu<Zu`@M5CRM`}v+]1E5.75E?Q9L>f[ws?L*MA;`?vUoBX%}/dveeiD?Dl]');
define('NONCE_KEY',        'n0yB`kbs{Rs>J s zd`Db]||`/7&<3IF;&8YA69(CxCNna[6Op4qWw9`}tfW45@q');
define('AUTH_SALT',        ',B6#h@O]&Tp=J`/G6yR*o$+?fUCv|c4/{`I,+Ww6ErSkk{59^421-aAsb&;hrkK ');
define('SECURE_AUTH_SALT', 'LEt1!JvhQ<7c3:/^U@3^dE{UtK`{VAquj)=vTq`F{GqtJ]BNA*#n@yWM4;nVO8, ');
define('LOGGED_IN_SALT',   'nSI}_#z/>)(2aB!)oE%V4x|-@ddH%g.h`xj~N$Fr,O/n2y`/!nTMk_.D!|Xgn}]m');
define('NONCE_SALT',       'b,Y={P8E)b_LwD$DuZDxhmz|5)&sdKRpq=q.WxfYl%VLCj-KpU*(IzpJ f<MA+qN');

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
