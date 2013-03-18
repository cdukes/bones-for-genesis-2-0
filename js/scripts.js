// @codekit-prepend "vendor/ios-orientationchange-fix.js";
// @codekit-prepend "vendor/fitvids.jquery.js";

var $ = jQuery.noConflict();

$("#content").fitVids();


// Modernizr.load to load scripts for older browsers
Modernizr.load([
	{
    // If the browser doesn't support border-radius ()
    test : Modernizr.borderradius,
    // then load this script
    nope : []
	}

	/*
	for a list of supported Modernizr tests, view the docs:
	http://www.modernizr.com/docs/#s2
	for a full chart of what browsers support what, check out this link:
	http://www.findmebyip.com/litmus/
	*/
]);