<div class="alignleft actions">
	<select name="filter-by-product" id="filter-by-product">
		<option value="0">All Products</option>
		<?php foreach ( $products as $product ) {?>
		<option <?php selected($selected_product_id, $product->ID, true)?> value="<?php echo $product->ID ?>"><?php echo $product->post_title ?></option>
		<?php }?>
	</select>
</div>