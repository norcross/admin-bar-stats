<?php
/**
 * Define all the various datasets we have.
 *
 * @package AdminBarStats
 */

// Declare our namespace.
namespace Norcross\AdminBarStats\Datasets;

// Set our aliases.
use Norcross\AdminBarStats as Core;
use Norcross\AdminBarStats\Helpers as Helpers;

/**
 * Start our engines.
 */
add_filter( Core\HOOK_PREFIX . 'wp_default_dataset', __NAMESPACE__ . '\add_wp_menu_items' );
add_filter( Core\HOOK_PREFIX . 'php_default_dataset', __NAMESPACE__ . '\add_php_menu_items' );
add_filter( Core\HOOK_PREFIX . 'db_default_dataset', __NAMESPACE__ . '\add_db_menu_items' );
add_filter( Core\HOOK_PREFIX . 'server_default_dataset', __NAMESPACE__ . '\add_server_menu_items' );

/**
 * Define and return the parent items.
 *
 * @return array
 */
function get_parent_item_dataset() {

	// Set up our default args.
	$setup_data = [
		'wp' => [
			'label' => __( 'Items related to the WordPress install', 'admin-bar-stats' ),
			'title' => __( 'WordPress', 'admin-bar-stats' ),
		],
		'php' => [
			'label' => __( 'Items related to the current PHP configuration', 'admin-bar-stats' ),
			'title' => __( 'PHP', 'admin-bar-stats' ),
		],
		'db' => [
			'label' => __( 'Items related to the current DB setup and configuration', 'admin-bar-stats' ),
			'title' => __( 'Database', 'admin-bar-stats' ),
		],
		'server' => [
			'label' => __( 'Items related to the current server setup and configuration', 'admin-bar-stats' ),
			'title' => __( 'Server', 'admin-bar-stats' ),
		],
	];

	// Return the array.
	return apply_filters( Core\HOOK_PREFIX . 'parent_item_dataset', $setup_data );
}

/**
 * Add items for the main WordPress menu item.
 *
 * @param  array $menu_items  The existing menu items. Should be none.
 *
 * @return array
 */
function add_wp_menu_items( $menu_items ) {

	// We need this for the version.
	global $wp_version;

	// Set up our default args.
	$setup_data = [
		'wp-version' => [
			'label' => __( 'This is the version of WordPress you are currently running', 'admin-bar-stats' ),
			'title' => __( 'Version', 'admin-bar-stats' ),
			'data'  => $wp_version,
		],
		'dev-mode' => [
			'label' => __( 'This is the development mode constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'Development Mode', 'admin-bar-stats' ),
			'data'  => wp_get_development_mode(),
		],
		'env-type' => [
			'label' => __( 'This is the environment type constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'Environment Type', 'admin-bar-stats' ),
			'data'  => wp_get_environment_type(),
		],
		'wp-debug' => [
			'label' => __( 'This is the WP_DEBUG constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'WP_DEBUG', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'WP_DEBUG' ),
		],
		'wp-debug-display' => [
			'label' => __( 'This is the WP_DEBUG_DISPLAY constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'WP_DEBUG_DISPLAY', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'WP_DEBUG_DISPLAY' ),
		],
		'wp-debug-log' => [
			'label' => __( 'This is the WP_DEBUG_LOG constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'WP_DEBUG_LOG', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'WP_DEBUG_LOG' ),
		],
		'script-debug' => [
			'label' => __( 'This is the SCRIPT_DEBUG constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'SCRIPT_DEBUG', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'SCRIPT_DEBUG' ),
		],
		'wp-cache' => [
			'label' => __( 'This is the WP_CACHE constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'WP_CACHE', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'WP_CACHE' ),
		],
		'concat-scripts' => [
			'label' => __( 'This is the CONCATENATE_SCRIPTS constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'CONCATENATE_SCRIPTS', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'CONCATENATE_SCRIPTS' ),
		],
		'compress-scripts' => [
			'label' => __( 'This is the COMPRESS_SCRIPTS constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'COMPRESS_SCRIPTS', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'COMPRESS_SCRIPTS' ),
		],
		'compress-css' => [
			'label' => __( 'This is the COMPRESS_CSS constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'COMPRESS_CSS', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'COMPRESS_CSS' ),
		],
		'wp-env-type' => [
			'label' => __( 'This is the WP_ENVIRONMENT_TYPE constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'WP_ENVIRONMENT_TYPE', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'WP_ENVIRONMENT_TYPE' ),
		],
		'wp-dev-mode' => [
			'label' => __( 'This is the WP_DEVELOPMENT_MODE constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'WP_DEVELOPMENT_MODE', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'WP_DEVELOPMENT_MODE' ),
		],
		'wp-file-edit' => [
			'label' => __( 'This is the DISALLOW_FILE_EDIT constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DISALLOW_FILE_EDIT', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'DISALLOW_FILE_EDIT' ),
		],
		'wp-file-mods' => [
			'label' => __( 'This is the DISALLOW_FILE_MODS constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DISALLOW_FILE_MODS', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'DISALLOW_FILE_MODS' ),
		],
		'wp-auto-update' => [
			'label' => __( 'This is the AUTOMATIC_UPDATER_DISABLED constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'AUTOMATIC_UPDATER_DISABLED', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'AUTOMATIC_UPDATER_DISABLED' ),
		],
	];

	// Add items if this is multisite.
	if ( is_multisite() ) {

		// The sunrise constant.
		$setup_data['wp-ms-sunrise'] = [
			'label' => __( 'This is the SUNRISE constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'SUNRISE', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'SUNRISE' ),
		];

		// The subdomain constant.
		$setup_data['wp-ms-subdomain'] = [
			'label' => __( 'This is the SUBDOMAIN_INSTALL constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'SUBDOMAIN_INSTALL', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'SUBDOMAIN_INSTALL' ),
		];

		// @todo: add any others that are relevant.
	}

	// If the WP-VIP file exists, add some items.
	if ( file_exists( WP_CONTENT_DIR . '/vip-config/vip-config.php' ) ) {

		// The environment type constant.
		$setup_data['wp-vip-env-type'] = [
			'label' => __( 'This is the VIP_GO_APP_ENVIRONMENT constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'VIP_GO_APP_ENVIRONMENT', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'VIP_GO_APP_ENVIRONMENT' ),
		];

		// The vaultpress constant.
		$setup_data['wp-vip-vaultpress'] = [
			'label' => __( 'This is the VIP_VAULTPRESS_SKIP_LOAD constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'VIP_VAULTPRESS_SKIP_LOAD', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'VIP_VAULTPRESS_SKIP_LOAD' ),
		];

		// @todo: add any others that are relevant.
	}

	// If Jetpack is active, add some items.
	if ( defined( 'JETPACK__VERSION' ) ) {

		// The version constant.
		$setup_data['wp-jp-vers'] = [
			'label' => __( 'This is the JETPACK__VERSION constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'JETPACK__VERSION', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'JETPACK__VERSION' ),
		];

		// The debug constant.
		$setup_data['wp-jp-debug'] = [
			'label' => __( 'This is the JETPACK_DEV_DEBUG constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'JETPACK_DEV_DEBUG', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'JETPACK_DEV_DEBUG' ),
		];

		// The staging constant.
		$setup_data['wp-jp-staging'] = [
			'label' => __( 'This is the JETPACK_STAGING_MODE constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'JETPACK_STAGING_MODE', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'JETPACK_STAGING_MODE' ),
		];

		// @todo: add any others that are relevant.
	}

	// Return the array.
	return apply_filters( Core\HOOK_PREFIX . 'wp_dataset', $setup_data );
}

/**
 * Add items for the main PHP menu item.
 *
 * @param  array $menu_items  The existing menu items. Should be none.
 *
 * @return array
 */
function add_php_menu_items( $menu_items ) {

	// Set up our default args.
	$setup_data = [
		'php-version' => [
			'label' => __( 'This is the version of PHP you are currently running', 'admin-bar-stats' ),
			'title' => __( 'Version', 'admin-bar-stats' ),
			'data'  => phpversion(),
		],
		'php-sapi' => [
			'label' => __( 'This is the type of Server Application Programming Interface you have', 'admin-bar-stats' ),
			'title' => __( 'SAPI', 'admin-bar-stats' ),
			'data'  => php_sapi_name(),
		],
	];

	// Return the array.
	return apply_filters( Core\HOOK_PREFIX . 'php_dataset', $setup_data );
}

/**
 * Add items for the main database menu item.
 *
 * @param  array $menu_items  The existing menu items. Should be none.
 *
 * @return array
 */
function add_db_menu_items( $menu_items ) {

	// Set up our default args.
	$setup_data = [
		'db-name' => [
			'label' => __( 'This is the DB_NAME constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DB_NAME', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'DB_NAME' ),
		],
		'db-user' => [
			'label' => __( 'This is the DB_USER constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DB_USER', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'DB_USER' ),
		],
		'db-password' => [
			'label' => __( 'This is the DB_PASSWORD constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DB_PASSWORD', 'admin-bar-stats' ),
			'data'  => '',
		],
		'db-host' => [
			'label' => __( 'This is the DB_HOST constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DB_HOST', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'DB_HOST' ),
		],
		'db-charset' => [
			'label' => __( 'This is the DB_CHARSET constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'DB_CHARSET', 'admin-bar-stats' ),
			'data'  => Helpers\format_bool_constant( 'DB_CHARSET' ),
		],
	];

	// Return the array.
	return apply_filters( Core\HOOK_PREFIX . 'db_dataset', $setup_data );
}

/**
 * Add items for the main server menu item.
 *
 * @param  array $menu_items  The existing menu items. Should be none.
 *
 * @return array
 */
function add_server_menu_items( $menu_items ) {

	// Get the server data.
	$srvr_args  = Helpers\format_server_data();

	// Bail if none exist.
	if ( empty( $srvr_args ) ) {
		return false;
	}

	// Set up our default args.
	$setup_data = [
		'srv-software' => [
			'label' => __( 'This is what type of server software you are currently running', 'admin-bar-stats' ),
			'title' => __( 'Software', 'admin-bar-stats' ),
			'data'  => $srvr_args['software'],
		],
		'srv-version' => [
			'label' => __( 'This is the server software version you are currently running', 'admin-bar-stats' ),
			'title' => __( 'Version', 'admin-bar-stats' ),
			'data'  => $srvr_args['version'],
		],
		'srv-server-ip' => [
			'label' => __( 'This is the server IP address of the server', 'admin-bar-stats' ),
			'title' => __( 'Server IP', 'admin-bar-stats' ),
			'data'  => $srvr_args['server-ip'],
		],
		'srv-remote-ip' => [
			'label' => __( 'This is the remote IP address of the server', 'admin-bar-stats' ),
			'title' => __( 'Remote IP', 'admin-bar-stats' ),
			'data'  => $srvr_args['remote-ip'],
		],
		'srv-basic-auth' => [
			'label' => __( 'Whether or not basic auth is set up', 'admin-bar-stats' ),
			'title' => __( 'Basic Auth', 'admin-bar-stats' ),
			'data'  => $srvr_args['basic-auth'],
		],
	];

	// Return the array.
	return apply_filters( Core\HOOK_PREFIX . 'server_dataset', $setup_data );
}
