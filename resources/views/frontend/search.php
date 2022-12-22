<style>
	.wp-guide-search-results {
		background: #f3f3fa;
		padding: 10px;
		position: absolute;
		z-index: 9999;
		width: 100%;
	}
	.wp-guide-search-results ul {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
	.wp-guide-search-results ul li {
		background: #e3e3e4;
		padding: 10px;
	}
</style>
<div class="wp-guide-search-results">
	<ul>
		<?php foreach ( $docs as $doc ): ?>
			<li>
				<a href="<?php wp_commander_render( get_permalink( $doc ) )?>">
					<?php wp_commander_render( $doc->post_title )?>
				</a>
			</li>
		<?php endforeach;?>
	</ul>
</div>