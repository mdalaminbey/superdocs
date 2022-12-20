<?php

namespace WpGuide\App\Widgets;

use Elementor\Widget_Base;

class TableOfContent extends Widget_Base
{
    public function get_name()
    {
        return 'wp-guide-table-of-content';
    }

    public function get_title()
    {
        return esc_html__( 'Table of Content', 'elementor-addon' );
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['wp-guide', 'doc', 'content', 'knowledge base'];
    }

    protected function render()
    {
		?>
		<div class="wp-guide-table-of-content">
			<h4>Table of Content</h4>
			<ol></ol>
		</div>
		<?php
    }
}
