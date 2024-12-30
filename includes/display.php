<?php
/**
 * Handle the items used on the actual display.
 *
 * @package AdminBarStats
 */

// Declare our namespace.
namespace Norcross\AdminBarStats\Display;

// Set our aliases.
use Norcross\AdminBarStats as Core;

/**
 * Start our engines.
 */
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\load_admin_bar_css' );
add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\load_admin_bar_css' );

/**
 * Load some basic CSS for the admin bar.
 *
 * @return void
 */
function load_admin_bar_css() {

	// Don't try to load the CSS without an admin bar.
	if ( ! is_admin_bar_showing() ) {
		return;
	}

	// Set my CSS up.
	$admin_bar_css  = '
		#wpadminbar #wp-admin-bar-admin-bar-stats-main > .ab-item::before {
			content: "\f311";
			font-size: 16px;
			padding: 8px 0;
		}

		#wp-admin-bar-admin-bar-stats-main span.abs-display-menu-item {
			display: inline-block;
			vertical-align: middle;
			width: auto;
		}

		#wp-admin-bar-admin-bar-stats-main span.abs-display-menu-item.abs-display-item-title {
			width: 220px;
			color: #c3c4c7;
		}

		#wp-admin-bar-admin-bar-stats-main span.abs-display-menu-item.abs-display-item-data {
		}

		span.abs-display-title-green {
			color: #8c8 !important;
		';

	// And add the CSS.
	wp_add_inline_style( 'admin-bar', $admin_bar_css );
}
