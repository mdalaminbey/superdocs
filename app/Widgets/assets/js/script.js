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
		elementorFrontend.hooks.addAction('frontend/element_ready/wp-guide-doc-print.default', function ($scope) {
			$scope.find('.wp-guide-print').on('click', function () {
				let data = JSON.parse($scope.attr('data-settings'));
				if ('full_window' === data.doc_print_content_area) {
					window.print()
				} else {
					let html = document.querySelector("div[data-widget_type='wp-guide-doc-content.default']").outerHTML;
					let stylesheets = document.querySelectorAll('link[rel="stylesheet"], style');
					let myWindow = window.open('', 'PRINT', 'popup');

					myWindow.document.write('<html><head><title>' + document.title + '</title>');

					stylesheets.forEach(stylesheet => {
						myWindow.document.write(stylesheet.outerHTML);
					})

					myWindow.document.write('</head><body >');
					myWindow.document.write('<h1>' + document.title + '</h1>');
					myWindow.document.write(html);

					let scripts = document.querySelectorAll('link[rel="stylesheet"], style');
					scripts.forEach(stylesheet => {
						myWindow.document.write(stylesheet.outerHTML);
					})

					myWindow.document.write('</body></html>');
					myWindow.document.close(); // necessary for IE >= 10
					myWindow.focus(); // necessary for IE >= 10*/

					myWindow.print();
					myWindow.close();

				}
			})
		});
	});
});