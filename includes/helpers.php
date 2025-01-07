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

	// Grab all the server data.
	$fetch_srv_data = filter_input_array( INPUT_SERVER, FILTER_SANITIZE_SPECIAL_CHARS );

	// Set the empties.
	$setup_software = '';
	$setup_version  = '';

	// Parse and add it.
	if ( ! empty( $fetch_srv_data['SERVER_SOFTWARE'] ) ) {

		// Build the array.
		$build_srv_data = explode( ' ', wp_unslash( $fetch_srv_data['SERVER_SOFTWARE'] ) );
		$clean_srv_data = explode( '/', reset( $build_srv_data ) );

		// And define the variables.
		$setup_software = $clean_srv_data[0];
		$setup_version  = $clean_srv_data[1];
	}

	// Return each part.
	return [
		'software'   => $setup_software,
		'version'    => $setup_version,
		'server-ip'  => $fetch_srv_data['SERVER_ADDR'],
		'remote-ip'  => $fetch_srv_data['REMOTE_ADDR'],
		'basic-auth' => wp_is_site_protected_by_basic_auth() ? 'true' : 'false',
	];
}
