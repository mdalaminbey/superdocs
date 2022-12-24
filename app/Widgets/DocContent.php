<?php

namespace SuperDocs\App\Widgets;

use Elementor\Widget_Base;

class DocContent extends Widget_Base {

	public function get_name() {
		return 'superdocs-doc-content';
	}

	public function get_title() {
		return esc_html__( 'Doc Content', 'superdocs' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'superdocs', 'doc', 'content', 'knowledge base' ];
	}

	protected function render() {
		$elementor = \Elementor\Plugin::$instance;
		global $post;
		if( $elementor->editor->is_edit_mode() || is_preview() || (isset($post->post_type) && superdocs_template_post_type() === $post->post_type)) {
			?>

            <h1>Here we will push your docs content</h1>

            <?php
		} else { ?>
			{{ SuperDocs Doc Content }}
		<?php }
	}
}
