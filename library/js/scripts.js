/*
Bones for Genesis Scripts File
Author: Your Name Here

This file should contain any js scripts you want to add to the site.
You can add it in the Genesis admin too, but sometimes that can
get a bit jumbled and it's tough once you have a lot going on.
Use this file to better manage your scripts.

*/

// Modernizr.load to load scripts for older browsers
Modernizr.load([
	{
    // If the browser doesn't support border-radius ()
    test : Modernizr.borderradius,
    // then load this script
    nope : ['libs/selectivizr-min.js']
	}
	
	/* 
	for a list of supported Modernizr tests, view the docs:
	http://www.modernizr.com/docs/#s2
	for a full chart of what browsers support what, check out this link:
	http://www.findmebyip.com/litmus/ 
	*/
]);

// as the page loads, cal these scripts
$(document).ready(function() {
	
	// put add all your scripts here (they will be loaded in the FOOTER)

 
}); /* end of as page load scripts */