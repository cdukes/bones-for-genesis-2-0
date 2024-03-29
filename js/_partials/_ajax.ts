/* globals ajaxurl */

/**
 * Sends an AJAX request to WP's admin-ajax.php endpoint
 * @param {Object} config - The configuration details for this request.
 * @param {string} config.action - The WP action hook that will be used on the server, wp_ajax_{action} or wp_ajax_nopriv_{action}.
 * @param {string} config.include_credentials - Whether to include the user's session in the request. If false, WP will hadle the request as if the user wasn't logged in.
 * @return {Object} config.data - Data to include in the request. You'll need to use json_decode(file_get_contents('php://input'), true) to retreive this data (https://stackoverflow.com/questions/18866571/receive-json-post-with-php)
 * @return {Function} config.on_success - Function to call if request is successful, as determined by the server's response code. Passes the JSON-decoded response.
 * @return {Function} config.on_error - Function to call if request is unsuccessful, as determined by the server's response code (or a failed request). Passes the error string.
 * @return {Function} config.on_complete - Function to call when request is completed, regardless of success or failure. Passes the JSON-decoded response or error string.
 */
export function ajax( config ) {
	const {
		action,
		include_credentials,
		data,
		on_success,
		on_error,
		on_complete
	} = config;

	const url = typeof ajaxurl === `string` ? ajaxurl : document.body.dataset.ajax_url;

	const params = new URLSearchParams();
	params.set( `action`, action );

	fetch(
		// The admin-ajax.php URL template is saved as a <body> data- value, in includes/structure/header.php
		`${url}?${params.toString()}`,
		{
			method: `POST`,
			credentials: include_credentials ? `same-origin` : `omit`,
			headers: {
				'Content-Type': `application/json`
			},
			body: JSON.stringify( data )
		}
	)
		.then( response => {
			// You should use wp_send_json_success( object ) and wp_send_json_error( string )

			// If status code is <200 or >299, throw an error with the response
			// This is likely a network issue
			if ( response.status < 200 || response.status > 299 ) {
				throw Error( response );
			}

			return response.json();
		} )
		.then( response => {
			// If response.success is false, trigger the failure function
			if ( !response.success ) {
				if ( on_error ) {
					on_error( response.data );
				}

				return response;
			}

			// Otherwise, trigger the success function, if set
			if ( on_success ) {
				on_success( response.data );
			}

			return response;
		} )
		.catch( response => {
			// Trigger the error function, if set, for a network/fetch failure or a JSON decoding issue
			if ( on_error ) {
				on_error( response );
			}

			return response;
		} )
		.then( response => {
			// Trigger the complete function, if set
			if ( on_complete ) {
				on_complete( response );
			}
		} );
}
