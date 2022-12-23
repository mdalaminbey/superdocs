<?php

use DoatKolom\Ui\Utils\Common;
use WpGuide\Bootstrap\View;

$dataKey = Common::generateRandomString(10);

?>

<div class="p-7" x-data="<?php echo $dataKey?>">
  <h2 class="line-clamp-1 dark:text-navy-100 text-xl font-bold tracking-wide text-slate-700 lg:text-base"><?php esc_html_e('Create Category')?></h2>
  <hr class="mt-2" />
  <div class="mt-4">
    <form action="" method="post" @submit.prevent="sendCategoryCreateRequest($data)">
		<input type="hidden" name="productId" value="<?php wp_commander_render($productId)?>">
      <div class="mb-5">
        <label class="block">
          <span class="text-base"><?php esc_html_e('Category Name', 'wp-guide')?>:</span>
          <input name="categoryName" required class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-1.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary" placeholder="Category Name" type="text" />
        </label>
      </div>
      <button class="btn mt-2 cursor-pointer rounded-md bg-success py-2 px-8 font-semibold text-white hover:bg-success-hover focus:bg-success-hover active:bg-success-hover/90">Submit</button>
    </form>
  </div>
</div>
<script>
	Alpine.data('<?php wp_commander_render( $dataKey )?>', () => ({
		sendCategoryCreateRequest($data) {
			var modal = Alpine.store('DoatKolomUiModal');
			var form = this.$el;
			var jqueryForm = jQuery(form);
			var formSubmitButton = form.querySelector('button');
			formSubmitButton.disabled = true;
			formSubmitButton.classList.remove('cursor-pointer');
			jQuery.ajax({
				url: "<?php wp_commander_render( get_rest_url( null, 'wp-guide/category/create' ) )?>",
				method: 'POST',
				beforeSend: function(xhr) {
					xhr.setRequestHeader( 'X-WP-Nonce', "<?php wp_commander_render(wp_create_nonce('wp_rest'))?>" );
				},
				data: jqueryForm.serialize(),
				success: function(data) {
					modal.getCategories.accordions.push(data);
				},
				complete: function() {
					modal.changeStatus();
					formSubmitButton.disabled = false;
					formSubmitButton.classList.add('cursor-pointer');
					jqueryForm[0].reset();
  					<?php View::render( 'admin/pages/category/sortjs', ['productId' => $productId] );?>
				}
			})
		}
	}));
</script>