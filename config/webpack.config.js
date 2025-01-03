/* globals module, require, __dirname */

const webpack = require( `webpack` ),
	path = require( `path` ),
	{ VueLoaderPlugin } = require( `vue-loader` ),
	MiniCssExtractPlugin = require( `mini-css-extract-plugin` );

module.exports = ( env, argv ) => {
	const config = {
		entry: {
			scripts: `./js/scripts.js`,
			admin: `./js/admin.js`,

			'style-css': `./sass/style.scss`,
			'admin-css': `./sass/admin.scss`
		},
		output: {
			path: path.resolve( __dirname, `../build` ),
			filename: argv.mode === `production` ? `js/[name].min.js` : `js/[name].js`,
			chunkFilename: argv.mode === `production` ? `js/[id].[contenthash].min.js` : `js/[id].js`
		},
		resolve: {
			alias: {
				ajax$: path.resolve( __dirname, `../js/_partials/_ajax.js` )
			}
		},
		optimization: {
			minimize: argv.mode === `production`
		},
		plugins: [
			new webpack.DefinePlugin( {
				__VUE_OPTIONS_API__: JSON.stringify( false ),
				__VUE_PROD_DEVTOOLS__: JSON.stringify( argv.mode !== `production` )
			} ),
			new VueLoaderPlugin(),
			new MiniCssExtractPlugin( {
				filename: pathData => {
					const slug = pathData.chunk.name.replace( `-css`, `` );

					return argv.mode === `production` ? `css/${slug}.min.css` : `css/${slug}.css`;
				}
			} )
		],
		module: {
			rules: [
				{
					test: /\.vue$/,
					exclude: /(node_modules)/,
					use: {
						loader: `vue-loader`
					}
				},
				{
					test: /(?<!\.vue)\.(s?[ac]ss)$/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader
						}
					]
				},
				{
					test: /\.vue\.(s?[ac]ss)$/,
					use: [
						{
							loader: `vue-style-loader`
						}
					]
				},
				{
					test: /\.(sa|sc|c)ss$/,
					use: [
						{
							loader: `css-loader`,
							options: {
								url: false
							}
						},
						{
							loader: `postcss-loader`,
							options: {
								postcssOptions: {
									plugins: {
										autoprefixer: {
											cascade: true,
											flexbox: false
										}
									}
								}
							}
						},
						{
							loader: `sass-loader`,
							options: {
								api: `modern`
							}
						}
					]
				}
			]
		},
		node: false,
		watch: argv.mode !== `production`,
		stats: `errors-warnings`
	};

	return config;
};
