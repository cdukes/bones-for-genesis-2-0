/* globals module, bfg_script_srcs, bfg_scripts_loading, bfg_scripts_loaded, bfg_scripts_events_queue */

// Make sure all globals are set, but don't overwrite if they are
window.bfg_script_srcs = window.bfg_script_srcs || {};
window.bfg_scripts_loading = window.bfg_scripts_loading || [];
window.bfg_scripts_loaded = window.bfg_scripts_loaded || [];
window.bfg_scripts_events_queue = window.bfg_scripts_events_queue || {};

(function() {
	'use strict';

	function on_load(e) {
		let el = e.currentTarget,
			handle = el.dataset.handle;

		bfg_scripts_loaded.push(handle);

		for (let i = 0; i < bfg_scripts_events_queue[handle].length; i++) {
			bfg_scripts_events_queue[handle][i]();
		}
	}

	function load_script(handle, event) {
		let script;

		// Abort if handle isn't set in bfg_script_srcs
		if (!bfg_script_srcs.hasOwnProperty(handle)) {
			return;
		}

		// If already loaded, trigger event now
		if (bfg_scripts_loaded.indexOf(handle) > -1) {
			if (event) {
				event();
			}

			return;
		}

		// If loading, add event to queue
		if (bfg_scripts_loading.indexOf(handle) > -1) {
			if (event) {
				bfg_scripts_events_queue[handle].push(event);
			}

			return;
		}

		// Otherwise, start loading and build queue
		script = document.createElement(`script`);
		script.async = false;
		script.dataset.handle = handle;
		document.head.appendChild(script);
		script.onload = on_load;

		bfg_scripts_loading.push(handle);
		bfg_scripts_events_queue[handle] = [];

		if (event) {
			bfg_scripts_events_queue[handle].push(event);
		}

		script.src = bfg_script_srcs[handle];
	}

	module.exports = load_script;
})();
