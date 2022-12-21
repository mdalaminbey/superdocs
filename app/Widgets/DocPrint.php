<?php

namespace WpGuide\App\Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

class DocPrint extends Widget_Base
{
    public function get_name()
    {
        return 'wp-guide-doc-print';
    }

    public function get_title()
    {
        return esc_html__( 'Doc Print', 'wp-guide' );
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
        return ['wp-guide', 'doc', 'content', 'knowledge base', 'print'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'wp-guide' ),
                'tab'   => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'doc_print_content_area',
            [
                'label'              => esc_html__( 'Print', 'wp-guide' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'only_content_area',
                'options'            => [
                    'only_content_area' => esc_html__( 'Only Content Area', 'wp-guide' ),
                    'full_window'       => esc_html__( 'Full Window', 'wp-guide' )
                ],
                'frontend_available' => true
            ]
        );

        $this->add_control(
            'doc_print_icon',
            [
                'label'   => __( 'Icon', 'wp-guide' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fas fa-print',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $this->add_control(
            'doc_print_icon_alignment',
            [
                'label'     => esc_html__( 'Alignment', 'wp-guide' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'wp-guide' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wp-guide' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'wp-guide' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-print' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'wp-guide' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'doc_print_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'wp-guide' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1
                    ]
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 25
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-print'     => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wp-guide-print svg' => 'width: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control(
            'doc_print_icon_color',
            [
                'label'     => esc_html__( 'Color', 'wp-guide' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-print i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .wp-guide-print svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
		$settings = $this->get_settings_for_display();
		?>
		<div class="wp-guide-print" style="cursor: pointer;">
			<?php Icons_Manager::render_icon($settings['doc_print_icon'])?>
		</div>
		<?php
    }
}
