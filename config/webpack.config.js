const path = require(`path`);
const { VueLoaderPlugin } = require(`vue-loader`);

module.exports = (env, argv) => {
	let config = {
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
		plugins: [
			new VueLoaderPlugin()
		],
		module: {
			rules: [
				{
					test: /\.vue$/,
					exclude: /(node_modules)/,
					use: {
						loader: `vue-loader`
					}
				}
			]
		},
		performance: {
			hints: false
		},
		node: false
	};

	if( `production` === argv.mode ) {
		config.module.rules.push(
			{
				test: /\.js$/,
				exclude: /(node_modules)/,
				use: {
					loader: `babel-loader`,
					options: {
						presets: [`@babel/preset-env`]
					}
				}
			}
		);
	}

	return config;
};