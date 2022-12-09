<?php

use WpGuide\Bootstrap\Application;

if ( wp_commander_is_admin_page( 'edit', ['post_type' => wp_guide_docs_post_type()] ) ) {
    wp_enqueue_script( 'wp-guide-docs', Application::$instance->get_root_url() . '/resources/js/docs.js', [], wp_guide_version() );
}
wp_enqueue_style( 'wp-guide-tailwind', Application::$instance->get_root_url() . '/assets/css/app.css', [], time() );
