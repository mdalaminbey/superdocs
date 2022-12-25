<?php

namespace SuperDocs\App\Https\Controllers;

use SuperDocs\Bootstrap\Application;
use SuperDocs\Bootstrap\View;
use WP_REST_Request;

class TemplateController
{
    public function create( WP_REST_Request $wpRestRequest )
    {
        $template_name = $wpRestRequest->get_param( 'template-name' );

        if ( empty( $template_name ) ) {
            $template_name = '#Template ' . time();
        }

        $templateId = wp_insert_post( [
            'post_type'   => superdocs_template_post_type(),
            'post_title'  => $template_name,
            'post_status' => 'publish'
        ] );

        update_post_meta( $templateId, 'superdocs_edit_with_option', 'elementor' );
        update_post_meta( $templateId, '_wp_page_template', 'elementor_header_footer' );
        update_post_meta( $templateId, '_elementor_edit_mode', 'builder' );
        update_post_meta( $templateId, '_elementor_version', '3.9.2' );

        $template = $wpRestRequest->get_param( 'template' );

        if ( !empty( $template ) && 'blank' !== $template ) {
            $rootDir   = Application::$instance->get_root_dir();
            $json_path = $rootDir . '/app/Demo/Elementor/' . $template . '/demo.json';
            wp_commander_import_elementor_demo( $json_path, $templateId );
        }

        wp_send_json_success( [
            'templateId' => $templateId
        ] );
    }

    public function create_page()
    {
        return View::send( 'admin/pages/template/create' );
    }
}
