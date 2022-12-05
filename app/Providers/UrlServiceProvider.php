<?php

namespace WpGuide\App\Providers;

use WpCommander\Contracts\ServiceProvider;

class UrlServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // add_action( 'init', [$this, 'init'] );
        // add_filter('post_type_link', [$this, 'my_permalinks'], 10, 3);
    }

    public function init()
    {
        $labels = [
            'name'           => _x( 'Courses', 'Post Type General Name', '1fix' ),
            'singular_name'  => _x( 'Course', 'Post Type Singular Name', '1fix' ),
            'menu_name'      => __( 'Courses', '1fix' ),
            'name_admin_bar' => __( 'Courses', '1fix' )
        ];
        $args = [
            'label'        => __( 'Course', '1fix' ),
            'labels'       => $labels,
            'hierarchical' => true,
            'public'       => true
        ];
        register_post_type( 'course', $args );
        $labels = [
            'name'           => _x( 'Lessons', 'Post Type General Name', '1fix' ),
            'singular_name'  => _x( 'Lesson', 'Post Type Singular Name', '1fix' ),
            'menu_name'      => __( 'Lessons', '1fix' ),
            'name_admin_bar' => __( 'Lessons', '1fix' )
        ];
        $args = [
            'label'        => __( 'Lesson', '1fix' ),
            'labels'       => $labels,
            'hierarchical' => true,
            'public'       => true
        ];
        register_post_type( 'lesson', $args );

        add_action( 'add_meta_boxes', function () {
            add_meta_box( 'lesson-parent', 'Course', function ( $post ) {
                $post_type_object = get_post_type_object( $post->post_type );
                $pages            = wp_dropdown_pages( [ 'post_type' => 'course', 'selected' => $post->post_parent, 'name' => 'parent_id', 'show_option_none' => __( '(no parent)' ), 'sort_column' => 'menu_order, post_title', 'echo' => 0 ] );
                if ( !empty( $pages ) ) {
                    echo $pages;
                }
            }, 'lesson', 'side', 'high' );
        } );

        add_rewrite_tag('%lesson%', '([^/]+)', 'lesson=');
        add_permastruct('lesson', '/lesson/%course%/%lesson%', false);
        add_rewrite_rule('^lesson/([^/]+)/([^/]+)/?','index.php?lesson=$matches[2]','top');
    }

    public function my_permalinks( $permalink, $post, $leavename )
    {
        error_log( $permalink );
        $post_id = $post->ID;
        if ( $post->post_type != 'lesson' || empty( $permalink ) || in_array( $post->post_status, [ 'draft', 'pending', 'auto-draft' ] ) ) {
            return $permalink;
        }

        $parent      = $post->post_parent;
        $parent_post = get_post( $parent );

        $permalink = str_replace( '%course%', $parent_post->post_name, $permalink );

        return $permalink;
    }
}
