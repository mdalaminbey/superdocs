const path = require('path');

const defaultConfig = require('@wordpress/scripts/config/webpack.config');

const js = {
	...defaultConfig,
	entry: {
		'widgets': './resources/js/widgets.js',
		'admin/docs': './resources/js/admin/docs.js',
		'admin/template': './resources/js/admin/template.js',
	},
	output: {
		path: path.resolve(__dirname, './assets/js/'),
		filename: '[name].js',
		clean: false
	}
}

const scss = {
	...defaultConfig,
	entry: {
		'widgets': './resources/sass/widgets.scss',
		'app': './resources/sass/app.scss',
	},
	output: {
		path: path.resolve(__dirname, './assets/css/'),
		clean: false
	},
	module: {
		...defaultConfig.module,
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.css$/i,
				use: ['style-loader', 'css-loader', 'postcss-loader'],
			},
		],
	}
};

module.exports = [scss, js];
