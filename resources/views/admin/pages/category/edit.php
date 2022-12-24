<?php

use DoatKolom\Ui\Utils\Common;

$dataKey             = Common::generateRandomString( 10 );
$categoryPost        = get_post( $categoryPostId );
$categoryParentClass = 'superdocs_product_' . $productId;
?>

<div class="p-7" x-data="<?php wp_commander_render($dataKey) ?>">
  <h2 class="line-clamp-1 dark:text-navy-100 text-xl font-bold tracking-wide text-slate-700 lg:text-base"><?php esc_html_e('Edit Category', 'superdocs')?></h2>
  <hr class="mt-2" />
  <div class="mt-4">
    <form action="" method="post" @submit.prevent="updateCategory($data)">
		<input type="hidden" name="productId" value="<?php wp_commander_render( $productId )?>">
		<input type="hidden" name="categoryPostId" value="<?php wp_commander_render( $categoryPostId )?>">
      <div class="mb-5">
        <label class="block">
          <span class="text-base"><?php esc_html_e( 'Category Name', 'superdocs' )?>:</span>
          <input name="categoryName" value="<?php wp_commander_render( $categoryPost->post_title )?>" required class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" placeholder="Category Name" type="text" />
        </label>
      </div>
      <button class="btn mt-2 cursor-pointer rounded-md bg-success py-2 px-8 font-semibold text-white hover:bg-success-hover focus:bg-success-hover active:bg-success-hover/90"><?php esc_html_e('Sumbit', 'superdocs')?></button>
    </form>
  </div>
</div>
<script>
	Alpine.data('<?php wp_commander_render( $dataKey )?>', () => ({
		updateCategory($data) {
			var modal = Alpine.store('DoatKolomUiModal');
			var form = this.$el;
			var jqueryForm = jQuery(form);
			var formSubmitButton = form.querySelector('button');
			formSubmitButton.disabled = true;
			formSubmitButton.classList.remove('cursor-pointer');
			jQuery.ajax({
				url: "<?php wp_commander_render( get_rest_url( null, 'superdocs/category/update' ) )?>",
				method: 'POST',
				beforeSend: function(xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', "<?php wp_commander_render( wp_create_nonce( 'wp_rest' ) )?>" );
				},
				data: jqueryForm.serialize(),
				success: function(data) {
					let categoryContent = document.querySelector('[data-category="<?php wp_commander_render( $categoryPostId )?>"]');
					let ChildNo = DoatKolomUiUtils.getChildNo(categoryContent.closest('.accordionItem'), categoryContent.closest('.<?php wp_commander_render($categoryParentClass) ?>'));
					modal.getCategories.accordions[ChildNo - 1].title = data.data.categoryName
				},
				complete: function() {
					modal.changeStatus()
				}
			})
		}
	}));
</script>