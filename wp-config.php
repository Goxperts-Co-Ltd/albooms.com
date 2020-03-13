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
define( 'DB_NAME', 'gxpsvdmt_wp769' );

/** MySQL database username */
define( 'DB_USER', 'gxpsvdmt_wp769' );

/** MySQL database password */
define( 'DB_PASSWORD', 'p4y[p3ES-8' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'fmgedtllgrry1rxu2vfvao9joteni4wlenojy5hogereimroanlccoqq1zo4anxt' );
define( 'SECURE_AUTH_KEY',  'vhhwcffc977abl086u1ef0kdvpu9rx660obocwe4kwhyie926z9i9vxbuiayvdwu' );
define( 'LOGGED_IN_KEY',    'loyqlakfivg4x7tht9q5jw0bd7xdkfcdqwsyh8pp69nzjxr7sdfbx9fli46tohmg' );
define( 'NONCE_KEY',        'yyqtgbwnuvpkpnn1gb7i3yuduh7arezunksop8aw1inrmjcegg2dsa0rb1zwstke' );
define( 'AUTH_SALT',        'ftrhqlfn0qm4aqivbtpooqgxaiwrt8bsska5zrvtdaxo6fy7sma14w0jzsfwfrte' );
define( 'SECURE_AUTH_SALT', 'chbmqbg9khdzzfxhpekr8ys9oott3ihvokbadz1ywvtyhc5rjbjf40exnho0shkt' );
define( 'LOGGED_IN_SALT',   '9shzsjal6hec7v4jls9rm1i5aizxign4ryjxmo7swkh42kylamxxnnxiyx4w8ny9' );
define( 'NONCE_SALT',       'l2atbwo57ztrtnxxrugumd1g9ksg8v7rdigihan68ikqyjpupk3ip2khrlhj9mcx' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpkahy38_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
