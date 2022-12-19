<?php

$docsParentClass     = 'wp_guide_product_content_' . $productId;
$categoryParentClass = 'wp_guide_product_' . $productId;
$sortMethod          = 'wp_guide_docs_sort_'. $productId;

?>
jQuery( function($) {
	var	<?php echo $sortMethod ?> = function(event, ui) {
		if(event.type === 'sortstop') {
			/**
			 * check if dragged is docs
			 */
			let draggedDocs = {};

			if(!ui.item[0].classList.contains('accordionItem')) {
				var category = ui.item[0].closest('.<?php echo $docsParentClass?>');
				draggedDocs  = { categoryPostId: category.dataset.category, docId: ui.item[0].dataset.doc };
			}

			let categoriesElement = document.querySelector(".<?php echo $categoryParentClass ?>");
			var categories = [];
			for (let category of categoriesElement.children) {
				var docsElement = category.querySelector('.<?php echo $docsParentClass ?>');
				if(docsElement) {
					var docs = [];
					for(let doc of docsElement.children) {
						docs.push(doc.dataset.doc);
					}
					categories.push({'categoryPostId': docsElement.dataset.category, docs});
				}
			}
			jQuery.ajax({
				url: "<?php wp_commander_render( get_rest_url( null, 'wp-guide/category/order' ) )?>",
				method: 'POST',
				beforeSend: function(xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', "<?php wp_commander_render( wp_create_nonce( 'wp_rest' ) )?>" );
				},
				data: {categories, draggedDocs, productId: '<?php echo $productId?>' }
			})
		}
	}

	/**
	 * Category sort
	 */
    var <?php echo $categoryParentClass ?> = $( ".<?php echo $categoryParentClass ?>" );
    <?php echo $categoryParentClass ?>.sortable({
        stop: <?php echo $sortMethod ?>,
		connectWith: ".<?php echo $categoryParentClass ?>"
    }).disableSelection();
    <?php echo $categoryParentClass ?>.on("sortchange",<?php echo $sortMethod ?>);

	/**
	 * Docs sort
	 */
    var <?php echo $docsParentClass ?> = $( ".<?php echo $docsParentClass ?>" );
    <?php echo $docsParentClass ?>.sortable({
        stop: <?php echo $sortMethod ?>,
		connectWith: ".<?php echo $docsParentClass ?>"
    }).disableSelection();
    <?php echo $docsParentClass ?>.on("sortchange",<?php echo $sortMethod ?>);
} );