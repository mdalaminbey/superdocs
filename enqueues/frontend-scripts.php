<?php

/**
 * @var Application $application
 */
wp_enqueue_script( 'wp-guide-elementor-script', $application->get_root_url() . 'app/Widgets/assets/js/script.js', ['jquery'], $application::$config['version'] );
