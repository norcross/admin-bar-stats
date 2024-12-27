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

/**
 * Start our engines.
 */
add_filter( Core\HOOK_PREFIX . 'wp_default_dataset', __NAMESPACE__ . '\add_wp_menu_items' );

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
		'version' => [
			'label' => __( 'This is the version of WordPress you are currently running', 'admin-bar-stats' ),
			'title' => __( 'Version', 'admin-bar-stats' ),
			'data'  => $wp_version,
		],
		'env-type' => [
			'label' => __( 'This is the environment type constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'Environment Type', 'admin-bar-stats' ),
			'data'  => wp_get_environment_type(),
		],
	];

	// This was introduced in WP 6.3.
	if ( function_exists( 'wp_get_development_mode' ) ) {
		$setup_data['dev-mode'] = [
			'label' => __( 'This is the development mode constant if it has been defined.', 'admin-bar-stats' ),
			'title' => __( 'Development Mode', 'admin-bar-stats' ),
			'data'  => wp_get_development_mode(),
		];
	}

	// Return the array.
	return apply_filters( Core\HOOK_PREFIX . 'wp_dataset', $setup_data );
}
