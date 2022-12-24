<?php

use DoatKolom\Ui\Utils\Common;
$dataKey             = Common::generateRandomString( 10 );
$categoryParentClass = 'superdocs_product_' . $productId;

?>

<div class="p-7" x-data="<?php wp_commander_render($dataKey) ?>">
  <h2 class="line-clamp-1 dark:text-navy-100 text-xl font-bold tracking-wide text-slate-700 lg:text-base">
  	<?php esc_html_e( 'Are you sure to delete this category?', 'superdocs' )?>
  </h2>
  <div class="mt-4">
    <p class="text-danger">
      <strong class="text-base">All Documents</strong> in this category will be <strong class="text-base">Deleted along</strong> with the category. If you don't want to delete those documents then rename the category or move the documents to another category
    </p>
  </div>
  <div class="mt-4">
    <button x-on:click="deleteCategory()" class="cursor-pointer font-semibold rounded-md px-7 py-3 text-white items-center bg-danger hover:bg-danger-hover">
      <?php esc_html_e( 'Delete', 'superdocs' )?>
    </button>
    <button x-on:click="cancelCategory()" class="cursor-pointer font-semibold rounded-md px-7 py-3 items-center border border-gray-200 bg-white hover:bg-gray-50">
      <?php esc_html_e( 'Cancel', 'superdocs' )?>
    </button>
  </div>
</div>
<script>
  Alpine.data('<?php wp_commander_render( $dataKey )?>', () => ({
    deleteCategory() {
      var modal = Alpine.store('DoatKolomUiModal');
      let docs = [];
      let categoryContent = document.querySelector('[data-category="<?php wp_commander_render( $categoryPostId )?>"]');
      for (let doc of categoryContent.children) {
        docs.push(doc.dataset.doc);
      }
      jQuery.ajax({
            url: "<?php wp_commander_render( get_rest_url( null, 'superdocs/category/delete' ) )?>",
            method: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader( 'X-WP-Nonce', "<?php wp_commander_render( wp_create_nonce( 'wp_rest' ) )?>" );
            },
            data: { docs, productId: '<?php wp_commander_render( $productId )?>', categoryPostId: '<?php wp_commander_render( $categoryPostId )?>' },
            complete: function() {
                let ChildNo = DoatKolomUiUtils.getChildNo(categoryContent.closest('.accordionItem'), categoryContent.closest('.<?php wp_commander_render($categoryParentClass) ?>'));
                delete modal.getCategories.accordions[ChildNo - 1];
                modal.changeStatus()
            }
        })
    },
    cancelCategory() {
        var modal = Alpine.store('DoatKolomUiModal');
        modal.changeStatus()
    }
  }))
</script>