<?php

/**
 * @var Application $application
 */
wp_enqueue_script( 'wp-guide-simple-scrollbar-js', $application->get_root_url() . '/assets/js/simple-scrollbar.js', [], $this->application::$config['version'], true );
wp_enqueue_style( 'wp-guide-simple-scrollbar-css', $application->get_root_url() . '/assets/css/simple-scrollbar.css', [], $this->application::$config['version'] );
