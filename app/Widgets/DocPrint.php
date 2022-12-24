<?php

namespace SuperDocs\App\Widgets;

use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

class DocPrint extends Widget_Base
{
    public function get_name()
    {
        return 'super-docs-doc-print';
    }

    public function get_title()
    {
        return esc_html__( 'Doc Print', 'super-docs' );
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
        return ['super-docs', 'doc', 'content', 'knowledge base', 'print'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'super-docs' ),
                'tab'   => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'doc_print_content_area',
            [
                'label'              => esc_html__( 'Print', 'super-docs' ),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'only_content_area',
                'options'            => [
                    'only_content_area' => esc_html__( 'Only Content Area', 'super-docs' ),
                    'full_window'       => esc_html__( 'Full Window', 'super-docs' )
                ],
                'frontend_available' => true
            ]
        );

        $this->add_control(
            'doc_print_icon',
            [
                'label'   => __( 'Icon', 'super-docs' ),
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
                'label'     => esc_html__( 'Alignment', 'super-docs' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'super-docs' ),
                        'icon'  => 'eicon-text-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'super-docs' ),
                        'icon'  => 'eicon-text-align-center'
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'super-docs' ),
                        'icon'  => 'eicon-text-align-right'
                    ]
                ],
                'default'   => 'center',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .super-docs-print' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'super-docs' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'doc_print_icon_size',
            [
                'label'      => esc_html__( 'Icon Size', 'super-docs' ),
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
                    '{{WRAPPER}} .super-docs-print'     => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .super-docs-print svg' => 'width: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control(
            'doc_print_icon_color',
            [
                'label'     => esc_html__( 'Color', 'super-docs' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .super-docs-print i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .super-docs-print svg' => 'fill: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
		$settings = $this->get_settings_for_display();
		?>
		<div class="super-docs-print" style="cursor: pointer;">
			<?php Icons_Manager::render_icon($settings['doc_print_icon'])?>
		</div>
		<?php
    }
}
