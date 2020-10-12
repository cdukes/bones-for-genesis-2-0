/* globals module, require, __dirname */

const path = require(`path`),
	{ VueLoaderPlugin } = require(`vue-loader`),
	MiniCssExtractPlugin = require(`mini-css-extract-plugin`);

module.exports = (env, argv) => {
	const config = {
		entry: {
			scripts: `./js/scripts.js`,
			admin: `./js/admin.js`,

			'style-css': `./sass/style.scss`,
			'admin-css': `./sass/admin.scss`
		},
		output: {
			path: path.resolve(__dirname, `../build`),
			filename: argv.mode === `production` ? `js/[name].min.js` : `js/[name].js`,
			chunkFilename: argv.mode === `production` ? `js/[id].min.js` : `js/[id].js`
		},
		resolve: {
			alias: {
				ajax$: path.resolve(__dirname, `../js/_partials/_ajax.js`),
				loader$: path.resolve(__dirname, `../js/_partials/_loader.js`)
			}
		},
		optimization: {
			minimize: argv.mode === `production`
		},
		plugins: [
			new VueLoaderPlugin(),
			new MiniCssExtractPlugin({
				filename: pathData => {
					const slug = pathData.chunk.name.replace(`-css`, ``);

					return argv.mode === `production` ? `css/${slug}.min.css` : `css/${slug}.css`;
				}
			})
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
					test: /\.(sa|sc|c)ss$/,
					use: [
						{
							loader: MiniCssExtractPlugin.loader
						},
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
									plugins: [
										[
											`postcss-focus`
										],
										[
											`rfs`
										],
										[
											`autoprefixer`,
											{
												cascade: true,
												flexbox: false
											}
										]
									]
								}
							}
						},
						`sass-loader`
					]
				}
			]
		},
		node: false,
		watch: argv.mode !== `production`,
		stats: `errors-warnings`
	};

	if( argv.mode === `production` ) {
		config.module.rules.push(
			{
				test: /\.js$/,
				exclude: /(node_modules|admin)/,
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
