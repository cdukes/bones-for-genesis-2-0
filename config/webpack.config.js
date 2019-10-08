/* globals module, require, __dirname */

const path = require(`path`),
	{ VueLoaderPlugin } = require(`vue-loader`);

module.exports = (env, argv) => {
	const config = {
		entry: {
			scripts: `./js/scripts.js`,
			admin: `./js/admin.js`
		},
		output: {
			path: path.resolve(__dirname, `../build`),
			filename: `production` === argv.mode ? `js/[name].min.js` : `js/[name].js`,
			chunkFilename: `production` === argv.mode ? `js/[id].min.js` : `js/[id].js`
		},
		resolve: {
			alias: {
				ajax$: path.resolve(__dirname, `../js/_partials/_ajax.js`),
				loader$: path.resolve(__dirname, `../js/_partials/_loader.js`)
			}
		},
		optimization: {
			minimize: `production` === argv.mode
		},
		plugins: [
			new VueLoaderPlugin()
		],
		module: {
			rules: [
				{
					test: /\.tsx?$/,
					use: {
						loader: `ts-loader`,
						options: {
							transpileOnly: `production` !== argv.mode
						}
					}
				},
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