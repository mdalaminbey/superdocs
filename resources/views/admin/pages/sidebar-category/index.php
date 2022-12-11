<?php

use DoatKolom\Ui\WpLayout;
use WpGuide\Bootstrap\Application;

$application = Application::$instance;
$tabs = [];
foreach($products as $product) {
    array_push($tabs, [
        'title'         => $product->post_title,
        'content_api'   => wp_commander_url_add_params(get_rest_url(null, 'wp-guide/sidebar-category-order-page'), ['product_id' => $product->ID]),
        'content_cache' => false,
        'content_api_options' => [
            'headers' => [
                'X-WP-Nonce' =>  wp_create_nonce('wp_rest')
            ]
        ]
    ]);
}
?>
<script defer src="https://unpkg.com/@alpinejs/collapse@3.10.5/dist/cdn.min.js"></script>
<div class="mt-8 pr-6 doatkolom-ui wp-guide">
    <div class="rounded-xl bg-[#F8FAFC]">
        <div class="min-h-[38rem] p-10">
              <?php
                $layout = WpLayout::instance( Application::$instance );
                $layout->tab( [
                    'classes' => [
                        'body'           => 'test',
                        'selectors_body' => 'selectors_body',
                        // 'content_body'   => 'content_body',
                        'content_body'      => 'bg-white'
                    ],
                    'tabs'    => $tabs
                ]);
                
              ?>
        </div>
    </div>
</div>
