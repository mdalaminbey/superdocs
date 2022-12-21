jQuery(function ($) {
	$('.submenu-link').on('click', function () {
		var $submenu = $(this).closest('.submenu');
		var $docs = $submenu.find('.documents');
		var $un_collapse = $submenu.find('.un_collapse');
		var $collapse = $submenu.find('.collapse');
		if ($docs.is(":hidden")) {
			$un_collapse.show();
			$collapse.hide();
		} else {
			$un_collapse.hide();
			$collapse.show();
		}
		$docs.slideToggle(250);
	});

	$(window).on('elementor/frontend/init', function () {
		let tableOfContent = $('.wp-guide-table-of-content ol');
		tableOfContent.html('');
		$('.elementor-heading-title').each(function () {
			let tags = ['H1', 'H2', 'H3', 'H4', 'H5', 'H6'];
			let tag = $(this);
			if (tags.includes(tag.prop("tagName"))) {
				tableOfContent.append('<li>' + tag.html() + '</li>');
			}
		})
		// elementorFrontend.hooks.addAction('frontend/element_ready/wp-guide-table-of-content.default', function ($scope) {
		// 	console.log($scope)
		// });
	});
});