const path = require('path');

module.exports = {
	entry: {
		scripts: `./js/scripts.js`,
		admin: `./js/admin.js`
	},
	output: {
		path: path.resolve(__dirname, `../build`),
		filename: `js/[name].js`,
		chunkFilename: `js/[id].js`
	},
	optimization: {
		minimize: false
	},
	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: `vue-loader`,
				options: {
					loaders: {
						js: `babel-loader?presets[]=env`
					}
				}
			},
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: `babel-loader`,
					options: {
						presets: [`env`]
					}
				}
			}
		]
	}
};