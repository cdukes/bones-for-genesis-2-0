// import im from '../node_modules/include-media-export/include-media.js';
import fitvids from '../node_modules/fitvids/dist/fitvids.js';

import './_svgs.js';

(function() {
	// Remove the 'no-js' <body> class
	document.body.classList.remove(`no-js`);

	// Enable FitVids on the content area
	fitvids(`.content`);
})();
