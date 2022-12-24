<?php

namespace SuperDocs\App\Providers;

use WpCommander\Contracts\ServiceProvider;

class CptServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'init', [$this, 'init'] );
    }

    public function init()
    {
        register_post_type( super_docs_post_type(), $this->docs_cpt_args() );
        register_post_type( super_docs_template_post_type(), $this->layout_cpt_args() );
        register_taxonomy( super_docs_sidebar_taxonomy(), [super_docs_post_type()], [
            'label'             => __( 'Categories', 'super-docs' ),
            'hierarchical'      => false,
            'public'            => false,
            'show_admin_column' => false,
            'show_in_menu'      => false,
            'show_in_nav_menus' => false
        ] );
        // flush_rewrite_rules();
    }

    public function docs_cpt_args()
    {
        $label         = esc_html__( 'All Docs', 'super-docs' );
        $singular_name = esc_html__( 'Doc', 'super-docs' );

        if ( is_admin() ) {
            if ( wp_commander_is_admin_page( 'edit', ['post_type' => super_docs_post_type(), 'product' => 'true'] ) ) {
                $label         = esc_html__( 'Products', 'super-docs' );
                $singular_name = esc_html__( 'Product', 'super-docs' );
            } elseif (
                wp_commander_is_admin_page( 'post', ['product' => 'true'] ) ||
                ( isset( $_GET['post'] ) && get_post_mime_type( sanitize_text_field( wp_unslash( $_GET['post'] ) ) ) === 'product' ) //phpcs:ignore WordPress.Security.NonceVerification.Recommended
            ) {
                $label         = esc_html__( 'Products', 'super-docs' );
                $singular_name = esc_html__( 'Product', 'super-docs' );
            } elseif ( wp_commander_is_admin_page( 'post-new', ['product' => 'true'] ) ) {
                $label         = esc_html__( 'Products', 'super-docs' );
                $singular_name = esc_html__( 'Product', 'super-docs' );
            }
        }

        $labels = [
            'singular_name'         => $singular_name,
            'archives'              => esc_html__( 'Item Archives', 'super-docs' ),
            'attributes'            => esc_html__( 'Item Attributes', 'super-docs' ),
            'all_items'             => esc_html__( 'All Items', 'super-docs' ),
            'add_new_item'          => esc_html__( 'Add New Item', 'super-docs' ),
            'add_new'               => esc_html__( 'Add New', 'super-docs' ),
            'new_item'              => esc_html__( 'New Item', 'super-docs' ),
            'edit_item'             => esc_html__( 'Edit Item', 'super-docs' ),
            'update_item'           => esc_html__( 'Update Item', 'super-docs' ),
            'view_item'             => esc_html__( 'View Item', 'super-docs' ),
            'view_items'            => esc_html__( 'View Items', 'super-docs' ),
            'search_items'          => esc_html__( 'Search Item', 'super-docs' ),
            'not_found'             => esc_html__( 'Not found', 'super-docs' ),
            'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'super-docs' ),
            'featured_image'        => esc_html__( 'Featured Image', 'super-docs' ),
            'set_featured_image'    => esc_html__( 'Set featured image', 'super-docs' ),
            'remove_featured_image' => esc_html__( 'Remove featured image', 'super-docs' ),
            'use_featured_image'    => esc_html__( 'Use as featured image', 'super-docs' ),
            'insert_into_item'      => esc_html__( 'Insert into item', 'super-docs' ),
            'uploaded_to_this_item' => esc_html__( 'Uploaded to this item', 'super-docs' ),
            'items_list'            => esc_html__( 'Items list', 'super-docs' ),
            'items_list_navigation' => esc_html__( 'Items list navigation', 'super-docs' ),
            'filter_items_list'     => esc_html__( 'Filter items list', 'super-docs' )
        ];
        return [
            'label'               => $label,
            'labels'              => $labels,
            'rewrite'             => ['slug' => 'docs'],
            'supports'            => ['title', 'editor', 'Category', 'elementor'],
            'taxonomies'          => [super_docs_sidebar_taxonomy()],
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'menu_position'       => 5,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => false,
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
            'label'               => esc_html__( 'Templates', 'super-docs' ),
            'description'         => esc_html__( '', 'super-docs' ),
            'supports'            => ['title', 'editor', 'Category', 'elementor'],
            'taxonomies'          => [],
            'public'              => true,
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
