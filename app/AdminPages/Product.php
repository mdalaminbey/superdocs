<?php

namespace WpGuide\App\AdminPages;

use WP_Query;

class Product
{
    public function boot()
    {
        add_action( 'admin_url', [$this, 'admin_url'] );
        add_filter( 'pre_get_posts', [$this, 'pre_get_posts'] );
        add_filter( 'views_edit-wpguidedocs', [$this, 'post_counter'] );
        add_action( 'admin_footer', [$this, 'admin_footer'] );
    }

    public function post_counter( array $views )
    {
        $counts      = wp_guide_docs_count( 'wpguidedocs', 'wp-guide-product', 'product' );
        $all         = $counts->publish + $counts->future + $counts->draft + $counts->pending + $counts->private + $counts->trash;
        $counts->all = $all;
        foreach ( $views as $key => $view ) {
            $view_part   = explode( '<span class="count">', $view );
            $final_view  = $view_part[0] . '<span class="count">(' . $counts->$key . ')</span></a>';
            $views[$key] = $final_view;
        }
        return $views;
    }

    public function pre_get_posts( WP_Query $query ): WP_Query
    {
        $query->set( 'meta_query', [[
            'key'     => 'wp_guide_product',
            'compare' => 'EXISTS'
        ]] );
        return $query;
    }

    public function admin_url( string $url )
    {
        return wp_commander_url_add_params( $url, ['product' => 'true'] );
    }

	public function admin_footer()
	{
		?>
		<script>
			(function($) {
				let menus = $('#toplevel_page_wp-guide-menu li');
				$(menus[1]).removeClass('current');
				$(menus[2]).addClass('current');
				$('.wrap .subsubsub a').each((index, element) => {
					element = $(element);
					element.attr('href', element.attr('href') + '&product=true')
				})
				$('#posts-filter').append("<input type='hidden' name='product' value='true'>");
				$('.tablenav-pages a').each((index, element) => {
					element = $(element);
					element.attr('href', element.attr('href') + '&product=true')
				})
			})(jQuery)
		</script>
		<?php
	}
}
