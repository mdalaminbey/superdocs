<?php

namespace SuperDocs\App\Providers;

use WpCommander\Contracts\ServiceProvider;
use SuperDocs\App\Widgets\Breadcrumb;
use SuperDocs\App\Widgets\DocCategories;
use SuperDocs\App\Widgets\DocContent;
use SuperDocs\App\Widgets\DocPrint;
use SuperDocs\App\Widgets\DocSearch;
use SuperDocs\App\Widgets\TableOfContent;

class ElementorWidgetServicerProvider extends ServiceProvider
{
    public function boot()
    {
        add_action( 'init', [$this, 'init'] );
    }

    public function init()
    {
        add_action( 'elementor/widgets/register', [$this, 'action_register_widget'] );
        add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'action_after_enqueue_scripts'] );
    }

    /**
     * Before frontend enqueue scripts.
     *
     * Fires before Elementor frontend scripts are enqueued.
     *
     * @since 1.0.0
     */
    public function action_after_enqueue_scripts()
    {
        wp_enqueue_script( 'super-docs-elementor-script', $this->application->get_root_url() . 'app/Widgets/assets/js/script.js', ['jquery', 'elementor-frontend'], $this->application::$config['version'] );
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
            TableOfContent::class,
            Breadcrumb::class,
            DocPrint::class,
            DocSearch::class
        ];
    }
}
