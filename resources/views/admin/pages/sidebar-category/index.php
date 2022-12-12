<?php

use DoatKolom\Ui\Components\Tab;
use DoatKolom\Ui\WpLayout;
use WpGuide\Bootstrap\Application;

$tabs = [];
foreach ( $products as $product ) {
    array_push( $tabs, [
        'title'               => $product->post_title,
        // 'content_api'         => wp_commander_url_add_params( get_rest_url( null, 'wp-guide/sidebar-category-order-page' ), ['product_id' => $product->ID] ),
        // 'content_cache'       => false,
        'content_api_options' => [
            'headers' => [
                'X-WP-Nonce' => wp_create_nonce( 'wp_rest' )
            ]
        ],
        'content'             => function () {
                $layout = WpLayout::instance( Application::$instance );
                    $layout->tab(
                        [
                                'init' => false,
                                'position' => 'left',
                                'classes'  => [
                                    'body'      => 'test',
                                    'tablist'   => '',
                                    'tabpanels' => 'bg-white'
                                ]
                            ], [
                                [
                                    'title' => "Hello",
                                    'content_api'         => wp_commander_url_add_params( get_rest_url( null, 'wp-guide/sidebar-category-order-page' ), ['product_id' => 5] ),
                                    'content_cache'       => false,
                                    'content_api_options' => [
                                        'headers' => [
                                            'X-WP-Nonce' => wp_create_nonce( 'wp_rest' )
                                        ]
                                    ],
                                ],
                                [
                                    'title' => "HI",
                                    'content' => function() {
                                        echo "HI";
                                    }
                                ]
                                ], 'no'
                    );

        },
        'classes'             => [
            'tab_button'   => 'helll o',
            'tab_selector' => 'h-14'
        ]
    ] );
}
?>
<!-- <script defer src="https://unpkg.com/@alpinejs/collapse@3.10.5/dist/cdn.min.js"></script> -->
<div class="mt-8 pr-6 doatkolom-ui wp-guide">
    <div class="rounded-xl bg-[#F8FAFC]">
        <div class="min-h-[38rem] p-10">
              <?php
                  $layout = WpLayout::instance( Application::$instance );
                  $layout->tab( [
                      'init'     => true,
                      'position' => 'top',
                      'classes'  => [
                          'body'      => 'test',
                          'tablist'   => '',
                          'tabpanels' => 'bg-white'
                      ]
                  ], $tabs );
              ?>
        </div>
    </div>
</div>
