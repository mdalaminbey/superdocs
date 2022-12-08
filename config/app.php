<?php

use WpGuide\App\Providers\Admin\MenuServiceProvider;
use WpGuide\App\Providers\CptServiceProvider;
use WpGuide\App\Providers\ElementorWidgetServicerProvider;
use WpGuide\App\Providers\TemplateServiceProvider;

return [
    /**
     * Plugin Current Version
     */
    'version'         => '1.0.0',

    /**
     * All post types for this plugin
     */
    'post_types'      => [
        'docs'     => 'wpguidedocs',
        'template' => 'wpguidetemplate'
    ],

    /**
     * All taxonomies for this plugin
     */
    'taxonomies'      => [
        'sidebar' => 'wpguidedocs-category'
    ],

    /**
     * Service providers
     */
    'providers'       => [
        CptServiceProvider::class,
        ElementorWidgetServicerProvider::class,
        TemplateServiceProvider::class
    ],

    'admin_providers' => [
        MenuServiceProvider::class
    ],
    /**
     * Plugin Api Namespace
     */
    'namespace'       => 'wp-guide',

    'api_versions'    => [],

    'middleware'      => []
];
