<?php

use WpGuide\Bootstrap\Application;

$application = Application::$instance;
if ( wp_commander_is_admin_page( 'edit', ['post_type' => wp_guide_docs_post_type()] ) ) {
    wp_enqueue_script( 'wp-guide-docs', Application::$instance->get_root_url() . '/resources/js/docs.js', [], wp_guide_version() );
}
wp_enqueue_style( 'wp-guide-tailwind', Application::$instance->get_root_url() . '/assets/css/app.css', [], time() );
wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script( 'doatkolom-ui-focus-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs-focus.min.js', [], $application::$config['version'] );
wp_enqueue_script( 'doatkolom-ui-' . $application::$config['namespace'] . '-defer', $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs.min.js', [], $application::$config['version'] );
wp_enqueue_script( 'doatkolom-ui-core-', $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/doatkolom-ui.js', [], $application::$config['version'] );
