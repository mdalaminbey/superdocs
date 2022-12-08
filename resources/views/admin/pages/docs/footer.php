<script>
	(function($) {
		$('.type-<?php wp_commander_render( wp_guide_docs_post_type() )?> .row-title').each((index, element) => {
			element.innerHTML = element.innerHTML.replaceAll('— ', '');
			$(element).closest('strong').html($(element).closest('strong a').prop("outerHTML"))
		})
		$('.type-<?php wp_commander_render( wp_guide_docs_post_type() )?>').each((index, element) => {
			element.innerHTML = element.innerHTML.replaceAll('— ', '');
			$(element).closest('strong').html($(element).closest('strong a').prop("outerHTML"))
		});

		$('.inline-edit-wrapper .inline-edit-col-right .inline-edit-col').append($('.inline-edit-wrapper .wp-guide-product').html())
		$('.inline-edit-wrapper .wp-guide-product').remove()
	})(jQuery)
</script>