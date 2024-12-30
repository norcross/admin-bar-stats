<?php
/**
 * Handle the admin bar menu items.
 *
 * @package AdminBarStats
 */

// Declare our namespace.
namespace Norcross\AdminBarStats\MenuItems;

// Set our aliases.
use Norcross\AdminBarStats as Core;
use Norcross\AdminBarStats\Datasets as Datasets;

/**
 * Start our engines.
 */
add_action( 'admin_bar_menu', __NAMESPACE__ . '\load_admin_bar_items', 999 );

/**
 * Add our primary and secondary admin bar items.
 *
 * @param  WP_Admin_Bar $wp_admin_bar  The global WP_Admin_Bar object.
 *
 * @return void.
 */
function load_admin_bar_items( \WP_Admin_Bar $wp_admin_bar ) {

	// Get our parent items first.
	$parent_menu_items  = Datasets\get_parent_item_dataset();

	// Bail without any actual menu items.
	if ( empty( $parent_menu_items ) ) {
		return;
	}

	// Add the top-level menu.
	$wp_admin_bar->add_node(
		[
			'id'       => 'admin-bar-stats-main',
			'title'    => __( 'Stats', 'admin-bar-stats' ),
			'parent'   => '',
			'meta'     => [
				'title'    => __( 'Site Stats', 'admin-bar-stats' ),
			],
		]
	);

	// Set an empty array for the parent IDs so we can use them later.
	$top_ids    = [];

	// Now add the parent level items we have.
	foreach ( $parent_menu_items as $parent_id => $parent_args ) {

		// Set the single ID.
		$set_single_id  = 'admin-bar-stats-' . $parent_id;

		// Add it to the array to check later.
		$top_ids[ $parent_id ] = $set_single_id;

		// Add each one using the args.
		$wp_admin_bar->add_node(
			[
				'id'       => $set_single_id,
				'title'    => wp_kses_post( $parent_args['title'] ),
				'parent'   => 'admin-bar-stats-main',
				'meta'     => [
					'title' => esc_attr( $parent_args['label'] ),
				],
			]
		);

		// Nothing left inside the parent item stuff.
	}

	// If we have no top IDs (weird, huh?) then we are done.
	if ( empty( $top_ids ) ) {
		return;
	}

	// Now loop each one and start looking for the kids.
	foreach ( $top_ids as $action_id => $menu_id ) {

		// Now attempt to fetch the children.
		$fetch_children = apply_filters( Core\HOOK_PREFIX . $action_id . '_default_dataset', [] );

		// Skip the rest if no child items exist.
		if ( empty( $fetch_children ) ) {

			// Remove the node we just made.
			$wp_admin_bar->remove_node( $menu_id );

			// And go to the next.
			continue;
		}

		// Now loop the kids.
		foreach ( $fetch_children as $child_id => $child_args ) {

			// Confirm the data exists.
			$confirm_data   = ! empty( $child_args['data'] ) ? $child_args['data'] : __( 'undefined', 'admin-bar-stats' );

			// Create our usable title.
			$display_title  = '<span class="abs-display-menu-item abs-display-item-title">' . esc_html( $child_args['title'] ) . '</span>';
			$display_title .= '<span class="abs-display-menu-item abs-display-item-data">' . esc_html( $confirm_data ) . '</span>';

			// Add each one using the args.
			$wp_admin_bar->add_node(
				[
					'id'       => 'admin-bar-stats-' . $child_id,
					'title'    => wp_kses_post( $display_title ),
					'parent'   => $menu_id,
					'meta'     => [
						'title' => esc_attr( $child_args['label'] ),
					],
				]
			);
		}

	}

	// Nothing left. Or is there?
}
