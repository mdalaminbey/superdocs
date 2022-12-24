
(function ($, elementor) {
	var elementor = window.elementorFrontend;
	var SuperDocsUtils = {
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

	var SuperDocs = {
		init: function () {
			var widgets = {
				'super-docs-doc-search.default': SuperDocs.docSearch,
				'super-docs-doc-print.default': SuperDocs.docPrint,
				'super-docs-doc-categories.default': SuperDocs.categories,
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
					url: wpCommanderLocale.rest + 'super-docs/search',
					method: 'POST',
					data: formData,
					complete(data) {
						$('body').addClass('super-docs-search-open');
						$scope.find('.loader-body').hide();
						resultArea.html(data.responseText);
						if (resultArea.is(":hidden")) {
							resultArea.slideToggle(250);
						}
					}
				})
			}

			let searchInput = $scope.find('input[name="s"]');
			searchInput.keyup(SuperDocsUtils.debounce(search, 500));

			$scope.find('.normal-search-form').submit(function (event) {
				event.preventDefault();
				search()
			});

			$(document).on('click', '.super-docs-search-open', function (e) {
				if ($(e.target).parents('.super-docs-doc-search').length > 0) {
					return;
				}
				resultArea.slideToggle(250);
				$('body').removeClass('super-docs-search-open');
			});
		},
		docPrint: function ($scope) {
			$scope.find('.super-docs-print').on('click', function () {
				let data = JSON.parse($scope.attr('data-settings'));
				if ('full_window' === data.doc_print_content_area) {
					window.print()
				} else {
					let html = document.querySelector("div[data-widget_type='super-docs-doc-content.default']").outerHTML;
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

	$(window).on('elementor/frontend/init', SuperDocs.init);
	$(window).on('elementor/frontend/init', function () {
		let tableOfContent = $('.super-docs-table-of-content ol');
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