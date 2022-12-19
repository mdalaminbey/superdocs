<?php

namespace WpGuide\App\AdminPages;

use WpGuide\Bootstrap\Application;
use WpGuide\Bootstrap\View;
use WP_Query;

class Product
{
    public function boot()
    {
        $docs_post_type = wp_guide_docs_post_type();
        add_action( 'admin_url', [$this, 'admin_url'] );
        add_filter( 'pre_get_posts', [$this, 'pre_get_posts'] );
        add_filter( "views_edit-{$docs_post_type}", [$this, 'post_counter'] );
        add_action( 'admin_footer', [$this, 'admin_footer'] );
        add_filter( "manage_edit-{$docs_post_type}_columns", [$this, 'custom_column'] );
        add_action( "manage_{$docs_post_type}_posts_custom_column", [$this, 'custom_column_value'], 10, 2 );
        add_action( 'quick_edit_custom_box', [$this, 'quick_edit_box'], 10, 3 );
    }

    public function quick_edit_box( string $column_name )
    {
        if ( 'template' === $column_name ) {
            global $wpdb;
            $templates = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}posts WHERE post_type = %s AND post_status = 'publish'", wp_guide_template_post_type() ) );
            View::render( 'admin/pages/products/quick-view', compact( 'templates' ) );
        }
    }

    public function custom_column( array $columns ): array
    {
        $array = [
            'cb'       => $columns['cb'],
            'title'    => $columns['title'],
            'template' => esc_html__( 'Template', 'wp-guide' )
        ];
        return array_merge( $array, $columns );
    }

    public function custom_column_value( $column, $post_id )
    {
        switch ( $column ) {
            case 'template':
                $template_id   = get_post_meta( $post_id, 'wp-guide-template', true );
                $template_post = get_post( $template_id );
                if ( $post_id != $template_post->ID ) {
                    echo "<div class='wp-guide-template' data-template='" . wp_json_encode( ['id' => $template_post->ID, 'title' => $template_post->post_title] ) . "'>";
                    echo $template_post->post_title;
                    echo "</div>";
                }
                break;
        }
    }

    public function post_counter( array $views )
    {
        $counts      = wp_guide_docs_count( Application::$config['post_types']['docs'], 'wp-guide-product', 'product' );
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
        View::render( 'admin/pages/products/footer' );
    }
}
