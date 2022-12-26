<?php

use SuperDocs\Bootstrap\Application;

function superdocs_count( $type = 'post', $perm = '', $mim_type = false )
{
    global $wpdb;

    if ( !post_type_exists( $type ) ) {
        return new \stdClass;
    }

    $query = "SELECT post_status, COUNT( * ) AS num_posts FROM {$wpdb->posts} WHERE post_type = %s";

    if ( 'readable' === $perm && is_user_logged_in() ) {
        $post_type_object = get_post_type_object( $type );
        if ( !current_user_can( $post_type_object->cap->read_private_posts ) ) {
            $query .= $wpdb->prepare(
                " AND (post_status != 'private' OR ( post_author = %d AND post_status = 'private' ))",
                get_current_user_id()
            );
        }
    }

    $query .= $wpdb->prepare( " AND post_mime_type = %s GROUP BY post_status", $mim_type );

    //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared -- Already prepared
    $results = (array) $wpdb->get_results( $wpdb->prepare( $query, $type ), ARRAY_A );
    $counts  = array_fill_keys( get_post_stati(), 0 );

    foreach ( $results as $row ) {
        $counts[$row['post_status']] = $row['num_posts'];
    }

    return apply_filters( 'wp_count_posts', (object) $counts, $type, $perm );
}

function superdocs_post_type()
{
    return Application::$config['post_types']['docs'];
}

function superdocs_sidebar_taxonomy()
{
    return Application::$config['taxonomies']['sidebar'];
}

function superdocs_template_post_type()
{
    return Application::$config['post_types']['template'];
}

function superdocs_version()
{
    return Application::$config['version'];
}

function superdocs_general_settings()
{
    global $superdocs;

    if ( isset( $superdocs['general_settings'] ) ) {
        return $superdocs['general_settings'];
    }

    $saved_values = get_option( 'superdocs-general-settings', true );

    if ( $saved_values ) {
        $saved_values = unserialize( $saved_values );
    } else {
        $saved_values = [];
    }

    $inputs = [
        'single_docs_slug'          => [
            'title'    => esc_html__( 'Single Docs Permalink', 'superdocs' ),
            'type'     => 'text',
            'value'    => 'docs',
            'required' => true
        ],
        'toc_supported_heading_tag' => [
            'title'    => esc_html__( 'TOC Supported Heading Tag', 'superdocs' ),
            'type'     => 'checkbox',
            'required' => false,
            'value'    => [],
            'options'  => [
                [
                    'title' => 'H1',
                    'value' => 'H1'
                ],
                [
                    'title' => 'H2',
                    'value' => 'H2'
                ],
                [
                    'title' => 'H3',
                    'value' => 'H3'
                ],
                [
                    'title' => 'H4',
                    'value' => 'H4'
                ],
                [
                    'title' => 'H5',
                    'value' => 'H5'
                ],
                [
                    'title' => 'H6',
                    'value' => 'H6'
                ]
            ]
        ]
    ];

    foreach ( $inputs as $name => $input ) {
        if ( isset( $saved_values[$name] ) ) {
            $inputs[$name]['value'] = $saved_values[$name];
        }
    }

    if(is_array($superdocs)) {
        $superdocs['general_settings'] = $inputs;
    }

    $superdocs = [
        'general_settings' => $inputs
    ];

    return $inputs;
}
