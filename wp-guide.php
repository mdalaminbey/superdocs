<?php

/**
 * Plugin Name:       Wp Guide
 * Plugin URI:        http://wordpress.org/plugins/wp-guide/
 * Description:       This is not just a plugin!
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            DoatKolom
 * Author URI:        http://doatkolom.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-guide
 * Domain Path:       /languages
 * Tested up to:      6.0.1
 */

use WpGuide\Bootstrap\Application;

require_once __DIR__ . '/vendor/autoload.php';

class WpPluginEngine
{
    public static function boot()
    {
        $app = Application::instance();

        /**
         * Fires once activated plugins have loaded.
         */
        add_action( 'plugins_loaded', function () use ( $app ): void {
            $app->boot( __DIR__, __FILE__);
        } );
    }
}

WpPluginEngine::boot();