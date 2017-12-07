module.exports = {
	entry: {
		scripts: './js/scripts.js',
		admin: './js/admin.js',
	},
	output: {
		filename: 'build/js/[name].js',
		chunkFilename: 'build/js/[id].js'
	},
	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: 'vue-loader',
				options: {
					loaders: {
						js: 'babel-loader?presets[]=env'
					}
				}
			},
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['env']
					}
				}
			}
		]
	}
}