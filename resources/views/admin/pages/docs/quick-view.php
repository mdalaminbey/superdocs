<div class="super-docs-product">
	<div class="inline-edit-group wp-clearfix">
		<label class="inline-edit-status alignleft">
			<span class="title"><?php esc_html_e( 'Product', 'super-docs' )?></span>
			<select name="productId">
				<option value="0"><?php esc_html_e( "Main Page (no product)", "super-docs" )?></option>
				<?php foreach ( $products as $product ) {?>
					<option value="<?php wp_commander_render($product->ID) ?>"><?php wp_commander_render($product->post_title) ?></option>
				<?php }?>
			</select>
		</label>
	</div>
	<div class="inline-edit-group wp-clearfix">
		<label class="inline-edit-status alignleft">
			<span class="title"><?php esc_html_e( 'SuperDocs Template', 'super-docs' )?></span>
			<select name="super-docs-template">
				<option value="0"><?php esc_html_e( "Product Default", "super-docs" )?></option>
				<?php foreach ( $templates as $template ) {?>
					<option value="<?php wp_commander_render($template->ID) ?>"><?php wp_commander_render($template->post_title) ?></option>
				<?php }?>
			</select>
		</label>
	</div>
</div>