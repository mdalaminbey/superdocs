<?php

namespace WpGuide\App\Providers;

use WpCommander\Contracts\ServiceProvider;
use WpGuide\App\Widgets\DocCategories;
use WpGuide\App\Widgets\DocContent;
use WpGuide\App\Widgets\TableOfContent;

class ElementorWidgetServicerProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'init', [$this, 'init'] );
    }

    public function init()
    {
        add_action( 'elementor/widgets/register', [$this, 'action_register_widget'] );
    }

    /**
     * After widgets registered.
     *
     * Fires after Elementor widgets are registered.
     *
     * @since 1.0.0
     */
    public function action_register_widget( $widgets_manager )
    {
        foreach ( $this->widgets() as $widget ) {
            $widgets_manager->register( new $widget );
        }
    }

    public function widgets()
    {
        return [
            DocContent::class,
            DocCategories::class,
            TableOfContent::class
        ];
    }
}
