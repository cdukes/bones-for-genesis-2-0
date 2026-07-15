<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Look up a password against the Pwned Passwords API and add a WP_Error
 * when it's been seen too many times to be considered safe.
 *
 * @param string   $password The plaintext password to check.
 * @param WP_Error $errors   Error object to append to on failure.
 *
 * @return void
 */
function bfg_validate_pwned_password($password, $errors) {

	if( !( $errors instanceof WP_Error ) )
		return;

	$hash        = mb_strtoupper( sha1( $password ) );
	$hash_prefix = mb_substr( $hash, 0, 5 );
	$hash_suffix = mb_substr( $hash, 5 );

	$response = wp_remote_get( 'https://api.pwnedpasswords.com/range/' . $hash_prefix, array(
		'timeout' => 5,
		'headers' => array(
			'Add-Padding' => 'true',
		),
	) );

	// If the API is unreachable, fail open rather than blocking account creation/password changes.
	if( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 )
		return;

	$body        = wp_remote_retrieve_body( $response );
	$occurrences = 0;

	foreach( explode( "\r\n", mb_trim( $body ) ) as $line ) {

		list( $suffix, $count ) = array_pad( explode( ':', $line ), 2, 0 );

		if( mb_strtoupper( mb_trim( $suffix ) ) === $hash_suffix ) {
			$occurrences = (int) $count;

			break;
		}

	}

	/**
	 * Number of times a password may appear in the Pwned Passwords dataset
	 * before it's rejected. Set to 0 to reject on any match.
	 *
	 * @since 20260723
	 */
	$threshold = apply_filters( 'bfg_pwned_password_threshold', 0 );

	if( $occurrences > $threshold )
		$errors->add( 'bfg_pwned_password', __( '<strong>Error</strong>: That password has appeared in a known data breach and can\'t be used. Please choose a different password.', CHILD_THEME_TEXT_DOMAIN ) );

}

/**
 * Reject passwords that have appeared in known data breaches, per the "Have I Been Pwned" API.
 * Hooked into the profile update, password reset, and registration flows below.
 *
 * @see https://haveibeenpwned.com/API/v3#PwnedPasswords
 * @since 20260723
 *
 * @param WP_Error $errors Error object to append to on failure.
 * @param bool     $update Whether this is an existing user being updated.
 * @param WP_User  $user   The user object being updated.
 *
 * @return void
 */
add_action( 'user_profile_update_errors', 'bfg_check_pwned_password_profile_update', 10, 3 );
add_action( 'validate_password_reset', 'bfg_check_pwned_password_reset', 10, 2 );
add_filter( 'registration_errors', 'bfg_check_pwned_password_registration', 10, 3 );
function bfg_check_pwned_password_profile_update($errors, $update, $user) {

	if( empty( $_POST['pass1'] ) )
		return;

	bfg_validate_pwned_password( $_POST['pass1'], $errors );

}

/**
 * @see bfg_check_pwned_password_profile_update()
 *
 * @param WP_Error $errors Error object to append to on failure.
 * @param WP_User  $user   The user object resetting their password.
 *
 * @return void
 */
function bfg_check_pwned_password_reset($errors, $user) {

	if( empty( $_POST['pass1'] ) )
		return;

	bfg_validate_pwned_password( $_POST['pass1'], $errors );

}

/**
 * @see bfg_check_pwned_password_profile_update()
 *
 * @param WP_Error $errors               Error object to append to on failure.
 * @param string   $sanitized_user_login The submitted username.
 * @param string   $user_email           The submitted email address.
 *
 * @return WP_Error The error object, potentially with a new error added.
 */
function bfg_check_pwned_password_registration($errors, $sanitized_user_login, $user_email) {

	if( empty( $_POST['user_pass'] ) )
		return $errors;

	bfg_validate_pwned_password( $_POST['user_pass'], $errors );

	return $errors;

}
