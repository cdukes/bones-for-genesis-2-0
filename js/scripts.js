// @codekit-prepend "iOS-Orientationchange-Fix/ios-orientationchange-fix.js";
// @codekit-prepend "FitVids.js/jquery.fitvids.js";
// @codekit-prepend "svgeezy/svgeezy.js";

jQuery(document).ready(function($) {
	// Remove the 'no-js' <body> class
	$('body').removeClass('no-js');

	// Enable FitVids on the content area
	$('.content').fitVids();

	// SVG fallbacks
	svgeezy.init( 'svg-no-check', 'png' );
});