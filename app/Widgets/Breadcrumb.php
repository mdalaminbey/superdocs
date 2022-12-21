<?php

namespace WpGuide\App\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Breadcrumb extends Widget_Base
{
    public function get_name()
    {
        return 'wp-guide-breadcrumb';
    }

    public function get_title()
    {
        return esc_html__( 'Breadcrumb', 'wp-guide' );
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
        return ['wp-guide', 'doc', 'content', 'knowledge base', 'breadcrumb'];
    }

	protected function register_controls()
	{
		$this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'wp-guide' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'wp_guide_breadcrumb_color',
			[
				'label'     => esc_html__( 'Color', 'wp-guide' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .wp-guide .breadcrumbs .breadcrumb-item a' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'wp_guide_breadcrumb_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'wp-guide' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#4F46E5',
				'selectors' => [
					'{{WRAPPER}} .wp-guide .breadcrumbs .breadcrumb-active' => 'color: {{VALUE}} !important;'
				]
			]
		);

		$this->add_control(
			'wp_guide_breadcrumb_arrow_color',
			[
				'label'     => esc_html__( 'Arrow Color', 'wp-guide' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => false,
				'default'   => '#6298BC',
				'selectors' => [
					'{{WRAPPER}} .wp-guide .breadcrumbs .breadcrumb-icon' => 'color: {{VALUE}} !important;'
				]
			]
		);

		$this->add_control(
			'wp_guide_breadcrumb_gap',
			[
				'label'      => esc_html__( 'Gap between', 'wp-guide' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 5
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-guide .breadcrumbs' => 'gap: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_control(
			'wp_guide_breadcrumb_arrow_width',
			[
				'label'      => esc_html__( 'Width', 'wp-guide' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'default'    => [
					'unit' => 'px',
					'size' => 8
				],
				'selectors'  => [
					'{{WRAPPER}} .wp-guide .breadcrumbs .breadcrumb-icon' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'wp_guide_breadcrumb_typography',
				'label'          => esc_html__( 'Typography', 'wp-guide' ),
				'selectors'      => [
					'{{WRAPPER}} .wp-guide .breadcrumbs .breadcrumb-item',
				],
				'exclude'        => ['font_style', 'letter_spacing'],
				'fields_options' => [
					'typography'     => [
						'default' => 'custom'
					],
					'font_size'      => [
						'label'      => esc_html__( 'Font Size (px)', 'wp-guide' ),
						'default'    => [
							'size' => '14',
							'unit' => 'px'
						],
						'size_units' => ['px']
					],
					'text_transform' => [
						'default' => 'uppercase'
					],
					'font_weight'    => [
						'default' => '600'
					],
					'line_height'    => [
						'label'      => esc_html__( 'Line Height (px)', 'wp-guide' ),
						'default'    => [
							'size' => '17',
							'unit' => 'px'
						],
						'size_units' => ['px']
					]
				]
			]
		);

		$this->end_controls_section();
	}

    protected function render()
    {
		global $post;

		$docTitle     = $post->post_title;
		$productId    = get_post_meta($post->ID, 'productId', true);
		$product      = get_post($productId);
		$productTitle = '';
		$productLink  = '';

		if($product) {
			$productTitle = $product->post_title;
			$productLink  = get_post_permalink($product);
		}

		?>
		<style>
			.breadcrumb-item {
				position: relative;
			}
			.breadcrumb-icon { 
				position: relative;
				display: flex;
			}

			.breadcrumbs {
				display: flex;
				align-items: center;
				flex-flow: row wrap;
			}

			.breadcrumb-item a {
				text-decoration: none !important;
			}
		</style>
		<nav class="wp-guide">
			<ul class="breadcrumbs">
				<li class="breadcrumb-item">
					<a href="<?php wp_commander_render(get_site_url())?>">
						<?php esc_html_e('Home', 'wp-guide')?>
					</a>
				</li>
				<li class="breadcrumb-item">
					<?php $this->arrowIcon()?>
				</li>
				<li class="breadcrumb-item">
					<a href="<?php wp_commander_render(get_post_type_archive_link( wp_guide_docs_post_type() ))?>">
						<?php esc_html_e('Documentation', 'wp-guide')?>
					</a>
				</li>
				<li class="breadcrumb-item">
					<?php $this->arrowIcon()?>
				</li>
				<li class="breadcrumb-item">
					<a href="<?php wp_commander_render($productLink)?>">
						<?php wp_commander_render($productTitle)?>
					</a>
				</li>
				<li class="breadcrumb-item">
					<?php $this->arrowIcon()?>
				</li>
				<li class="breadcrumb-item breadcrumb-active">
					<?php wp_commander_render($docTitle)?>
				</li>
			</ul>
		</nav>
	<?php
    }

	public function arrowIcon() {
		?>
		<span class="breadcrumb-icon">
			<svg class="breadcrumb-delimiter-icon svg-inline--fa fa-angle-right fa-w-8" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512">
				<path fill="currentColor" d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z">
				</path>
			</svg>
		</span>
		<?php
	}
}
