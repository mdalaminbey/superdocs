jQuery(function ($) {
	$('#the-list').on('click', '.editinline', function () {
		var product = $(this).closest('tr').find('.wp-guide-product');
		var data_attr = JSON.parse(product.attr('data-template'));
		$('select[name="wp-guide-template"] option[value="' + data_attr.id + '"]').attr('selected', 'selected');
	});
});
