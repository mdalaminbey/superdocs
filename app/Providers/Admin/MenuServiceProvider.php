<?php

namespace WpGuide\App\Providers\Admin;

use DoatKolom\Ui\WpLayout;
use WP_Post;
use WpCommander\Contracts\ServiceProvider;
use WpGuide\App\AdminPages\Doc;
use WpGuide\App\AdminPages\Product;
use WpGuide\App\AdminPages\Sidebar;
use WpGuide\App\Https\Controllers\CategoryController;
use WpGuide\Bootstrap\Application;
use WpGuide\Bootstrap\View;

class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'admin_menu', [$this, 'action_admin_menu'] );
        add_action( 'save_post_' . wp_guide_docs_post_type(), [$this, 'save_post'], 10, 3 );

        if ( wp_commander_is_admin_page( 'edit', ['post_type' => wp_guide_docs_post_type(), 'product' => 'true'] ) ) {
            ( new Product )->boot();
        } elseif ( wp_commander_is_admin_page( 'edit', ['post_type' => wp_guide_docs_post_type(), 'product' => '!true'] ) ) {
            ( new Doc )->boot();
        } elseif ( wp_commander_is_admin_page( 'admin-ajax', ['post_type' => wp_guide_docs_post_type()] ) ) {
            $type = isset( $_REQUEST['post_ID'] ) ? get_post_mime_type( intval( $_REQUEST['post_ID'] ) ) : false;
            if ( 'doc' === $type ) {
                ( new Doc )->boot();
            } elseif ( 'product' === $type ) {
                ( new Product )->boot();
            }
        } elseif ( wp_commander_is_admin_page( 'admin', ['page' => 'wp-guide-sidebar-category'] ) ) {
            ( new Sidebar )->boot();
        }
    }

    public function save_post( int $post_ID, WP_Post $post)
    {
        global $wpdb;
        if ( is_int( strpos( $_SERVER['HTTP_REFERER'], 'product=true' ) ) || is_int( strpos( $_SERVER['HTTP_REFERER'], 'page=wp-guide-sidebar-category' ) ) ) {
            $type = 'product';
            add_post_meta( $post_ID, 'wp_guide_product', true );
        } else {
            $type = 'doc';
        }

        $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}posts SET post_mime_type = %s WHERE ID=%d", $type, $post_ID ) );
        
        if( !empty($_POST['productId']) ) {
            $oldProductId = get_post_meta( $post_ID, 'productId', true);
            if($oldProductId != $_POST['productId']) {
                $categoryPostId = get_post_meta($post_ID, 'categoryId', true);
                if($categoryPostId) {
                    CategoryController::removeProductFormCategories($post_ID, $categoryPostId, $oldProductId,);
                    delete_post_meta($post_ID, 'categoryId');
                }
            }
            update_post_meta( $post_ID, 'productId', sanitize_text_field( wp_unslash( $_POST['productId'] ) ) );

            // $parent_post = get_post($post->post_parent);

            // if($parent_post && $parent_post->post_mime_type !== 'category') {
                $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}posts SET post_parent = %s WHERE ID=%d", $_POST['productId'], $post_ID ) );
            // }
        }

        if ( !empty( $_POST['wp-guide-template'] ) ) {
            update_post_meta( $post_ID, 'wp-guide-template', sanitize_text_field( wp_unslash( $_POST['wp-guide-template'] ) ) );
        }
    }

    public function action_admin_menu()
    {
        add_menu_page( esc_html__( 'Wp Guide', 'x-currency' ), esc_html__( 'Wp Guide', 'x-currency' ), 'manage_options', 'wp-guide-menu', function () {}, 'dashicons-media-document', 5 );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'All Docs', 'wp-guide' ), esc_html__( 'All Docs', 'wp-guide' ), 'manage_options', 'edit.php?post_type=' . wp_guide_docs_post_type() );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'Products', 'wp-guide' ), esc_html__( 'Products', 'wp-guide' ), 'manage_options', 'edit.php?product=true&post_type=' . wp_guide_docs_post_type() );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'Templates', 'wp-guide' ), esc_html__( 'Templates', 'wp-guide' ), 'manage_options', 'edit.php?post_type=' . wp_guide_template_post_type() );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'Sidebar Category', 'wp-guide' ), esc_html__( 'Sidebar Category', 'wp-guide' ), 'manage_options', 'wp-guide-sidebar-category', [$this, 'sidebar_category'] );
        remove_submenu_page( 'wp-guide-menu', 'wp-guide-menu' );
    }

    public function sidebar_category()
    {
        global $wpdb;
        $products  = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}posts WHERE post_type = %s AND post_status = 'publish' AND post_mime_type = 'product'", wp_guide_docs_post_type() ) );
        View::render( 'admin/pages/category/index', ['products' => $products] );
        WpLayout::instance(Application::$instance)->enqueue_script();
    }
}
