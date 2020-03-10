/* globals module, require */

module.exports = {
	map: false,
	plugins: [
		require(`postcss-focus`),
		require(`rfs`),
		require(`autoprefixer`)({
			cascade: true,
			flexbox: false
		})
	]
};
