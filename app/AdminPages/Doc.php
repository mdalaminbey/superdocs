<?php

namespace WpGuide\App\AdminPages;

use WP_Query;

class Doc
{
	public function boot()
	{
		add_action( 'restrict_manage_posts', [ $this, 'filter' ] );
		add_filter( 'views_edit-wpguidedocs', [$this, 'post_counter'] );
		add_filter( 'pre_get_posts', [$this, 'pre_get_posts'] );
		add_filter( 'manage_edit-wpguidedocs_columns', [$this, 'custom_column'] );
		add_action( 'manage_wpguidedocs_posts_custom_column', [$this, 'custom_column_value'], 10, 2 );
		add_action( 'quick_edit_custom_box', [$this, 'quick_edit_box'], 10, 3 );
		add_action( 'admin_footer', [$this, 'admin_footer'] );
	}

	public function filter()
	{
		global $wpdb;
		$products   = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'wpguidedocs' AND post_status = 'publish' AND post_mime_type = 'product'" );
		$product_id = isset($_GET['filter-by-product']) ? intval($_GET['filter-by-product']) : 0;
		?>
		<div class="alignleft actions">
			<select name="filter-by-product" id="filter-by-product">
				<option value="0">All Products</option>
				<?php foreach ( $products as $product ) {?>
				<option <?php selected($product->ID, $product_id, true)?> value="<?php echo $product->ID ?>"><?php echo $product->post_title ?></option>
				<?php }?>
			</select>
		</div>
		<?php
	}

	public function pre_get_posts( WP_Query $query )
	{	
		if(!empty($_GET['filter-by-product'])) {
			$query->set('post_parent', intval($_GET['filter-by-product']));
		}

		$query->set( 'meta_query', [[
			'key'     => 'wp_guide_product',
			'compare' => 'NOT EXISTS'
		]] );
		return $query;
	}

	public function custom_column( array $columns ): array
	{
		$array = [
			'cb'      => $columns['cb'],
			'title'   => $columns['title'],
			'product' => esc_html__( 'Product', 'wp-guide' )
		];
		return array_merge( $array, $columns );
	}

	public function custom_column_value( $columns, $post_id )
	{
		$parent_post = get_post( get_post( $post_id )->post_parent );
		if ( $parent_post->ID != $post_id ) {
			echo $parent_post->post_title;
		}
	}

	public function quick_edit_box( string $column_name )
	{
		if ( 'product' === $column_name ) {
			global $wpdb;
			$products = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}posts WHERE post_type = 'wpguidedocs' AND post_status = 'publish' AND post_mime_type = 'product'" );
		?>
		<div class="wp-guide-product inline-edit-group wp-clearfix">
			<label class="inline-edit-status alignleft">
				<span class="title"><?php esc_html_e( 'Product', 'wp-guide' )?></span>
				<select name="post_parent">
					<option value="0"><?php esc_html_e( "Main Page (no product)", "wp-guide" )?></option>
					<?php foreach ( $products as $product ) {?>
						<option value="<?php echo $product->ID ?>"><?php echo $product->post_title ?></option>
					<?php }?>
				</select>
			</label>
		</div>
	<?php }
	}

	public function post_counter( array $views )
	{
		$counts      = wp_guide_docs_count( 'wpguidedocs', 'wp-guide-doc', 'doc' );
		$all         = $counts->publish + $counts->future + $counts->draft + $counts->pending + $counts->private + $counts->trash;
		$counts->all = $all;
		foreach ( $views as $key => $view ) {
			$view_part   = explode( '<span class="count">', $view );
			$final_view  = $view_part[0] . '<span class="count">(' . $counts->$key . ')</span></a>';
			$views[$key] = $final_view;
		}
		return $views;
	}

	public function admin_footer()
	{ ?>
	<script>
		(function($) {
			$('.type-wpguidedocs .row-title').each((index, element) => {
				element.innerHTML = element.innerHTML.replaceAll('— ', '');
				$(element).closest('strong').html($(element).closest('strong a').prop("outerHTML"))
			})
			$('.type-wpguidedocs').each((index, element) => {
				element.innerHTML = element.innerHTML.replaceAll('— ', '');
				$(element).closest('strong').html($(element).closest('strong a').prop("outerHTML"))
			});

			$('.inline-edit-wrapper .inline-edit-col-right .inline-edit-col').append($('.inline-edit-wrapper .wp-guide-product').html())
			$('.inline-edit-wrapper .wp-guide-product').remove()
		})(jQuery)
	</script>
	<?php
	}
}
