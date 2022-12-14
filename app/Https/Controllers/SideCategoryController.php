<?php

namespace WpGuide\App\Https\Controllers;

use DoatKolom\Ui\Components\Tab;
use WpGuide\Bootstrap\View;
use WP_REST_Request;

class SideCategoryController
{
    public function get( WP_REST_Request $wp_rest_request )
    {
        View::send( 'admin/pages/sidebar-category/order-page' );
    }
}


// <script>
//   jQuery( function($) {
//     let $sortcategory = $( "#category" );

//     var sortEventHandler = function(event, ui){
//     // console.log($sortcategory.children());
// };

//     $sortcategory.sortable({
//         stop: sortEventHandler
//     }).disableSelection();

//     $sortcategory.on("sortchange", sortEventHandler);

//     $( ".connectedSortable" ).sortable({
//       connectWith: ".connectedSortable"
//     }).disableSelection();
//   } );
//   </script>