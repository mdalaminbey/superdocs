<?php

use SuperDocs\Bootstrap\Application;

/**
 * @var Application $application
 */
if ( wp_commander_is_admin_page( 'edit', ['post_type' => super_docs_post_type()] ) ) {
    wp_enqueue_script( 'super-docs-docs', $application->get_root_url() . '/resources/js/docs.js', [], super_docs_version() );
}

wp_enqueue_script( 'jquery-ui-sortable' );
wp_enqueue_script( 'doatkolom-ui-focus-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs-focus.min.js', [], time() );
wp_enqueue_script( 'doatkolom-ui-' . $application::$config['namespace'] . '-defer', $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs.min.js', [], time() );
wp_enqueue_script( 'doatkolom-ui-core-', $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/doatkolom-ui.js', [], time() );
wp_enqueue_script( 'doatkolom-ui-collapse-' . $application::$config['namespace'], $application->get_root_url() . 'vendor/doatkolom/ui/assets/js/alpinejs-collapse.min.js', [], time() );

wp_enqueue_style( 'doatkolom-ui-tailwind' . $this->application::$config['namespace'], $this->application->get_root_url() . 'vendor/doatkolom/ui/assets/css/app.css', [], time() );
wp_enqueue_style( 'super-docs-tailwind', $application->get_root_url() . 'assets/css/app.css', [], time() );

if ( wp_commander_is_admin_page( 'edit', ['post_type' => super_docs_template_post_type()] ) ) {
    wp_enqueue_script( 'super-docs-template-js-' . $application::$config['namespace'] . '-defer', $application->get_root_url() . '/assets/js/admin/template.js', ['jquery'], time(), true );
}
