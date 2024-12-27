<?php
/**
 * Plugin Name: Admin Bar Stats
 * Plugin URI:  https://github.com/norcross/admin-bar-stats
 * Description: Adds some basic server and WP stats to the admin bar
 * Version:     0.0.1
 * Author:      Andrew Norcross
 * Author URI:  https://andrewnorcross.com
 * Text Domain: admin-bar-stats
 * Domain Path: /languages
 * License:     MIT
 * License URI: https://opensource.org/licenses/MIT
 *
 * @package     AdminBarStats
 */

// Call our namepsace.
namespace Norcross\AdminBarStats;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define our version.
define( __NAMESPACE__ . '\VERS', '0.0.1' );

// Plugin root file.
define( __NAMESPACE__ . '\FILE', __FILE__ );

// Define our file base.
define( __NAMESPACE__ . '\BASE', plugin_basename( __FILE__ ) );

// Plugin Folder URL and directory.
define( __NAMESPACE__ . '\URL', plugin_dir_url( __FILE__ ) );
define( __NAMESPACE__ . '\DIR', plugin_dir_path( __FILE__ ) );

// Set a handful of prefixes.
define( __NAMESPACE__ . '\HOOK_PREFIX', 'abstats_' );

// Go and load our files.
require_once __DIR__ . '/includes/datasets.php';
require_once __DIR__ . '/includes/display.php';
require_once __DIR__ . '/includes/menu-items.php';
