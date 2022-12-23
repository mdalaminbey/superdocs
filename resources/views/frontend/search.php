<div class="wp-guide-search-results">
	<?php if(!empty($docs)){ ?>
	<ul>
		<?php foreach ( $docs as $doc ): ?>
		<li>
			<a href="<?php wp_commander_render( get_permalink( $doc ) )?>">
				<?php wp_commander_render( $doc->post_title )?>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
	<?php } else {?>
		<div class="empty-result">
			No Documentation found
		</div>
	<?php } ?>
</div>