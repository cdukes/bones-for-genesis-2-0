import SmoothScroll from 'smooth-scroll';

(function() {
	let ss = new SmoothScroll(
		`a[href*="#"]`,
		{
			speed: 150,
			offset: 8,
			easing: `easeInCubic`,
			emitEvents: false
		}
	);

	if( location.hash.length > 1 ) {
		let selector = location.hash.replace(`#`, ``);
		let el = document.getElementById(selector);

		if( el ) {
			ss.animateScroll(
				el
			);
		}
	}
})();
