// Avoid `console` errors in browsers that lack a console.
// http://html5boilerplate.com/
(function() {
	var method;
	var noop = function () {};
	var methods = [
		'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
		'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
		'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
		'timeStamp', 'trace', 'warn'
	];
	var length = methods.length;
	var console = (window.console = window.console || {});

	while( length-- ) {
		method = methods[length];

		// Only stub undefined methods.
		if( !console[method] ) {
			console[method] = noop;
		}
	}
}());

jQuery(function($) {

	// Remove the 'no-js' <body> class
	$('html').removeClass('no-js');

	// Enable FitVids on the content area
	$('.content').fitVids();

	// SVG fallbacks
	svgeezy.init( 'svg-no-check', 'png' );

	// IE8 fallbacks
	// https://stackoverflow.com/questions/8890460/how-to-detect-ie7-and-ie8-using-jquery-support

	if( !$.support.leadingWhitespace ) {
		// Superfish for main navigation
		$('.menu-primary').superfish();
	}

	// Support for HTML5 placeholders
	$('input, textarea').placeholder();

	// Overwrite the Gravity Forms spinner.
	// They don't have a hook to change the HTML of the spinner, so we hide their spinner with CSS, then add our spinner's HTML by hooking into the form submit JS event
	$('[id^=gform_]').submit(function() {
		if( 0 === $(this).find('.spinner').length )
			$(this).find('.gform_ajax_spinner').after('<span class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></span>');
	});

	// Grunticon
	grunticon([grunticon_paths.svg, grunticon_paths.png, grunticon_paths.fallback]);

});
