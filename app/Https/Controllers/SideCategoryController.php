<?php

namespace WpGuide\App\Https\Controllers;

use WpGuide\Bootstrap\View;
use WP_REST_Request;

class SideCategoryController
{
    public function get( WP_REST_Request $wp_rest_request )
    {
        View::api_render( 'admin/pages/sidebar-category/order-page' );
        if($wp_rest_request->get_param('product_id') == 6) {
            echo "hello";
        } else {
            echo "HI";
        }
    }
}
