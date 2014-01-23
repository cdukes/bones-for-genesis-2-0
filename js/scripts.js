// @codekit-prepend "../bower_components/iOS-Orientationchange-Fix/ios-orientationchange-fix.js";
// @codekit-prepend "../bower_components/jquery.fitvids/jquery.fitvids.js";
// @codekit-prepend "../bower_components/svgeezy/svgeezy.js";
// @codekit-prepend "../bower_components/superfish/dist/js/superfish.js";

jQuery(document).ready(function($) {

	// Remove the 'no-js' <body> class
	$('body').removeClass('no-js');

	// Enable FitVids on the content area
	$('.content').fitVids();

	// SVG fallbacks
	svgeezy.init( 'svg-no-check', 'png' );

	// Superfish for main navigation
	$('.menu-primary').superfish();
});