<?php

namespace WpGuide\App\Providers;

use WpCommander\Contracts\ServiceProvider;
use WpGuide\App\Widgets\DocContent;

class ElementorWidgetServicerProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'init', [$this, 'init'] );
    }

    public function init()
    {
        add_action( 'elementor/widgets/register', [$this, 'register_widget'] );
    }

    public function register_widget( $widgets_manager )
    {
        $widgets_manager->register( new DocContent() );
    }
}
