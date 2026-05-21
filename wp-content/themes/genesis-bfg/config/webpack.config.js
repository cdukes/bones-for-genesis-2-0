const webpack = require( `webpack` ),
	path = require( `path` ),
	{ VueLoaderPlugin } = require( `vue-loader` ),
	MiniCssExtractPlugin = require( `mini-css-extract-plugin` );

module.exports = ( env, argv ) => {
	const isProduction = argv.mode === `production`;

	const config = {
		entry: {
			scripts: `./js/scripts.js`,
			admin: `./js/admin.js`,

			'style-css': `./sass/style.scss`,
			'admin-css': `./sass/admin.scss`
		},
		output: {
			path: path.resolve( __dirname, `../build` ),
			filename: isProduction ? `js/[name].min.js` : `js/[name].js`,
			chunkFilename: isProduction ? `js/[id].[contenthash].min.js` : `js/[id].js`,
			clean: {
				keep: /svgs\//
			}
		},
		cache: {
			type: `filesystem`,
			buildDependencies: {
				config: [__filename]
			}
		},
		resolve: {
			alias: {
				ajax$: path.resolve( __dirname, `../js/_partials/_ajax.js` )
			}
		},
		optimization: {
			minimize: isProduction
		},
		performance: {
			maxAssetSize: 300000
		},
		devtool: isProduction ? `source-map` : `eval-cheap-module-source-map`,
		plugins: [
			new webpack.DefinePlugin( {
				__VUE_OPTIONS_API__: JSON.stringify( false ),
				__VUE_PROD_DEVTOOLS__: JSON.stringify( !isProduction ),
				__VUE_PROD_HYDRATION_MISMATCH_DETAILS__: JSON.stringify( !isProduction )
			} ),
			new VueLoaderPlugin(),
			new MiniCssExtractPlugin( {
				filename: pathData => {
					const slug = pathData.chunk.name.replace( `-css`, `` );

					return isProduction ? `css/${slug}.min.css` : `css/${slug}.css`;
				}
			} )
		],
		module: {
			rules: [
				{
					test: /\.vue$/,
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
								api: `modern`,
								sassOptions: {
									silenceDeprecations: [`if-function`]
								}
							}
						}
					]
				}
			]
		},
		watch: !isProduction,
		stats: `errors-warnings`
	};

	return config;
};
