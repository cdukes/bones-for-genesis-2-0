/* eslint compat/compat:0 */

/* globals bfg_icons_src */

import { load_script } from './_loader.js';

(function() {
	// Test for inline SVG support, based on Modernizr
	function supports_inline_svg() {
		const div = document.createElement(`div`);
		div.innerHTML = `<svg/>`;
		return (
			(typeof SVGRect !== `undefined` &&
				div.firstChild &&
				div.firstChild.namespaceURI) === `http://www.w3.org/2000/svg`
		);
	}

	function setup() {
		if( !(`fetch` in window) ) {
			return;
		}

		fetch(bfg_icons_src)
			.then(response => {
				if (response.status !== 200) {
					throw Error(`File not found`);
				}

				return response.text();
			})
			.then(response => {
				const div = document.createElement(`div`);
				div.innerHTML = response;
				div.style.position = `absolute`;
				div.style.width = 0;
				div.style.height = 0;
				div.style.overflow = `hidden`;

				document.body.insertBefore(div, document.body.childNodes[0]);

				if (!supports_inline_svg()) {
					load_script(`svgxuse`);
				}

				document.body.classList.remove(`no-svg`);
			});
	}

	setup();
})();
