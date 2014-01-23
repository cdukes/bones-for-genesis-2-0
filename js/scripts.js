// @codekit-prepend "../bower_components/iOS-Orientationchange-Fix/ios-orientationchange-fix.js";
// @codekit-prepend "../bower_components/jquery.fitvids/jquery.fitvids.js";
// @codekit-prepend "../bower_components/jquery-placeholder/jquery.placeholder.js";
// @codekit-prepend "../bower_components/svgeezy/svgeezy.js";
// @codekit-prepend "../bower_components/superfish/dist/js/superfish.js";

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