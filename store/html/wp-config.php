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
define('DB_NAME', 'cktnswn0100');

/** MySQL database username */
define('DB_USER', 'cktnswn0100');

/** MySQL database password */
define('DB_PASSWORD', 'cktnswn12');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'ltzncSyRIJF]9x8<}bL@$6#$-k,bbSz;@7AO4cpTv+@]GsF;Z|.rR=`t|DW{1TB7');
define('SECURE_AUTH_KEY',  'PR3.5v|klJQnEgT ZVxqzj23Ellono9VC([-q2o[L+Bhsy,2`&X0+O>kJ:V}W.Up');
define('LOGGED_IN_KEY',    'ao#+^U}j3Ka7|S;uX+. dEFK>s2^$%6(MOS.(2K0Ie:,boOj;-z~wM$M1[)o(,Bh');
define('NONCE_KEY',        '^/}<7~Tj&FnWuws73sG.peTp!W?{r<SswC4#X.q.WQarln_[r_lMT-&i=Mn5X.ez');
define('AUTH_SALT',        'P4bgQ[hN.4EEm4-GUzR[s5l]_o}uN${NunyJ6uess(G2 ISO9qk|5a}iwnwc;&-s');
define('SECURE_AUTH_SALT', '?E{m;-ueBIo#O&%lV0hv1<;W]-1^=Ib.Kn>)b&|$osre9ey9rGiwK,]=>!`ruyB&');
define('LOGGED_IN_SALT',   'bnkk}l/JcB#Z;U6|{Dca$=Vyz3OS+s]yRMxi7v_O#|6tYdbjf0SS?4E)nNOF[2af');
define('NONCE_SALT',       '|TYx|CF=EZ9=^JOw9De0RD0,c1DU3[&4c_=IDK}2P1XU-a|#I?!wE<ilQ<]ZeC%b');

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
$_SERVER['SERVER_SOFTWARE']='Apache';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
