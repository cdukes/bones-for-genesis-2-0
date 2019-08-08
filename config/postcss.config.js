/* globals module, require */

module.exports = {
	map: false,
	plugins: [
		require(`postcss-import`),
		require(`postcss-assets`),
		require(`postcss-focus`),
		require(`postcss-will-change`),
		require(`rfs`),
		require(`autoprefixer`)({
			cascade: true,
			flexbox: false
		})
	]
};