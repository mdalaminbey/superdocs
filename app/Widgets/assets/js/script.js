
(function ($, elementor) {
	var elementor = window.elementorFrontend;
	var WpGuideUtils = {
		debounce(func, delay) {
			let debounceTimer
			return function () {
				const context = this
				const args = arguments
				clearTimeout(debounceTimer)
				debounceTimer = setTimeout(() => func.apply(context, args), delay)
			}
		}
	}

	var WpGuide = {
		init: function () {
			var widgets = {
				'wp-guide-doc-search.default': WpGuide.docSearch,
				'wp-guide-doc-print.default': WpGuide.docPrint,
				'wp-guide-doc-categories.default': WpGuide.categories,
			}
			$.each(widgets, function (widget, callback) {
				elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			});
		},
		categories($scope) {
			$scope.find('.submenu-link').on('click', function () {
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
		},
		docSearch($scope) {
			let resultArea = $scope.find('.result-body');
			let search = function (s) {
				let formData = $scope.find('form').serialize();
				$scope.find('.loader-body').show();
				$.ajax({
					url: wpCommanderLocale.rest + 'wp-guide/search',
					data: formData,
					complete(data) {
						$('body').addClass('wp-guide-search-open');
						$scope.find('.loader-body').hide();
						resultArea.html(data.responseText)
						var el = document.querySelector('.result-body');
						SimpleScrollbar.initEl(el);
					}
				})
			}

			let searchInput = $scope.find('input[name="s"]');
			searchInput.keyup(WpGuideUtils.debounce(search, 500));

			$scope.find('.normal-search-form').submit(function (event) {
				event.preventDefault();
				search()
			});

			$(document).on('click', '.wp-guide-search-open', function (e) {
				if ($(e.target).parents('.wp-guide-doc-search').length > 0) {
					return;
				}
				resultArea.html('');
				$('body').removeClass('wp-guide-search-open');
			});
		},
		docPrint: function ($scope) {
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
		}
	}

	$(window).on('elementor/frontend/init', WpGuide.init);
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
	});
}(jQuery, window.elementorFrontend));