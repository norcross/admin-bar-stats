<?php
/**
 * Bundle in some helpers.
 *
 * @package AdminBarStats
 */

// Declare our namespace.
namespace Norcross\AdminBarStats\Helpers;

// Set our aliases.
use Norcross\AdminBarStats as Core;

/**
 * Checks a WP constant for the value and returns it. Took this from Query Monitor.
 *
 * @param  string $constant  The constant we are checking for.
 *
 * @return string            The value, or somethging else.
 */
function format_bool_constant( $constant ) {

	// This is just a bunch of if/else.
	if ( ! defined( $constant ) ) {
		/* translators: Undefined PHP constant */
		return __( 'undefined', 'admin-bar-stats' );
	} elseif ( constant( $constant ) === '' ) {
		return __( 'empty string', 'admin-bar-stats' );
	} elseif ( is_string( constant( $constant ) ) && ! is_numeric( constant( $constant ) ) ) {
		return constant( $constant );
	} elseif ( ! constant( $constant ) ) {
		return 'false';
	} else {
		return 'true';
	}
}

/**
 * Check the server type we are running and return it.
 *
 * @return array
 */
function format_server_data() {

	// Grab the variable.
	$fetch_srv_data = filter_input( INPUT_SERVER, 'SERVER_SOFTWARE', FILTER_SANITIZE_SPECIAL_CHARS );

	// Return two parts if unknown.
	if ( empty( $fetch_srv_data ) ) {
		return [
			'software' => 'unknown',
			'version'  => 'unknown',
		];
	}

	// Build the array.
	$build_srv_data = explode( ' ', wp_unslash( $fetch_srv_data ) );
	$clean_srv_data = explode( '/', reset( $build_srv_data ) );

	// Return each part.
	return [
		'software' => $clean_srv_data[0],
		'version'  => $clean_srv_data[1],
	];
}
