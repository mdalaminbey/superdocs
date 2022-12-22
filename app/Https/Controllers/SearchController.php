<?php

namespace WpGuide\App\Https\Controllers;

use WP_REST_Request;
use WpGuide\Bootstrap\View;

class SearchController
{
    public function get( WP_REST_Request $wpRestRequest )
    {
		$docs = get_posts([
			'post_type' => wp_guide_docs_post_type(),
			// 'exclude' => $docsIds, 
			'meta_query' => [
				[
					'key'     => 'wp_guide_product',
					'compare' => 'NOT EXISTS'
				],
				[
					'key'     => 'wp_guide_category',
					'compare' => 'NOT EXISTS'
				],
				// [
				// 	'key'     => 'categoryId',
				// 	'compare'   => 'NOT EXISTS'
				// ],
				// [
				// 	'key'     => 'productId',
				// 	'value'   => $productId
				// ]
			]
		]);
		return View::send('frontend/search', compact('docs'));
    }
}
