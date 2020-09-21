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
define('DB_NAME', 'meidfr');

/** MySQL database username */
define('DB_USER', 'meidfr');

/** MySQL database password */
define('DB_PASSWORD', 'M31dFr4nc3');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '3T2aM^m51A(nKHHRnuuc@3neiYktE)g^sQz#77NwH0JGjFv5HWp7mYEnCbUesVhc');
define('SECURE_AUTH_KEY',  'cRWzknMv(pnosm5j2vFt3#SKZxVR(@CpsxdM3EH!Yzwqak9#mpx*s)gDAnZ^c6rm');
define('LOGGED_IN_KEY',    '1SDON58dSBtpbk!FoOxQVpHZ6^PWq4bhOKy5bolUEzFtA@dxhz%Uo7j!tNXXqlJP');
define('NONCE_KEY',        'sb#C#iOv&Zw(8WtUXlX6zB%YyMgnfjpPb0nsfbUJAj#6euNLro@QshbA!7cw&lpz');
define('AUTH_SALT',        's%vBMX9xN(yy6rUc6S#h!3%MQ9w#GWSYMtyLU2FY*CadiOS9xft76)vBpa88)5Ea');
define('SECURE_AUTH_SALT', 'S4r&VgCAS33r*MZmJn&Dmc2QPgmsta%L2gUmujV*cYFfgHtgU45sicOROC3(zjGK');
define('LOGGED_IN_SALT',   'RbRJwvAJdKJA)Rujh&LtGEJIxEZO6^8Og4Hil7^F#f@qESoaDP5LRtJiTHOLCnAn');
define('NONCE_SALT',       '3Y@FnpPWoHTbL%OBXEaSLfnYSh0ZxK2QEJxn%M&ssFGyb0@!Xx)NUHprrwK#baGU');
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

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
