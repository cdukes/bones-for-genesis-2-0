jQuery(document).ready(function($) {

	// Remove the 'no-js' <body> class
	$('body').removeClass('no-js');

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
});