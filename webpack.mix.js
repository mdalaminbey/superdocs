const mix = require('laravel-mix');

require('mix-tailwindcss');

const parent_selector = '.superdocs'

mix.sass('resources/sass/app.scss', 'assets/css', {}, [{
	postcss: function (root) {
		root.nodes.map(node => {
			if (node.selectors !== undefined) {
				node.selectors = node.selectors.map((selector, index) => {
					return parent_selector + ' ' + selector;
				})
			}
			return node;
		})
		return root;
	}
}]).tailwind();

mix.sass('resources/sass/widgets.scss', 'assets/css');
mix.js('resources/js/widgets.js', 'assets/js');
mix.js('resources/js/admin/docs.js', 'assets/js/admin');
mix.js('resources/js/admin/template.js', 'assets/js/admin');