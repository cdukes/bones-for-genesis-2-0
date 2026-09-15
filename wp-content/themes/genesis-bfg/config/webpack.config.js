const webpack = require(`webpack`),
	path = require(`path`),
	{ VueLoaderPlugin } = require(`vue-loader`),
	MiniCssExtractPlugin = require(`mini-css-extract-plugin`),
	RemoveEmptyScriptsPlugin = require(`webpack-remove-empty-scripts`);

module.exports = (env, argv) => {
	const isProduction = `production` === argv.mode;

	const styleLoaders = [
		{
			loader: `css-loader`,
			options: {
				url: false,
			},
		},
		{
			loader: `postcss-loader`,
			options: {
				postcssOptions: {
					plugins: {
						autoprefixer: {
							cascade: true,
							flexbox: false,
						},
					},
				},
			},
		},
		{
			loader: `sass-loader`,
			options: {
				api: `modern`,
				sassOptions: {
					style: isProduction ? `compressed` : `expanded`,
				},
			},
		},
	];

	const config = {
		entry: {
			scripts: `./js/scripts.js`,
			admin: `./js/admin.js`,

			'style-css': `./sass/style.scss`,
			'admin-css': `./sass/admin.scss`,
		},
		output: {
			path: path.resolve(__dirname, `../build`),
			filename: isProduction ? `js/[name].min.js` : `js/[name].js`,
			chunkFilename: isProduction ? `js/[id].[contenthash].min.js` : `js/[id].js`,
			clean: {
				keep: /svgs\//,
			},
		},
		cache: {
			type: `filesystem`,
			buildDependencies: {
				config: [__filename],
			},
		},
		optimization: {
			minimize: isProduction,
		},
		performance: {
			maxAssetSize: 300000,
			maxEntrypointSize: 300000,
		},
		devtool: isProduction ? `hidden-source-map` : `eval-cheap-module-source-map`,
		plugins: [
			new webpack.DefinePlugin({
				__VUE_OPTIONS_API__: JSON.stringify(false),
				__VUE_PROD_DEVTOOLS__: JSON.stringify(!isProduction),
				__VUE_PROD_HYDRATION_MISMATCH_DETAILS__: JSON.stringify(!isProduction),
			}),
			new VueLoaderPlugin(),
			new RemoveEmptyScriptsPlugin(),
			new MiniCssExtractPlugin({
				filename: (pathData) => {
					const slug = pathData.chunk.name.replace(`-css`, ``);

					return isProduction ? `css/${slug}.min.css` : `css/${slug}.css`;
				},
			}),
		],
		module: {
			rules: [
				{
					test: /\.vue$/,
					use: {
						loader: `vue-loader`,
					},
				},
				{
					test: /\.(s?[ac]ss)$/,
					oneOf: [
						{
							test: /\.vue\.(s?[ac]ss)$/,
							use: [`vue-style-loader`, ...styleLoaders],
						},
						{
							use: [MiniCssExtractPlugin.loader, ...styleLoaders],
						},
					],
				},
			],
		},
		watch: !isProduction,
		stats: `errors-warnings`,
	};

	return config;
};
