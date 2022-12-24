<div class="super-docs-product">
	<div class="inline-edit-group wp-clearfix">
		<label class="inline-edit-status alignleft">
			<span class="title"><?php esc_html_e( 'SuperDocs Template', 'super-docs' )?></span>
			<select name="super-docs-template">
				<option value="0"><?php esc_html_e( "-- Select Template --", "super-docs" )?></option>
				<?php foreach ( $templates as $template ) {?>
					<option value="<?php wp_commander_render($template->ID) ?>"><?php wp_commander_render($template->post_title) ?></option>
				<?php }?>
			</select>
		</label>
	</div>
</div>