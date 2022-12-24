<?php

use SuperDocs\Bootstrap\Application;

function super_docs_count( $type = 'post', $perm = '', $mim_type = false )
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

function super_docs_post_type()
{
    return Application::$config['post_types']['docs'];
}

function super_docs_sidebar_taxonomy()
{
    return Application::$config['taxonomies']['sidebar'];
}

function super_docs_template_post_type()
{
    return Application::$config['post_types']['template'];
}

function super_docs_version()
{
    return Application::$config['version'];
}
