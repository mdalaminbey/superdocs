<?php

namespace WpGuide\App\Providers;

use WpCommander\Contracts\ServiceProvider;

class CptServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'init', [$this, 'init'] );
    }

    public function init()
    {
        register_post_type( 'wpguidedocs', $this->docs_cpt_args() );
        register_post_type( 'wpguidetemplate', $this->layout_cpt_args() );
    }

    public function docs_cpt_args()
    {
        $label         = esc_html__( 'All Docs', 'wp-guide' );
        $singular_name = esc_html__( 'Doc', 'wp-guide' );

        if ( is_admin() ) {;
            if ( wp_commander_is_admin_page( 'edit', ['post_type' => 'wpguidedocs', 'product' => 'true'] ) ) {
                $label         = esc_html__( 'Products', 'wp-guide' );
                $singular_name = esc_html__( 'Product', 'wp-guide' );
            } elseif (
                wp_commander_is_admin_page( 'post', ['product' => 'true'] ) ||
                ( isset( $_GET['post'] ) && get_post_mime_type( sanitize_text_field( wp_unslash( $_GET['post'] ) ) ) === 'product' )
            ) {
                $label         = esc_html__( 'Products', 'wp-guide' );
                $singular_name = esc_html__( 'Product', 'wp-guide' );
            } elseif ( wp_commander_is_admin_page( 'post-new', ['product' => 'true'] ) ) {
                $label         = esc_html__( 'Products', 'wp-guide' );
                $singular_name = esc_html__( 'Product', 'wp-guide' );
            }
        }

        $labels = [
            'singular_name'         => $singular_name,
            'archives'              => esc_html__( 'Item Archives', 'wp-guide' ),
            'attributes'            => esc_html__( 'Item Attributes', 'wp-guide' ),
            'all_items'             => esc_html__( 'All Items', 'wp-guide' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'wp-guide' ),
            'add_new'               => esc_html__( 'Add New', 'wp-guide' ),
            'new_item'              => esc_html__( 'New Item', 'wp-guide' ),
            'edit_item'             => esc_html__( 'Edit Item', 'wp-guide' ),
            'update_item'           => esc_html__( 'Update Item', 'wp-guide' ),
            'view_item'             => esc_html__( 'View Item', 'wp-guide' ),
            'view_items'            => esc_html__( 'View Items', 'wp-guide' ),
            'search_items'          => esc_html__( 'Search Item', 'wp-guide' ),
            'not_found'             => esc_html__( 'Not found', 'wp-guide' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wp-guide' ),
            'featured_image'        => esc_html__( 'Featured Image', 'wp-guide' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'wp-guide' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'wp-guide' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'wp-guide' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'wp-guide' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'wp-guide' ),
            'items_list'            => esc_html__( 'Items list', 'wp-guide' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'wp-guide' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'wp-guide' )
        ];
        return [
            'label'               => $label,
            'taxonomies'          => [],
            'labels'              => $labels,
            'rewrite'             => ['slug' => 'docs'],
            'supports'            => ['title', 'editor', 'author'],
            'taxonomies'          => [],
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'menu_position'       => 5,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'hierarchical'        => true,
            'exclude_from_search' => false,
            'show_in_rest'        => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'page'
        ];
    }
    public function layout_cpt_args()
    {
        return [
            'label'               => esc_html__( 'Templates', 'textdomain' ),
            'description'         => esc_html__( '', 'textdomain' ),
            'supports'            => [],
            'taxonomies'          => [],
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'menu_position'       => 5,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'hierarchical'        => false,
            'exclude_from_search' => false,
            'show_in_rest'        => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'post'
        ];
    }
}
