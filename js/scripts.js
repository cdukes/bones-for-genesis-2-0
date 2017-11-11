// import im from '../node_modules/include-media-export/include-media.js';
import fitvids from '../node_modules/fitvids/dist/fitvids.js';

import './_svgs.js';

(function() {
	// Remove the 'no-js' <body> class
	document.body.classList.remove(`no-js`);

	// Enable FitVids on the content area
	fitvids(`.content`);
})();

// https://hackernoon.com/removing-that-ugly-focus-ring-and-keeping-it-too-6c8727fefcd2
(function() {
	function on_first_tab(e) {
		if (e.keyCode === 9) {
			document.body.classList.add(`user-is-tabbing`);
			window.removeEventListener(`keydown`, on_first_tab);
		}
	}

	window.addEventListener(`keydown`, on_first_tab);
})();
