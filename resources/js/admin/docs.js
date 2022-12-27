jQuery(function ($) {
	$('#the-list').on('click', '.editinline', function () {
		var product = $(this).closest('tr').find('.superdocs-template');
		
		if(product.attr('data-template') !== undefined) {
			var data_attr = JSON.parse(product.attr('data-template'));
			$('select[name="superdocs-template"] option[value="' + data_attr.id + '"]').attr('selected', 'selected');
		}

		var product = $(this).closest('tr').find('.superdocs-product');

		if(product.attr('data-product') !== undefined) {
			var data_attr = JSON.parse(product.attr('data-product'));
			$('select[name="productId"] option[value="' + data_attr.id + '"]').attr('selected', 'selected');
		}
	});
});