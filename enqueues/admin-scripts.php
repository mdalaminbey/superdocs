<?php

use SuperDocs\Bootstrap\Application;

/**
 * @var Application $application
 */
if ( wp_commander_is_admin_page( 'edit', ['post_type' => superdocs_post_type()] ) ) {
    wp_enqueue_script( 'superdocs-docs', $application->get_root_url() . '/assets/js/admin/docs.js', [], superdocs_version() );
}

wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'doatkolom-ui-focus-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs-focus.min.js', [], superdocs_version() );
wp_enqueue_script( 'doatkolom-ui-' . $application::$config['namespace'] . '-defer', $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs.min.js', [], superdocs_version() );
wp_enqueue_script( 'doatkolom-ui-core-', $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/doatkolom-ui.js', [], superdocs_version() );
wp_enqueue_script( 'doatkolom-ui-collapse-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs-collapse.min.js', [], superdocs_version() );

wp_enqueue_style( 'doatkolom-ui-tailwind' . $this->application::$config['namespace'], $this->application->get_root_url() . 'vendor/doatkolom/ui/assets/css/app.css', [], superdocs_version() );
wp_enqueue_style( 'superdocs-tailwind', $application->get_root_url() . 'assets/css/app.css', [], superdocs_version() );

if ( wp_commander_is_admin_page( 'edit', ['post_type' => superdocs_template_post_type()] ) ) {
    wp_enqueue_script( 'superdocs-template-js-' . $application::$config['namespace'] . '-defer', $application->get_root_url() . '/assets/js/admin/template.js', ['jquery'], superdocs_version(), true );
}
