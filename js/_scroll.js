import SmoothScroll from 'smooth-scroll';

(function() {
	const ss = new SmoothScroll(
		`a[href*="#"]`,
		{
			speed: 150,
			offset: 8,
			easing: `easeInCubic`,
			emitEvents: false
		}
	);

	if( location.hash.length > 1 ) {
		const selector = location.hash.replace(`#`, ``);
		const el = document.getElementById(selector);

		if( el ) {
			ss.animateScroll(
				el
			);
		}
	}
})();
