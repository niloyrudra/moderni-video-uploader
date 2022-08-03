<?php

class MVF_Elementor_Project_Form_Widget extends \Elementor\Widget_Base {

	protected function register_controls() {

		$this->start_controls_section(
            'content_section',
			[
				'label' => esc_html__( 'Content', 'moderni-form' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
            'mvf-project-submit-form',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__( 'Project Submit Form', 'moderni-form' ),
            ]
        );
        /**
         * SIZE
         * ======
         * Font Size
         */
        $this->add_control(
			'font_size',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Size', 'moderni-form' ),
				'size_units' => [ 'px', 'em', 'rem' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 200,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
			]
		);

        /**
         * COLOR
         * ======
         * Text Color
         */
        $this->add_control(
			'text_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => esc_html__( 'Text Color', 'plugin-name' ),
				'default' => '#fefefe',
			]
		);

        /**
         * MEDIA
         * =====
         * Attatch Image
         */
        /*$this->add_control(
			'image',
			[
				'type' => \Elementor\Controls_Manager::MEDIA,
				'label' => esc_html__( 'Choose Image', 'plugin-name' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);*/

		$this->add_responsive_control();

		$this->add_group_control();

		$this->end_controls_section();

	}

}