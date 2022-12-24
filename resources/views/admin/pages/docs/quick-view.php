<div class="wp-guide-product">
	<div class="inline-edit-group wp-clearfix">
		<label class="inline-edit-status alignleft">
			<span class="title"><?php esc_html_e( 'Product', 'wp-guide' )?></span>
			<select name="productId">
				<option value="0"><?php esc_html_e( "Main Page (no product)", "wp-guide" )?></option>
				<?php foreach ( $products as $product ) {?>
					<option value="<?php wp_commander_render($product->ID) ?>"><?php wp_commander_render($product->post_title) ?></option>
				<?php }?>
			</select>
		</label>
	</div>
	<div class="inline-edit-group wp-clearfix">
		<label class="inline-edit-status alignleft">
			<span class="title"><?php esc_html_e( 'Wp Guide Template', 'wp-guide' )?></span>
			<select name="wp-guide-template">
				<option value="0"><?php esc_html_e( "Product Default", "wp-guide" )?></option>
				<?php foreach ( $templates as $template ) {?>
					<option value="<?php wp_commander_render($template->ID) ?>"><?php wp_commander_render($template->post_title) ?></option>
				<?php }?>
			</select>
		</label>
	</div>
</div>