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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'woo2' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'NwsafRj6vxphbwLs20kowxwlIg0jo0ED0gnKWmKX9IeC4Kx4F1n2WvVKLcFFFvft' );
define( 'SECURE_AUTH_KEY',  '7nXOUkJQFtu0jwFOqWWnk6wbWr2KxSwOAUmvJiTXMog1tqJN97eUzAoDNMQ5z7EX' );
define( 'LOGGED_IN_KEY',    '9MoPYYzIlu4GvysyN5z2QMdjEoRZAMnribvCXLjSpRCf0d2taxfwYpGlCtsmiazN' );
define( 'NONCE_KEY',        'iuc7EcMrf9azMsbMXPqaVYgS3SPxsuUZFptNLZug3L3Lv5PDXoS33HIsqTwOL920' );
define( 'AUTH_SALT',        'XtswHMtwZiA1nSE1k68dm0J87zhlAr88EoHeTfLBInNrvaEIJPR0GMLf0ewUeGGy' );
define( 'SECURE_AUTH_SALT', 'wYHJyqEYAtOEECqml9a0mHrOEPopmNj6oVi8QGszoVZohYRqHIUQBLLY0hEDC3a6' );
define( 'LOGGED_IN_SALT',   'OyMyAWcgoK51Fpy4JxVBIlGb3fsOyOSJCCBSSJBj7GauCmcTe9Sst7ARNg2wN3x4' );
define( 'NONCE_SALT',       'Rv0Opi2RMLcAvrPLvGg6U1dH7zhz8c6zyqgvKgb6OAb1DCxpgLEg5wTUtMs7ufP1' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
