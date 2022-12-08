<?php

namespace WpGuide\App\Providers;

use WpCommander\Contracts\ServiceProvider;
use WpGuide\Bootstrap\View;

class TemplateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        add_filter( 'template_include', [$this, 'filter_template_include'], 99999 );
    }

    /**
     * Filters the path of the current template before including it.
     *
     * @param string $template The path of the template to include.
     * @return string The path of the template to include.
     */
    public function filter_template_include( string $template ): string
    {
        if ( is_singular( wp_guide_docs_post_type() ) ) {
            global $post;
            if ( 'doc' === $post->post_mime_type ) {
                $template_id = get_post_meta( $post->ID, 'wp-guide-template', true );
                $product_id  = $post->post_parent;
                if ( $template_id == '0' ) {
                    $template_id = get_post_meta( $product_id, 'wp-guide-template', true );
                }
                $is_template_use_elementor = get_post_meta( $template_id, '_elementor_edit_mode', true ) ?? false;

                if ( $is_template_use_elementor ) {
                    if ( did_action( 'elementor/loaded' ) ) {
                        $elementor_template_module = \Elementor\Plugin::$instance->modules_manager->get_modules( 'page-templates' );
                        $elementor_template_module->set_print_callback( function () use ( $template_id ) {
                            $layout = \Elementor\Plugin::instance()->frontend->get_builder_content( $template_id );
                            ob_start();
                            the_content();
                            $content = ob_get_clean();
                            wp_commander_render( str_replace( "{{ Wp Guide Doc Content }}", $content, $layout ) );
                        } );
                        return View::get_path( 'frontend/elementor-header-footer' );
                    }
                }
            }
        }
        return $template;
    }
}
