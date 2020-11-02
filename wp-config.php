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
define('DB_NAME', 'u1cwn8r');

/** MySQL database username */
define('DB_USER', 'u1cwn8r');

/** MySQL database password */
define('DB_PASSWORD', '5vPdmMrQw');

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
define('AUTH_KEY',         'lvuu55vec2acxdnwzad6syk8hiwkhsvbha9ltqy15hf7l5hhpdhrmzqlydslg1cz');
define('SECURE_AUTH_KEY',  '6a99zzwappciw4ebohionxtfs2miizedqgv7fs9qw14tpzmdglvpjqps7ocncy7s');
define('LOGGED_IN_KEY',    'uh8zavvit3jo1qebimtmzvnplzofut0wjmfnjcjn2jvgkgo5ajy6lllqvmgm3uqw');
define('NONCE_KEY',        'pihxf6zcjfr13uq7uqid5qsycjn12bnegi4qjznkmrcagsocl2uuigkna3czuuad');
define('AUTH_SALT',        '93oubinxg7mn8eblfocd6efjtjfbxrzxcjgutgyfg01sn9edpigg0iirlhhyioxe');
define('SECURE_AUTH_SALT', 'thr3czaxn9yaa9cqglb0yhadqddg6f5uecbaufqtdgbtns5qleczbu4mfrgupyfq');
define('LOGGED_IN_SALT',   'eskln6uo5vskyrnetdqn9fmekmtifasijzd04srx2bfo1tnisssnqip2zv9jccox');
define('NONCE_SALT',       'jrvlserzxvo41rcjuumfhlihkxdllhtlk6yhsdpwbbosd5tpjpmlyxhy4c4mm51l');

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
