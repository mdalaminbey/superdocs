<?php

namespace WpGuide\App\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

class DocCategories extends Widget_Base
{
    public function get_name()
    {
        return 'wp-guide-doc-categories';
    }

    public function get_title()
    {
        return esc_html__( 'Doc Categories', 'elementor-addon' );
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
        return ['wp-guide', 'doc', 'categories', 'knowledge base'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_category_icon',
            [
                'label' => esc_html__( 'Category Icon', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'wp_guide_category_icon',
            [
                'label'   => __( 'Icon', 'text-domain' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'far fa-folder',
                    'library' => 'fa-regular'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_action_icon',
            [
                'label'   => __( 'Action Icon', 'text-domain' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'far fa-arrow-alt-circle-down',
                    'library' => 'fa-regular'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_uncollapse_category_icon',
            [
                'label' => esc_html__( 'UnCollapse Category Icon', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->add_control(
            'wp_guide_uncollapse_category_icon',
            [
                'label'   => __( 'Icon', 'text-domain' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'far fa-folder-open',
                    'library' => 'fa-regular'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_uncollapse_category_action_icon',
            [
                'label'   => __( 'Action Icon', 'text-domain' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'far fa-arrow-alt-circle-up',
                    'library' => 'fa-regular'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_category_style',
            [
                'label' => esc_html__( 'Categories', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'wp_guide_category_icon_size',
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
                    'size' => 15
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link i'   => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link svg' => 'width: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_action_icon_size',
            [
                'label'      => esc_html__( 'Action Icon Size', 'wp-guide' ),
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
                    'size' => 15
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .action_icon i'   => 'font-size: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .action_icon svg' => 'width: {{SIZE}}{{UNIT}} !important;'
                ]
            ]
        );

        $this->start_controls_tabs(
            'wp_guide_category_tabs'
        );

        $this->start_controls_tab(
            'wp_guide_category_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'textdomain' )
            ]
        );

        $this->add_control(
            'wp_guide_category_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_color',
            [
                'label'     => esc_html__( 'Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link .icon' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_action_color',
            [
                'label'     => esc_html__( 'Action Icon Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link .action_icon' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'wp_guide_category_active_tabs',
            [
                'label' => esc_html__( 'Active', 'textdomain' )
            ]
        );

        $this->add_control(
            'wp_guide_category_active_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#4f46e5',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .active' => 'background-color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_active_color',
            [
                'label'     => esc_html__( 'Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .active' => 'color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_active_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .active .icon' => 'color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_category_active_action_color',
            [
                'label'     => esc_html__( 'Action Icon Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .active .action_icon' => 'color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'wp_guide_category_padding',
            [
                'label'      => esc_html__( 'Padding (px)', 'shopengine' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '8',
                    'right'    => '20',
                    'bottom'   => '8',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .submenu-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'wp_guide_category_typography',
                'label'          => esc_html__( 'Typography', 'shopengine' ),
                'selector'       => '{{WRAPPER}} .wp-guide-doc-categories .submenu-link .title',
                'exclude'        => ['font_style', 'text_decoration', 'letter_spacing'],
                'fields_options' => [
                    'typography'     => [
                        'default' => 'custom'
                    ],
                    'font_size'      => [
                        'label'      => esc_html__( 'Font Size (px)', 'shopengine' ),
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
                        'label'      => esc_html__( 'Line Height (px)', 'shopengine' ),
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

        $this->start_controls_section(
            'section_documents_style',
            [
                'label' => esc_html__( 'Documents', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'wp_guide_docs_gap',
            [
                'label'      => esc_html__( 'Gap between', 'shopengine' ),
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
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents ul' => 'gap: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_docs_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#f1f5f9',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents ul' => 'background-color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_responsive_control(
            'wp_guide_docs_padding',
            [
                'label'      => esc_html__( 'Padding', 'shopengine' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '8',
                    'right'    => '20',
                    'bottom'   => '8',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents ul' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_responsive_control(
            'wp_guide_docs_margin',
            [
                'label'      => esc_html__( 'Margin', 'shopengine' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '0',
                    'right'    => '0',
                    'bottom'   => '0',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'       => 'wp_guide_docs_border',
                'selector'   => '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents',
                'size_units' => ['px'],
                'separator'  => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_document_style',
            [
                'label' => esc_html__( 'Document', 'textdomain' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs(
            'wp_guide_doc_tabs'
        );

        $this->start_controls_tab(
            'wp_guide_doc_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'textdomain' )
            ]
        );

        $this->add_control(
            'wp_guide_doc_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#f1f5f9',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents li' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_doc_color',
            [
                'label'     => esc_html__( 'Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents li a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'wp_guide_doc_active_tab',
            [
                'label' => esc_html__( 'Active', 'textdomain' )
            ]
        );

        $this->add_control(
            'wp_guide_doc_active_background_color',
            [
                'label'     => esc_html__( 'Background Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#f1f5f9',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents .active-doc' => 'background-color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_control(
            'wp_guide_doc_active_color',
            [
                'label'     => esc_html__( 'Color', 'shopengine' ),
                'type'      => Controls_Manager::COLOR,
                'alpha'     => false,
                'default'   => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents .active-doc a' => 'color: {{VALUE}} !important;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'       => 'wp_guide_doc_active_border',
                'size_units' => ['px'],
                'selector'   => '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents .active-doc'
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'wp_guide_doc_padding',
            [
                'label'      => esc_html__( 'Padding (px)', 'shopengine' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default'    => [
                    'top'      => '8',
                    'right'    => '20',
                    'bottom'   => '8',
                    'left'     => '20',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator'  => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'           => 'wp_guide_doc_typography',
                'label'          => esc_html__( 'Typography', 'shopengine' ),
                'selector'       => '{{WRAPPER}} .wp-guide-doc-categories .submenu .documents li a',
                'exclude'        => ['font_style', 'letter_spacing'],
                'fields_options' => [
                    'typography'     => [
                        'default' => 'custom'
                    ],
                    'font_size'      => [
                        'label'      => esc_html__( 'Font Size (px)', 'shopengine' ),
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
                        'label'      => esc_html__( 'Line Height (px)', 'shopengine' ),
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
		$settings = $this->get_settings_for_display();
		$elementor = \Elementor\Plugin::$instance;
		$docId     = false;

		if ( $elementor->editor->is_edit_mode() || is_preview()) {
			$docs = get_posts([
				'post_type' => wp_guide_docs_post_type(),
				'meta_query' => [
					[
						'key'     => 'wp_guide_product',
						'compare' => 'NOT EXISTS'
					],
					[
						'key'     => 'wp_guide_category',
						'compare' => 'NOT EXISTS'
					],
					[
						'key'     => 'categoryId',
						'compare'   => 'EXISTS'
					],
				],
				'limit' => 1
			]);
	
			if(isset($docs[0])) {
				$docId = $docs[0]->ID;
			}
	
		} else {
			global $post;
			$docId = $post->ID;
		}

		$productId  = get_post_meta( $docId, 'productId', true );
		$categories = get_post_meta( $productId, 'categories', true );
		if ( $categories ) {
			$categories = unserialize( $categories );
		} else {
			$categories = [];
		}
		?>
		<style>
			ul {
				list-style: none !important;
				margin: 0 !important;
				padding: 0;
			}

			.wp-guide-doc-categories .submenu .submenu-link {
				display: block;
				text-decoration: none;
			}
			.wp-guide-doc-categories .submenu .submenu-link .action_icon {
				float: right;
			}
			.wp-guide-doc-categories .submenu .documents ul {
				display: flex;
				flex-direction: column;
			}
		</style>
		<div class="wp-guide-doc-categories">
			<ul>
				<?php foreach($categories as $category):
					$docs            = [];
					$activeCategory  = false;

					if(!empty($category['docs'])) {
						$docs = get_posts([
							'post_type' => wp_guide_docs_post_type(),
							'orderby'   => 'post__in',
							'post__in'  => $category['docs']
						]);
						if(in_array($docId, $category['docs'])) {
							$activeCategory = true;
						}
					}

					if($category['categoryPostId'] != 0) { 
					
						$categoryPost  = get_post($category['categoryPostId']);
						$categoryTitle = $categoryPost->post_title;

						
					} else {
						$categoryTitle = esc_html__('Uncategorized', 'wp-guide');
						// $newDocs       = get_posts([
						// 	'post_type' => wp_guide_docs_post_type(),
						// 	'exclude' => $category['docs'], 
						// 	'meta_query' => [
						// 		[
						// 			'key'     => 'wp_guide_product',
						// 			'compare' => 'NOT EXISTS'
						// 		],
						// 		[
						// 			'key'     => 'wp_guide_category',
						// 			'compare' => 'NOT EXISTS'
						// 		],
						// 		[
						// 			'key'     => 'categoryId',
						// 			'compare'   => 'NOT EXISTS'
						// 		],
						// 		[
						// 			'key'     => 'productId',
						// 			'value'   => $productId
						// 		]
						// 	]
						// ]);
						// $docs = array_merge($docs, $newDocs);
					}
					?>
						<li class="submenu">
							<a href="javascript:void(0)" class="submenu-link <?php wp_commander_render($activeCategory ? 'active': '')?>">
								<span class="icon collapse" style="<?php wp_commander_render($activeCategory ? 'display: none;': '')?>">
									<?php Icons_Manager::render_icon($settings['wp_guide_category_icon'])?>
								</span>
								<span class="icon un_collapse" style="<?php wp_commander_render($activeCategory ? '': 'display: none;')?>">
									<?php Icons_Manager::render_icon($settings['wp_guide_uncollapse_category_icon'])?>
								</span>
								<span class="title">
									<?php wp_commander_render($categoryTitle)?>
								</span>
								<span class="action_icon collapse" style="<?php wp_commander_render($activeCategory ? 'display: none;': '')?>">
									<?php Icons_Manager::render_icon($settings['wp_guide_category_action_icon'])?>
								</span>
								<span class="action_icon un_collapse" style="<?php wp_commander_render($activeCategory ? '': 'display: none;')?>">
									<?php Icons_Manager::render_icon($settings['wp_guide_uncollapse_category_action_icon'])?>
								</span>
							</a>
							<div class="documents" style="<?php wp_commander_render($activeCategory ? '': 'display: none;')?>">
								<ul>
									<?php foreach($docs as $doc):?>
										<li class="<?php wp_commander_render($doc->ID === $docId ? 'active-doc': '')?>">
											<a href="<?php wp_commander_render( get_post_permalink( $doc ) )?>">
												<?php wp_commander_render($doc->post_title)?>
											</a>
										</li>
									<?php endforeach;?>
								</ul>
							</div>
						</li>
				<?php endforeach;?>
			</ul>
		</div>
	<?php
    }
}
