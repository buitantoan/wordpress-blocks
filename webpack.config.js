const path = require('path');
const glob = require('glob');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

module.exports = {
	...defaultConfig,
	entry: {
		blocks: path.resolve( __dirname, 'src/blocks.js' ),
		dashboard: path.resolve( __dirname, 'src/dashboard.js' ),
	},
	output: {
		path: path.resolve(__dirname, 'build'),
		// filename: '[name].js',
	},
};