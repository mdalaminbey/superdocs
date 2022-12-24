<script>
	(function($) {
		let menus = $('#toplevel_page_super-docs-menu li');
		$(menus[1]).removeClass('current');
		$(menus[2]).addClass('current');
		$('.wrap .subsubsub a').each((index, element) => {
			element = $(element);
			element.attr('href', element.attr('href') + '&product=true')
		})
		$('#posts-filter').append("<input type='hidden' name='product' value='true'>");
		$('.tablenav-pages a').each((index, element) => {
			element = $(element);
			element.attr('href', element.attr('href') + '&product=true')
		})
		$('.inline-edit-wrapper .inline-edit-col-right .inline-edit-col').append($('.inline-edit-wrapper .super-docs-product').html())
		$('.inline-edit-wrapper .super-docs-product').remove()
	})(jQuery)
</script>
