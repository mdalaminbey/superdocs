<div class="wp-guide-product">
	<div class="inline-edit-group wp-clearfix">
		<label class="inline-edit-status alignleft">
			<span class="title"><?php esc_html_e( 'Wp Guide Template', 'wp-guide' )?></span>
			<select name="wp-guide-template">
				<option value="0"><?php esc_html_e( "-- Select Template --", "wp-guide" )?></option>
				<?php foreach ( $templates as $template ) {?>
					<option value="<?php echo $template->ID ?>"><?php echo $template->post_title ?></option>
				<?php }?>
			</select>
		</label>
	</div>
</div>