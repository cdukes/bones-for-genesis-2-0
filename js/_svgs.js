(function() {
	'use strict';

	// Test for inline SVG support, based on Modernizr
	function supports_inline_svg() {
		var div = document.createElement('div');
		div.innerHTML = '<svg/>';
		return (
			(typeof SVGRect !== 'undefined' &&
				div.firstChild &&
				div.firstChild.namespaceURI) === 'http://www.w3.org/2000/svg'
		);
	}

	function setup() {
		fetch(bfg_icons_src)
			.then(function(response) {
				if (200 !== response.status) {
					throw 'File not found';
				}

				return response.text();
			})
			.then(function(response) {
				var div = document.createElement('div');
				div.innerHTML = response;
				div.style.position = 'absolute';
				div.style.width = 0;
				div.style.height = 0;
				div.style.overflow = 'hidden';

				document.body.insertBefore(div, document.body.childNodes[0]);

				if (!supports_inline_svg()) {
					bfg_inject_script(
						'https://cdn.jsdelivr.net/gh/Keyamoon/svgxuse/svgxuse.min.js'
					);
				}

				document.body.classList.remove('no-svg');
			});
	}

	setup();
})();
