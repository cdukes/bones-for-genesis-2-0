// @codekit-prepend "FitVids.js/jquery.fitvids.js";
// @codekit-prepend "iOS-Orientationchange-Fix/ios-orientationchange-fix.js";


jQuery(document).ready(function($) {
	// Remove the 'no-js' <body> class
	$('body').removeClass('no-js');

	// Enable FitVids on the content area
	$("#content").fitVids();
});