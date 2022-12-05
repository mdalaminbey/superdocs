<?php

namespace WpGuide\App\Providers\Admin;

use WpCommander\Contracts\ServiceProvider;
use WpGuide\App\AdminPages\Doc;
use WpGuide\App\AdminPages\Product;
use WpGuide\Bootstrap\View;

class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'admin_menu', [$this, 'action_admin_menu'] );
        add_action( 'save_post_wpguidedocs', [$this, 'save_post'], 10, 3 );
        /**
         *
         * Product page
         */
        if ( wp_commander_is_admin_page( 'edit', ['post_type' => 'wpguidedocs', 'product' => 'true'] ) ) {
            ( new Product )->boot();
        } elseif ( wp_commander_is_admin_page( 'edit', ['post_type' => 'wpguidedocs', 'product' => '!true'] ) ) {
            ( new Doc )->boot();
        } elseif ( wp_commander_is_admin_page( 'admin-ajax', ['post_type' => 'wpguidedocs'] ) ) {
            $type = isset( $_REQUEST['post_ID'] ) ? get_post_mime_type( intval( $_REQUEST['post_ID'] ) ) : false;
            if ( 'doc' === $type ) {
                ( new Doc )->boot();
            }
        }
    }

    public function save_post( int $post_ID )
    {
        global $wpdb;
        if ( is_int( strpos( $_SERVER['HTTP_REFERER'], 'product=true' ) ) ) {
            $type = 'product';
            add_post_meta( $post_ID, 'wp_guide_product', true );
        } else {
            $type = 'doc';
        }
        $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->prefix}posts SET post_mime_type = %s WHERE ID=%d", $type, $post_ID ) );

    }

    public function action_admin_menu()
    {
        add_menu_page( esc_html__( 'Wp Guide', 'x-currency' ), esc_html__( 'Wp Guide', 'x-currency' ), 'manage_options', 'wp-guide-menu', '', 'dashicons-media-document', 5 );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'All Docs', 'wp-guide' ), esc_html__( 'All Docs', 'wp-guide' ), 'manage_options', 'edit.php?post_type=wpguidedocs' );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'Products', 'wp-guide' ), esc_html__( 'Products', 'wp-guide' ), 'manage_options', 'edit.php?post_type=wpguidedocs&product=true' );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'Templates', 'wp-guide' ), esc_html__( 'Templates', 'wp-guide' ), 'manage_options', 'edit.php?post_type=wpguidetemplate' );
        add_submenu_page( 'wp-guide-menu', esc_html__( 'Menu Position', 'wp-guide' ), esc_html__( 'Menu Position', 'wp-guide' ), 'manage_options', 'wp-guide-menu-position', [$this, 'menu_position'] );
        remove_submenu_page( 'wp-guide-menu', 'wp-guide-menu' );
    }

    public function menu_position()
    {
        View::render( 'admin/menu-position', ['hello' => 'Hello World'] );
    }
}
