<?php

use WpGuide\App\Providers\Admin\MenuServiceProvider;
use WpGuide\App\Providers\CptServiceProvider;
use WpGuide\App\Providers\UrlServiceProvider;

return [
    /**
     * Plugin Current Version
     */
    'version'      => '1.0.0',

    /**
     * Service providers
     */
    'providers'    => [
        CptServiceProvider::class,
        UrlServiceProvider::class
    ],

    'admin_providers' => [
        MenuServiceProvider::class
    ],
    /**
     * Plugin Api Namespace
     */
    'namespace'    => 'wp-guide',

    'api_versions' => [],

    'middleware' => []
];
