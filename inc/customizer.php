<?php
namespace conversions
{
	/**
		@brief		Customizer.
		@since		2019-08-15 23:01:47
	**/
	class Customizer
	{
		/**
			@brief		Constructor.
			@since		2019-08-15 23:01:47
		**/
		public function __construct()
		{
			add_action( 'conversions_footer_info', [ $this, 'conversions_footer_social' ], 20 );
			add_action( 'customize_register', [ $this, 'customize_register' ] );
			add_action( 'wp_footer', [ $this, 'wp_footer' ], 100 );
			add_action( 'wp_head', [ $this, 'wp_head' ], 99 );
			add_filter( 'wp_nav_menu_items', [ $this, 'wp_nav_menu_items' ], 10, 2 );
		}

		/**
			@brief		conversions_footer_social
			@since		2019-08-15 23:29:01
		**/
		public function conversions_footer_social()
		{
			// get option values and decode
			$conversions_si = get_theme_mod( 'conversions_social_icons' );
			$conversions_si_decoded = json_decode( $conversions_si );

			if ( !empty( $conversions_si_decoded ) ) {

				echo '<div class="social-media-icons col-md"><ul class="list-inline">';

				foreach ( $conversions_si_decoded as $repeater_item ) {

					// remove prefixes for titles and screen reader text
					$find = [ '/\bfas \b/', '/\bfab \b/', '/\bfar \b/', '/\bfa-\b/' ];
					$title = preg_replace($find, "", $repeater_item->icon_value);

					// output the icon and link
					echo sprintf( '<li class="list-inline-item"><a title="%1$s" href="%2$s" target="_blank"><i aria-hidden="true" class="%3$s"></i><span class="sr-only">%1$s</span></a></li>',
						esc_attr( $title ),
						esc_url( $repeater_item->link ),
						esc_attr( $repeater_item->icon_value )
					);
				}

				echo '</ul></div>';

			}

		}
		/**
			@brief		customize_register
			@since		2019-08-15 23:32:18
		**/
		public function customize_register( $wp_customize )
		{
			// require customizer repeater
			require get_template_directory() . '/inc/customizer_repeater.php';

			// font choices
			$font_choices = [
				'Comfortaa:400,700' => __( 'Comfortaa', 'conversions' ),
				'Droid Sans:400,700' => __( 'Droid Sans', 'conversions' ),
				'Droid Serif:400,700,400italic,700italic' => __( 'Droid Serif', 'conversions' ),
				'Handlee:400' => __( 'Handlee', 'conversions' ),
				'Indie Flower:400' => __( 'Indie Flower', 'conversions' ),
				'Lato:400,700,400italic,700italic' => __( 'Lato', 'conversions' ),
				'Libre Baskerville:400,400italic,700' => __( 'Libre Baskerville', 'conversions' ),
				'Lora:400,700,400italic,700italic' => __( 'Lora', 'conversions' ),
				'Merriweather:400,300italic,300,400italic,700,700italic' => __( 'Merriweather', 'conversions' ),
				'Open Sans:400italic,700italic,400,700' => __( 'Open Sans', 'conversions' ),
				'Oxygen:400,300,700' => __( 'Oxygen', 'conversions' ),
				'Roboto:400,400italic,700,700italic' => __( 'Roboto', 'conversions' ),
				'Roboto Slab:400,700' => __( 'Roboto Slab', 'conversions' ),
				'Special Elite:400' => __( 'Special Elite', 'conversions' ),
				'Ubuntu:400,700,400italic,700italic' => __( 'Ubuntu', 'conversions' ),
			];

			// button choices
			$button_choices = [
				'btn-primary' => __( 'Primary', 'conversions' ),
				'btn-secondary' => __( 'Secondary', 'conversions' ),
				'btn-success' => __( 'Success', 'conversions' ),
				'btn-danger' => __( 'Danger', 'conversions' ),
				'btn-warning' => __( 'Warning', 'conversions' ),
				'btn-info' => __( 'Info', 'conversions' ),
				'btn-light' => __( 'Light', 'conversions' ),
				'btn-dark' => __( 'Dark', 'conversions' ),
				'btn-outline-primary' => __( 'Primary outline', 'conversions' ),
				'btn-outline-secondary' => __( 'Secondary outline', 'conversions' ),
				'btn-outline-success' => __( 'Success outline', 'conversions' ),
				'btn-outline-danger' => __( 'Danger outline', 'conversions' ),
				'btn-outline-warning' => __( 'Warning outline', 'conversions' ),
				'btn-outline-info' => __( 'Info outline', 'conversions' ),
				'btn-outline-light' => __( 'Light outline', 'conversions' ),
				'btn-outline-dark' => __( 'Dark outline', 'conversions' ),
			];

			// extra button choices
			$extra_button_choices = [
				'no' => __( 'None', 'conversions' ),
			];

			// alt button choices
			$alt_button_choices = array_merge( $extra_button_choices , $button_choices );

			// gradient choices
			$gradient_choices = [
				'grade-grey' => __( 'Grade Grey', 'conversions' ),
				'cool-blues' => __( 'Cool Blues', 'conversions' ),
				'moonlit-asteroid' => __( 'Moonlit Asteroid', 'conversions' ),
				'evening-sunshine' => __( 'Evening Sunshine', 'conversions' ),
				'dark-ocean' => __( 'Dark Ocean', 'conversions' ),
				'cool-sky' => __( 'Cool Sky', 'conversions' ),
				'yoda' => __( 'Yoda', 'conversions' ),
				'memariani' => __( 'Memariani', 'conversions' ),
				'harvey' => __( 'Harvey', 'conversions' ),
				'witching-hour' => __( 'Witching Hour', 'conversions' ),
				'wiretap' => __( 'Wiretap', 'conversions' ),
				'magic' => __( 'Magic', 'conversions' ),
				'mellow' => __( 'Mellow', 'conversions' ),
				'crystal-clear' => __( 'Crystal Clear', 'conversions' ),
				'summer' => __( 'Summer', 'conversions' ),
				'burning-orange' => __( 'Burning Orange', 'conversions' ),
				'instagram' => __( 'Instagram', 'conversions' ),
				'dracula' => __( 'Dracula', 'conversions' ),
				'titanium' => __( 'Titanium', 'conversions' ),
				'moss' => __( 'Moss', 'conversions' ),
			];

			//-----------------------------------------------------
			// Remove some default sections
			//-----------------------------------------------------
			$wp_customize->get_section( 'colors' )->active_callback = '__return_false';
			$wp_customize->get_section( 'background_image' )->active_callback = '__return_false';

			//-----------------------------------------------------
			// Add logo height to site identity panel
			//-----------------------------------------------------
			$wp_customize->add_setting( 'conversions_logo_height', [
				'default'       => '2.5',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_float',
			] );
			$wp_customize->add_control( 'conversions_logo_height_control', [
				'label'      => __('Logo height', 'conversions'),
				'description'=> __('Max logo height in rem', 'conversions'),
				'section'    => 'title_tagline',
				'settings'   => 'conversions_logo_height',
				'priority'   => 8,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 0,
					'max' => 100,
					'step' => 0.1,
				],
			] );

			//-----------------------------------------------------
			// Navbar section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_nav' , [
				'title'             => __('Navbar', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			] );
			// Create our settings
			$wp_customize->add_setting( 'conversions_nav_colors', [
				'default'           => 'white',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_colors', [
						'label'       => __( 'Navbar color scheme', 'conversions' ),
						'description' => __( 'Select the Navbar color scheme.', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_colors',
						'type'        => 'select',
						'choices'     => [
							'dark' => __( 'Dark', 'conversions' ),
							'light' => __( 'Light', 'conversions' ),
							'white' => __( 'White', 'conversions' ),
							'primary' => __( 'Primary', 'conversions' ),
							'secondary' => __( 'Secondary', 'conversions' ),
							'success' => __( 'Success', 'conversions' ),
							'danger' => __( 'Danger', 'conversions' ),
							'warning' => __( 'Warning', 'conversions' ),
							'info' => __( 'Info', 'conversions' ),
						],
						'priority'    => '10',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_nav_position', [
				'default'           => 'fixed-top',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_position', [
						'label'       => __( 'Navbar position', 'conversions' ),
						'description' => __( 'Should the Navbar be fixed or normal?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_position',
						'type'        => 'select',
						'choices'     => [
							'header-p-n' => __( 'Normal', 'conversions' ),
							'fixed-top'       => __( 'Fixed', 'conversions' ),
						],
						'priority'    => '20',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_nav_dropshadow', [
				'default'           => true,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_dropshadow', [
						'label'       => __( 'Navbar drop shadow', 'conversions' ),
						'description' => __( 'Add a drop shadow to the Navbar?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_dropshadow',
						'type'        => 'checkbox',
						'priority'    => '30',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_nav_tbpadding', [
				'default'       => '.5',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_float',
			] );
			$wp_customize->add_control( 'conversions_nav_tbpadding_control', [
				'label'      => __( 'Navbar padding', 'conversions' ),
				'description'=> __( 'Top and bottom padding in rem.', 'conversions' ),
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_tbpadding',
				'priority'   => 40,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 0,
					'max' => 100,
					'step' => 0.1,
				],
			] );
			$wp_customize->add_setting( 'conversions_nav_search_icon', [
				'default'           => false,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_search_icon', [
						'label'       => __( 'Navbar search icon', 'conversions' ),
						'description' => __( 'Add a search icon to the Navbar?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_search_icon',
						'type'        => 'checkbox',
						'priority'    => '60',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_nav_button', [
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_button', [
						'label'       => __( 'Add button to Navbar?', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_button',
						'type'        => 'select',
						'choices'     => $alt_button_choices,
						'priority'    => '70',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_nav_button_text', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_nav_button_text_control', [
				'label'      => __( 'Button text', 'conversions' ),
				'description'=> __('Add text for button to display.', 'conversions'),
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_button_text',
				'priority'   => 80,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_nav_button_url', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			] );
			$wp_customize->add_control( 'conversions_nav_button_url_control', [
				'label'      => __( 'Button URL', 'conversions' ),
				'description'=> __('Where should the button link to?', 'conversions'),
				'section'    => 'conversions_nav',
				'settings'   => 'conversions_nav_button_url',
				'priority'   => 90,
				'type'       => 'url',
			] );
			$wp_customize->add_setting( 'conversions_nav_mobile_type', [
				'default'           => 'collapse',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_nav_mobile_type', [
						'label'       => __( 'Mobile menu type', 'conversions' ),
						'description' => __( 'Offcanvas or slide down mobile menu?', 'conversions' ),
						'section'     => 'conversions_nav',
						'settings'    => 'conversions_nav_mobile_type',
						'type'        => 'select',
						'choices'     => [
							'offcanvas' => __( 'Offcanvas', 'conversions' ),
							'collapse'       => __( 'Slide down', 'conversions' ),
						],
						'priority'    => '100',
					]
				)
			);

			//-----------------------------------------------------
			// Layout settings
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_layout_options', [
				'title'       => __( 'Layout', 'conversions' ),
				'capability'  => 'edit_theme_options',
				'priority'    => 21,
			] );
			$wp_customize->add_setting( 'conversions_sidebar_position', [
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_sidebar_position', [
						'label'       => __( 'Sidebar Positioning', 'conversions' ),
						'description' => __( 'Set the sidebar position: right, left, or none. Note: this can be overridden on individual pages.',
						'conversions' ),
						'section'     => 'conversions_layout_options',
						'settings'    => 'conversions_sidebar_position',
						'type'        => 'select',
						'choices'     => [
							'right' => __( 'Right', 'conversions' ),
							'left'  => __( 'Left', 'conversions' ),
							'none'  => __( 'None', 'conversions' ),
						],
						'priority'    => '20',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_sidebar_mv', [
				'default'           => true,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_sidebar_mv', [
						'label'       => __( 'Show sidebar on mobile?', 'conversions' ),
						'description' => __( 'Check to show the sidebar on mobile.',
						'conversions' ),
						'section'     => 'conversions_layout_options',
						'settings'    => 'conversions_sidebar_mv',
						'type'        => 'checkbox',
						'priority'    => '30',
					]
				)
			);

			//-----------------------------------------------------
			// Typography section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_typography', [
				'title'             => __('Typography', 'conversions'),
				'priority'          => 21,
				'description'       => __('Select your typography settings', 'conversions'),
				'capability'        => 'edit_theme_options',
			] );
			// Create our settings
			$wp_customize->add_setting( 'conversions_google_fonts', [
				'default'       => true,
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_google_fonts', [
						'label'       => __( 'Google fonts', 'conversions' ),
						'description' => __( 'Enable Google fonts? If disabled native fonts will be displayed instead.', 'conversions' ),
						'section'     => 'conversions_typography',
						'settings'    => 'conversions_google_fonts',
						'type'        => 'checkbox',
						'priority'    => '1',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_headings_fonts', [
				'default'       => 'Roboto:400,400italic,700,700italic',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_headings_fonts', [
						'label'       => __( 'Heading font', 'conversions' ),
						'description' => __( 'Select Google font for headings.', 'conversions' ),
						'section'     => 'conversions_typography',
						'settings'    => 'conversions_headings_fonts',
						'type'        => 'select',
						'choices' => $font_choices,
						'priority'    => '2',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_body_fonts', [
				'default'       => 'Roboto:400,400italic,700,700italic',
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_body_fonts', [
						'label'       => __( 'Body font', 'conversions' ),
						'description' => __( 'Select Google font for the body.', 'conversions' ),
						'section'     => 'conversions_typography',
						'settings'    => 'conversions_body_fonts',
						'type'        => 'select',
						'choices' => $font_choices,
						'priority'    => '3',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_link_color', [
				'default'       => '#0068d7',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_link_color_control', [
				'label'      => __('Link color', 'conversions'),
				'description'=> __('Select a color for hyperlinks.', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_link_color',
				'priority'   => 40,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_link_hcolor', [
				'default'       => '#00698c',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_link_hcolor_control', [
				'label'      => __('Link hover color', 'conversions'),
				'description'=> __('Select a hover color for hyperlinks.', 'conversions'),
				'section'    => 'conversions_typography',
				'settings'   => 'conversions_link_hcolor',
				'priority'   => 50,
				'type'       => 'color',
			] );

			//-----------------------------------------------------
			// Call to action section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_cta', [
				'title'             => __('Call to Action', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_hcta_state', [
				'default'       => false,
				'type'          => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_state', [
						'label'       => __( 'Call to Action section', 'conversions' ),
						'description' => __( 'Enable Call to Action section?', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_state',
						'type'        => 'checkbox',
						'priority'    => '1',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hcta_bg_choice', [
				'default'           => 'gradient',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_bg_choice', [
						'label'       => __( 'Background type', 'conversions' ),
						'description' => __( 'Select gradient, bootstrap colors, or custom.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_bg_choice',
						'type'        => 'select',
						'choices'     => [
							'bootstrap' => __( 'Bootstrap colors', 'conversions' ),
							'custom' => __( 'Custom colors', 'conversions' ),
							'gradient' => __( 'Gradient colors', 'conversions' ),
						],
						'priority'    => '2',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hcta_bg_gradient', [
				'default'           => 'crystal-clear',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_bg_gradient', [
						'label'       => __( 'Gradient colors', 'conversions' ),
						'description' => __( 'Call to Action section background color.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_bg_gradient',
						'type'        => 'select',
						'choices'     => $gradient_choices,
						'priority'    => '3',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hcta_bg_bootstrap', [
				'default'           => '',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_bg_bootstrap', [
						'label'       => __( 'Bootstrap colors', 'conversions' ),
						'description' => __( 'Call to Action section background color.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_bg_bootstrap',
						'type'        => 'select',
						'choices' => [
							'bg-primary' => __( 'Primary', 'conversions' ),
							'bg-secondary' => __( 'Secondary', 'conversions' ),
							'bg-success' => __( 'Success', 'conversions' ),
							'bg-danger' => __( 'Danger', 'conversions' ),
							'bg-warning' => __( 'Warning', 'conversions' ),
							'bg-info' => __( 'Info', 'conversions' ),
							'bg-light' => __( 'Light', 'conversions' ),
							'bg-dark' => __( 'Dark', 'conversions' ),
							'bg-white' => __( 'White', 'conversions' ),
						],
						'priority'    => '4',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hcta_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hcta_bg_color_control', [
				'label'      => __('Custom color', 'conversions'),
				'description'=> __('Call to Action section background color.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hcta_title', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_hcta_title_control', [
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_title',
				'priority'   => 20,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_hcta_title_color', [
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hcta_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hcta_desc', [
				'default' => '',
				'type'          => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_hcta_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_cta',
				'settings'   => 'conversions_hcta_desc',
				'priority' => 40,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_hcta_desc_color', [
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hcta_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hcta_btn', [
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hcta_btn', [
						'label'       => __( 'Callout button', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_cta',
						'settings'    => 'conversions_hcta_btn',
						'type'        => 'select',
						'choices'     => $alt_button_choices,
						'priority'    => '60',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hcta_btn_text', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_hcta_btn_text_control', [
				'label'      => __( 'Callout button text', 'conversions' ),
				'description'=> __('Add text for button to display.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_btn_text',
				'priority'   => 70,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_cta_btn_url', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			] );
			$wp_customize->add_control( 'conversions_cta_btn_url_control', [
				'label'      => __( 'Callout button URL', 'conversions' ),
				'description'=> __('Where should the button link to?', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_cta_btn_url',
				'priority'   => 80,
				'type'       => 'url',
			] );
			$wp_customize->add_setting( 'conversions_hcta_shortcode', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_kses_post',
			] );
			$wp_customize->add_control( 'conversions_hcta_shortcode_control', [
				'label'      => __('Shortcode', 'conversions'),
				'description'=> __('Add your shortcode.', 'conversions'),
				'section'    => 'conversions_cta',
				'settings'   => 'conversions_hcta_shortcode',
				'priority'   => 90,
				'type'       => 'text',
			] );

			//-----------------------------------------------------
			// Footer colors
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_footer' , [
				'title'             => __('Footer', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			] );
			// Create our settings
			$wp_customize->add_setting( 'conversions_footer_bg_color', [
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_footer_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Select a footer background color.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_footer_text_color', [
				'default'       => '#222222',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_footer_text_color_control', [
				'label'      => __('Text color', 'conversions'),
				'description'=> __('Select text color for footer.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_text_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_footer_link_color', [
				'default'       => '#0068d7',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_footer_link_color_control', [
				'label'      => __('Link color', 'conversions'),
				'description'=> __('Select hyperlink color for footer.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_link_color',
				'priority'   => 40,
				'type'       => 'color',
			] );

			$wp_customize->add_setting( 'conversions_footer_link_hcolor', [
				'default'       => '#00698c',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_footer_link_hcolor_control', [
				'label'      => __('Link hover color', 'conversions'),
				'description'=> __('Select hyperlink hover color for footer.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_footer_link_hcolor',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_copyright_text', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_copyright_text_control', [
				'label'      => __('Copyright text', 'conversions'),
				'description'=> __('Add your copyright text. If left blank the Site Title will be used instead.', 'conversions'),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_copyright_text',
				'priority'   => 60,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_social_size', [
				'default'       => '1.5',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_float',
			] );
			$wp_customize->add_control( 'conversions_social_size_control', [
				'label'      => __( 'Social icon size', 'conversions' ),
				'description'=> __( 'Icon size in rem', 'conversions' ),
				'section'    => 'conversions_footer',
				'settings'   => 'conversions_social_size',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 0,
					'max' => 100,
					'step' => 0.1,
				],
			] );
			$wp_customize->add_setting( 'conversions_social_icons', [
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_repeater_sanitize'
			] );
			$wp_customize->add_control(
				new \Conversions_Repeater(
				$wp_customize, 'conversions_social_icons', [
					'label'   => __('Icons','conversions'),
					'section' => 'conversions_footer',
					'priority' => 80,
					'customizer_repeater_icon_control' => true,
					'customizer_repeater_link_control' => true,
				]
			) );

			//-----------------------------------------------------
			// Blog section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_blog', [
				'title'             => __('Blog', 'conversions'),
				'priority'          => 21,
				'capability'        => 'edit_theme_options',
			] );
			// Create our settings
			$wp_customize->add_setting( 'conversions_blog_sticky_posts', [
				'default'           => 'primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_sticky_posts', [
						'label'       => __( 'Sticky post highlight color', 'conversions' ),
						'description' => __( 'Select the highlight color for sticky posts.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_sticky_posts',
						'type'        => 'select',
						'choices'     => [
							'no' => __( 'None', 'conversions' ),
							'primary' => __( 'Primary', 'conversions' ),
							'secondary' => __( 'Secondary', 'conversions' ),
							'success' => __( 'Success', 'conversions' ),
							'danger' => __( 'Danger', 'conversions' ),
							'warning' => __( 'Warning', 'conversions' ),
							'info' => __( 'Info', 'conversions' ),
						],
						'priority'    => '1',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_blog_more_btn', [
				'default'           => 'btn-secondary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_more_btn', [
						'label'       => __( 'Read more button type', 'conversions' ),
						'description' => __( 'Choose the read more button type shown on the blog index.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_more_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '2',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_comment_btn', [
				'default'           => 'btn-secondary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_comment_btn', [
						'label'       => __( 'Comment button type', 'conversions' ),
						'description' => __( 'Choose the comment button type.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_comment_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '3',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_blog_related', [
				'default'       => true,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_related', [
						'label'       => __( 'Show related posts', 'conversions' ),
						'description' => __( 'Enable related posts on single posts.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_related',
						'type'        => 'checkbox',
						'priority'    => '5',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_blog_taxonomy', [
				'default'       => 'categories',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_select',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_taxonomy', [
						'label'       => __( 'Related posts taxonomy', 'conversions' ),
						'description' => __( 'Use categories or tags to find related posts?', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_taxonomy',
						'type'        => 'select',
						'choices'    => [
							'tags' => __( 'Tags', 'conversions' ),
							'categories' => __( 'Categories', 'conversions' ),
						],
						'priority'    => '6',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_blog_postnav', [
				'default'       => true,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_blog_postnav', [
						'label'       => __( 'Show post navigation', 'conversions' ),
						'description' => __( 'Enable post navigation on single posts.', 'conversions' ),
						'section'     => 'conversions_blog',
						'settings'    => 'conversions_blog_postnav',
						'type'        => 'checkbox',
						'priority'    => '7',
					]
				)
			);

			//-----------------------------------------------------
			// Featured image section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_featured_img', [
				'title'             => __('Featured Image', 'conversions'),
				'priority'          => 21,
				'description'       => __('Settings for the featured image displayed on posts and pages.', 'conversions'),
				'capability'        => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_featured_img_parallax', [
				'default'       => false,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_featured_img_parallax', [
						'label'       => __( 'Fixed background image', 'conversions' ),
						'description' => __( 'Check to create a parallax effect when the visitor scrolls.', 'conversions' ),
						'section'     => 'conversions_featured_img',
						'settings'    => 'conversions_featured_img_parallax',
						'type'        => 'checkbox',
						'priority'    => '1',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_featured_img_height', [
				'default'       => '60',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_featured_img_height_control', [
				'label'      => __('Featured image height', 'conversions'),
				'description'=> __('Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions'),
				'section'    => 'conversions_featured_img',
				'settings'   => 'conversions_featured_img_height',
				'priority'   => 5,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 100,
				],
			] );
			$wp_customize->add_setting( 'conversions_featured_img_color', [
				'default'       => '#000000',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_featured_img_color_control', [
				'label'      => __('Overlay color', 'conversions'),
				'description'=> __('Select a color for the image overlay.', 'conversions'),
				'section'    => 'conversions_featured_img',
				'settings'   => 'conversions_featured_img_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_featured_img_overlay', [
				'default'           => '.5',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_featured_img_overlay', [
						'label'       => __( 'Overlay opacity', 'conversions' ),
						'description' => __( 'Lighten or darken the featured image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
						'section'     => 'conversions_featured_img',
						'settings'    => 'conversions_featured_img_overlay',
						'type'        => 'select',
						'choices'     => [
							'0' => __( '0%', 'conversions' ),
							'.1' => __( '10%', 'conversions' ),
							'.2' => __( '20%', 'conversions' ),
							'.3' => __( '30%', 'conversions' ),
							'.4' => __( '40%', 'conversions' ),
							'.5' => __( '50%', 'conversions' ),
							'.6' => __( '60%', 'conversions' ),
							'.7' => __( '70%', 'conversions' ),
							'.8' => __( '80%', 'conversions' ),
							'.9' => __( '90%', 'conversions' ),
							'1' => __( '100%', 'conversions' ),
						],
						'priority'    => '20',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_featured_title_color', [
				'default'       => '#ffffff',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_featured_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title text.', 'conversions'),
				'section'    => 'conversions_featured_img',
				'settings'   => 'conversions_featured_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );

			//-----------------------------------------------------
			// WooCommerce Options
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_woocommerce', [
				'title' => __( 'Conversions', 'conversions' ),
				'description'       => __('WooCommerce options for Conversions theme.', 'conversions'),
				'capability'        => 'edit_theme_options',
				'panel'             => 'woocommerce',
				'priority' => 100,
				'theme_supports' => [ 'woocommerce' ],
			] );
			// Create our settings
			$wp_customize->add_setting( 'conversions_wc_cart_nav', [
				'default'           => true,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_cart_nav', [
						'label'       => __( 'Cart icon in navbar', 'conversions' ),
						'description' => __( 'Enable cart icon in the navbar.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_cart_nav',
						'type'        => 'checkbox',
						'priority'    => '10',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_wc_account', [
				'default'           => false,
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_account', [
						'label'       => __( 'Account icon in navbar', 'conversions' ),
						'description' => __( 'Enable Account icon in the navbar.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_account',
						'type'        => 'checkbox',
						'priority'    => '20',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_wc_checkout_columns', [
				'default'           => 'two-column',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_checkout_columns', [
						'label'       => __( 'Checkout columns', 'conversions' ),
						'description' => __( 'How many columns should the checkout be?', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_checkout_columns',
						'type'        => 'select',
						'choices'     => [
							'two-column' => __( 'Two column', 'conversions' ),
							'one-column'       => __( 'One column', 'conversions' ),
						],
						'priority'    => '30',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_wc_primary_btn', [
				'default'           => 'btn-outline-primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_primary_btn', [
						'label'       => __( 'Primary button type', 'conversions' ),
						'description' => __( 'Select the primary button type. Applies to: add to cart, apply coupon, update cart, login, register, etc.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_primary_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '40',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_wc_secondary_btn', [
				'default'           => 'btn-primary',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_wc_secondary_btn', [
						'label'       => __( 'Secondary button type', 'conversions' ),
						'description' => __( 'Select the secondary button type. Applies to: view cart, proceed to checkout, place order, etc.', 'conversions' ),
						'section'     => 'conversions_woocommerce',
						'settings'    => 'conversions_wc_secondary_btn',
						'type'        => 'select',
						'choices' => $button_choices,
						'priority'    => '45',
					]
				)
			);

			//-----------------------------------------------------
			// Homepage section
			//-----------------------------------------------------
			$wp_customize->add_panel( 'conversions_homepage', [
				'priority'          => 119,
				'title'             => __('Homepage Design', 'conversions'),
				'description'       => __('Settings for the Homepage template', 'conversions'),
				'capability'        => 'edit_theme_options',
			] );

			//-----------------------------------------------------
			// Homepage Hero section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_hero', [
				'title'             => __('Hero', 'conversions'),
				'priority'          => 10,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			] );
			$wp_customize->add_setting( 'conversions_hh_title_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hh_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_title_color',
				'priority'   => 2,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hh_desc', [
				'default' => '',
				'type'          => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_hh_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_desc',
				'priority' => 3,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_hh_desc_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hh_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_desc_color',
				'priority'   => 4,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hh_content_position', [
				'default'           => 'col-lg-6',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_content_position', [
						'label'       => __( 'Content position', 'conversions' ),
						'description' => __( 'Select the content display position.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_content_position',
						'type'        => 'select',
						'choices'     => [
							'col-lg-6' => __( 'Left', 'conversions' ),
							'col-lg-10 d-flex flex-column text-center mx-auto' => __( 'Center', 'conversions' ),
						],
						'priority'    => '5',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hh_img_parallax', [
				'default'       => false,
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_checkbox',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_img_parallax', [
						'label'       => __( 'Fixed background image', 'conversions' ),
						'description' => __( 'Check to create a parallax effect when the visitor scrolls.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_img_parallax',
						'type'        => 'checkbox',
						'priority'    => '6',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hh_img_height', [
				'default'       => '72',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_hh_img_height_control', [
				'label'      => __('Hero image height', 'conversions'),
				'description'=> __('Height in vh units. 10vh is relative to 10% of the current viewport height.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_img_height',
				'priority'   => 7,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 100,
				],
			] );
			$wp_customize->add_setting( 'conversions_hh_img_color', [
				'default'       => '#000000',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hh_img_color_control', [
				'label'      => __('Image overlay color', 'conversions'),
				'description'=> __('Select a color for the image overlay.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_img_color',
				'priority'   => 8,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hh_img_overlay', [
				'default'           => '.5',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_img_overlay', [
						'label'       => __( 'Image overlay opacity', 'conversions' ),
						'description' => __( 'Lighten or darken the hero image overlay. Set the contrast high enough so the text is readable.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_img_overlay',
						'type'        => 'select',
						'choices'     => [
							'0' => __( '0%', 'conversions' ),
							'.1' => __( '10%', 'conversions' ),
							'.2' => __( '20%', 'conversions' ),
							'.3' => __( '30%', 'conversions' ),
							'.4' => __( '40%', 'conversions' ),
							'.5' => __( '50%', 'conversions' ),
							'.6' => __( '60%', 'conversions' ),
							'.7' => __( '70%', 'conversions' ),
							'.8' => __( '80%', 'conversions' ),
							'.9' => __( '90%', 'conversions' ),
							'1' => __( '100%', 'conversions' ),
						],
						'priority'    => '9',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hh_button', [
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_button', [
						'label'       => __( 'Callout button', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_button',
						'type'        => 'select',
						'choices'     => $alt_button_choices,
						'priority'    => '10',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hh_button_text', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_hh_button_text_control', [
				'label'      => __( 'Callout button text', 'conversions' ),
				'description'=> __('Add text for button to display.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_button_text',
				'priority'   => 11,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_hh_button_url', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			] );
			$wp_customize->add_control( 'conversions_hh_button_url_control', [
				'label'      => __( 'Callout button URL', 'conversions' ),
				'description'=> __('Where should the button link to?', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_button_url',
				'priority'   => 12,
				'type'       => 'url',
			] );
			$wp_customize->add_setting( 'conversions_hh_vbtn', [
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hh_vbtn', [
						'label'       => __( 'Video modal button', 'conversions' ),
						'description' => __( 'Choose the type of button.', 'conversions' ),
						'section'     => 'conversions_homepage_hero',
						'settings'    => 'conversions_hh_vbtn',
						'type'        => 'select',
						'choices'     => [
							'no' => __( 'None', 'conversions' ),
							'primary' => __( 'Primary', 'conversions' ),
							'secondary' => __( 'Secondary', 'conversions' ),
							'success' => __( 'Success', 'conversions' ),
							'danger' => __( 'Danger', 'conversions' ),
							'warning' => __( 'Warning', 'conversions' ),
							'info' => __( 'Info', 'conversions' ),
							'light' => __( 'Light', 'conversions' ),
							'dark' => __( 'Dark', 'conversions' ),
						],
						'priority'    => '13',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hh_vbtn_text', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_hh_vbtn_text_control', [
				'label'      => __( 'Video button text', 'conversions' ),
				'description'=> __('Text to display next to the video button.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_vbtn_text',
				'priority'   => 14,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_hh_vbtn_url', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'esc_url_raw',
			] );
			$wp_customize->add_control( 'conversions_hh_vbtn_url_control', [
				'label'      => __( 'Video URL', 'conversions' ),
				'description'=> __('Youtube or Vimeo video URL.', 'conversions'),
				'section'    => 'conversions_homepage_hero',
				'settings'   => 'conversions_hh_vbtn_url',
				'priority'   => 15,
				'type'       => 'url',
			] );

			//-----------------------------------------------------
			// Homepage Clients section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_clients', [
				'title'             => __('Clients', 'conversions'),
				'priority'          => 20,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			] );
			$wp_customize->add_setting( 'conversions_hc_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_hc_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Client section background color.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_hc_logo_width', [
				'default'       => '6.2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_sanitize_float',
			] );
			$wp_customize->add_control( 'conversions_hc_logo_width_control', [
				'label'      => __('Client logo width', 'conversions'),
				'description'=> __('Logo max-width in rem', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_logo_width',
				'priority'   => 20,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 0,
					'max' => 100,
					'step' => 0.1,
				],
			] );
			$wp_customize->add_setting( 'conversions_hc_respond', [
				'default'           => 'auto',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_hc_respond', [
						'label'       => __( 'Responsive', 'conversions' ),
						'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
						'section'     => 'conversions_homepage_clients',
						'settings'    => 'conversions_hc_respond',
						'type'        => 'select',
						'choices'     => [
							'auto' => __( 'Auto', 'conversions' ),
							'manual' => __( 'Manual', 'conversions' ),
						],
						'priority'    => '30',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_hc_sm', [
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_hc_sm_control', [
				'label'      => __('# of items up to 576px', 'conversions'),
				'description'=> __('Number of items to show up to 576px.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_sm',
				'priority'   => 40,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 50,
				],
			] );
			$wp_customize->add_setting( 'conversions_hc_md', [
				'default'       => '3',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_hc_md_control', [
				'label'      => __('# of items up to 768px', 'conversions'),
				'description'=> __('Number of items to show up to 768px.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_md',
				'priority'   => 50,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 50,
				],
			] );
			$wp_customize->add_setting( 'conversions_hc_lg', [
				'default'       => '4',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_hc_lg_control', [
				'label'      => __('# of items up to 992px', 'conversions'),
				'description'=> __('Number of items to show up to 992px.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_lg',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 50,
				],
			] );
			$wp_customize->add_setting( 'conversions_hc_max', [
				'default'       => '5',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_hc_max_control', [
				'label'      => __('Max items to show', 'conversions'),
				'description'=> __('Max number of items to show at once.', 'conversions'),
				'section'    => 'conversions_homepage_clients',
				'settings'   => 'conversions_hc_max',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 50,
				],
			] );
			$wp_customize->add_setting( 'conversions_hc_logos', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_repeater_sanitize',
			] );
			$wp_customize->add_control(
				new \Conversions_Repeater(
					$wp_customize,
					'conversions_hc_logos', [
						'label'   => __( 'Client logo', 'conversions' ),
						'section' => 'conversions_homepage_clients',
						'priority' => 80,
						'customizer_repeater_image_control' => true,
					]
				)
			);

			//-----------------------------------------------------
			// Homepage Features section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_features', [
				'title'             => __('Features', 'conversions'),
				'priority'          => 30,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			] );
			$wp_customize->add_setting( 'conversions_features_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_features_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Features section background color.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_features_title', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_features_title_control', [
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_title',
				'priority'   => 20,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_features_title_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_features_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_features_desc', [
				'default' => '',
				'type' => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_features_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_homepage_features',
				'settings'   => 'conversions_features_desc',
				'priority' => 40,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_features_desc_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_features_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_features_sm', [
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_features_sm_control', [
				'label'      => __('# of items on small screens', 'conversions'),
				'description'=> __('Items to show 576px to 767px. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_sm',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_features_md', [
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_features_md_control', [
				'label'      => __('# of items on medium screens', 'conversions'),
				'description'=> __('Items to show 768px to 991px. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_md',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_features_lg', [
				'default'       => '3',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_features_lg_control', [
				'label'      => __('# of items on large screens', 'conversions'),
				'description'=> __('Items to show 992px up. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_features',
				'settings'   => 'conversions_features_lg',
				'priority'   => 80,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_features_icons', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_repeater_sanitize',
			] );
			$wp_customize->add_control(
				new \Conversions_Repeater(
					$wp_customize,
					'conversions_features_icons', [
						'label'   => __( 'Icon block', 'conversions' ),
						'section' => 'conversions_homepage_features',
						'priority' => 90,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_color_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_linktext_control' => true,
						'customizer_repeater_link_control' => true,
					]
				)
			);

			//-----------------------------------------------------
			// Homepage Pricing section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_pricing', [
				'title'             => __('Pricing', 'conversions'),
				'priority'          => 59,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			] );
			$wp_customize->add_setting( 'conversions_pricing_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_pricing_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Pricing section background color.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_pricing_title', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_pricing_title_control', [
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_title',
				'priority'   => 20,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_pricing_title_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_pricing_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_pricing_desc', [
				'default' => '',
				'type' => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_pricing_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_desc',
				'priority' => 40,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_pricing_desc_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_pricing_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_pricing_respond', [
				'default'           => 'auto',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_pricing_respond', [
						'label'       => __( 'Responsive', 'conversions' ),
						'description' => __( 'Select auto or manual item breakpoints.', 'conversions' ),
						'section'     => 'conversions_homepage_pricing',
						'settings'    => 'conversions_pricing_respond',
						'type'        => 'select',
						'choices'     => [
							'auto' => __( 'Auto', 'conversions' ),
							'manual' => __( 'Manual', 'conversions' ),
						],
						'priority'    => '55',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_pricing_sm', [
				'default'       => '1',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_pricing_sm_control', [
				'label'      => __('# of items on small screens', 'conversions'),
				'description'=> __('Items to show 576px to 767px. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_sm',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_pricing_md', [
				'default'       => '1',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_pricing_md_control', [
				'label'      => __('# of items on medium screens', 'conversions'),
				'description'=> __('Items to show 768px to 991px. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_md',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_pricing_lg', [
				'default'       => '3',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_pricing_lg_control', [
				'label'      => __('# of items on large screens', 'conversions'),
				'description'=> __('Items to show 992px up. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_pricing',
				'settings'   => 'conversions_pricing_lg',
				'priority'   => 80,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_pricing_repeater', [
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_repeater_sanitize',
			] );
			$wp_customize->add_control(
				new \Conversions_Repeater(
					$wp_customize,
					'conversions_pricing_repeater', [
						'label'   => __( 'Pricing table', 'conversions' ),
						'section' => 'conversions_homepage_pricing',
						'priority' => 90,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_subtitle2_control' => true,
						'customizer_repeater_linktext_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_repeater_control' => true
					]
				)
			);

			//-----------------------------------------------------
			// Homepage Testimonials section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_testimonials', [
				'title'             => __('Testimonials', 'conversions'),
				'priority'          => 60,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			] );
			$wp_customize->add_setting( 'conversions_testimonials_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_testimonials_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Testimonials section background color.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_testimonials_title', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_testimonials_title_control', [
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_title',
				'priority'   => 20,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_testimonials_title_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_testimonials_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_testimonials_desc', [
				'default' => '',
				'type' => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_testimonials_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_desc',
				'priority' => 40,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_testimonials_desc_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_testimonials_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_testimonials',
				'settings'   => 'conversions_testimonials_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_testimonials_repeater', [
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'conversions_repeater_sanitize',
			] );
			$wp_customize->add_control(
				new \Conversions_Repeater(
					$wp_customize,
					'conversions_testimonials_repeater', [
						'label'   => __( 'Testimonials', 'conversions' ),
						'section' => 'conversions_homepage_testimonials',
						'priority' => 60,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_text_control' => true,
					]
			) );

			//-----------------------------------------------------
			// Homepage News section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_news', [
				'title'             => __('News', 'conversions'),
				'priority'          => 70,
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
			] );
			$wp_customize->add_setting( 'conversions_news_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_news_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('Call to Action section background color.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_news_title', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_news_title_control', [
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_title',
				'priority'   => 20,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_news_title_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_news_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_news_desc', [
				'default' => '',
				'type'          => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_news_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_homepage_news',
				'settings'   => 'conversions_news_desc',
				'priority' => 40,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_news_desc_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_news_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_news_mposts', [
				'default'       => '2',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_news_mposts_control', [
				'label'      => __('# of posts to show on mobile', 'conversions'),
				'description'=> __('Number of posts to show from 992px and down.', 'conversions'),
				'section'    => 'conversions_homepage_news',
				'settings'   => 'conversions_news_mposts',
				'priority'   => 60,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 3,
				],
			] );

			//-----------------------------------------------------
			// Homepage WooCommerce section
			//-----------------------------------------------------
			$wp_customize->add_section( 'conversions_homepage_woo', [
				'title' => __( 'WooCommerce', 'conversions' ),
				'capability'        => 'edit_theme_options',
				'panel'             => 'conversions_homepage',
				'priority' => 31,
				'theme_supports' => [ 'woocommerce' ],
			] );
			$wp_customize->add_setting( 'conversions_woo_bg_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_woo_bg_color_control', [
				'label'      => __('Background color', 'conversions'),
				'description'=> __('WooCommerce section background color.', 'conversions'),
				'section'    => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_bg_color',
				'priority'   => 10,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_woo_title', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'wp_filter_nohtml_kses',
			] );
			$wp_customize->add_control( 'conversions_woo_title_control', [
				'label'      => __('Title', 'conversions'),
				'description'=> __('Add your title.', 'conversions'),
				'section'    => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_title',
				'priority'   => 20,
				'type'       => 'text',
			] );
			$wp_customize->add_setting( 'conversions_woo_title_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_woo_title_color_control', [
				'label'      => __('Title color', 'conversions'),
				'description'=> __('Select a color for the title.', 'conversions'),
				'section'    => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_title_color',
				'priority'   => 30,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_woo_desc', [
				'default' => '',
				'type'          => 'theme_mod',
				'transport' => 'refresh',
				'sanitize_callback' => 'wp_kses_post'
			] );
			$wp_customize->add_control( 'conversions_woo_desc', [
				'label'      => __('Description', 'conversions'),
				'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
				'section' => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_desc',
				'priority' => 40,
				'type' => 'textarea',
				'capability' => 'edit_theme_options',
			] );
			$wp_customize->add_setting( 'conversions_woo_desc_color', [
				'default'       => '',
				'type'          => 'theme_mod',
				'transport'     => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			] );
			$wp_customize->add_control( 'conversions_woo_desc_color_control', [
				'label'      => __('Description color', 'conversions'),
				'description'=> __('Select a color for the description text.', 'conversions'),
				'section'    => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_desc_color',
				'priority'   => 50,
				'type'       => 'color',
			] );
			$wp_customize->add_setting( 'conversions_woo_products', [
				'default'           => 'no',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_woo_products', [
						'label'       => __( 'Product type', 'conversions' ),
						'description' => __( 'Select the type of WooCommerce products to show.', 'conversions' ),
						'section'     => 'conversions_homepage_woo',
						'settings'    => 'conversions_woo_products',
						'type'        => 'select',
						'choices'     => [
							'no' => __( 'None', 'conversions' ),
							'all' => __( 'All', 'conversions' ),
							'on_sale' => __( 'On sale', 'conversions' ),
						],
						'priority'    => '60',
					]
				)
			);
			$wp_customize->add_setting( 'conversions_woo_product_limit', [
				'default'       => '8',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_woo_product_limit', [
				'label'      => __('Products limit', 'conversions'),
				'description'=> __('The number of products to display. Choose 1-12.', 'conversions'),
				'section'    => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_product_limit',
				'priority'   => 70,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 12,
				],
			] );
			$wp_customize->add_setting( 'conversions_woo_product_columns', [
				'default'       => '4',
				'type'          => 'theme_mod',
				'capability'    => 'edit_theme_options',
				'transport'     => 'refresh',
				'sanitize_callback' => 'absint',
			] );
			$wp_customize->add_control( 'conversions_woo_product_columns', [
				'label'      => __('Product columns', 'conversions'),
				'description'=> __('The number of columns to display. Choose 1-4.', 'conversions'),
				'section'    => 'conversions_homepage_woo',
				'settings'   => 'conversions_woo_product_columns',
				'priority'   => 80,
				'type'       => 'number',
				'input_attrs'=> [
					'min' => 1,
					'max' => 4,
				],
			] );
			$wp_customize->add_setting( 'conversions_woo_products_order', [
				'default'           => 'popularity',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'conversions_sanitize_select',
				'capability'        => 'edit_theme_options',
				'transport'     => 'refresh',
			] );
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'conversions_woo_products_order', [
						'label'       => __( 'Products orderby', 'conversions' ),
						'description' => __( 'Sorts the products displayed by the entered option.', 'conversions' ),
						'section'     => 'conversions_homepage_woo',
						'settings'    => 'conversions_woo_products_order',
						'type'        => 'select',
						'choices'     => [
							'date' => __( 'Date', 'conversions' ),
							'popularity' => __( 'Popularity', 'conversions' ),
							'rand' => __( 'Random', 'conversions' ),
							'rating' => __( 'Rating', 'conversions' ),
							'title' => __( 'title', 'conversions' ),
						],
						'priority'    => '90',
					]
				)
			);

			//-----------------------------------------------------
			// Homepage Easy Digital Downloads section
			//-----------------------------------------------------
			if ( class_exists( 'Easy_Digital_Downloads' ) ) {

				$wp_customize->add_section( 'conversions_homepage_edd', [
					'title' => __( 'Easy Digital Downloads', 'conversions' ),
					'capability'        => 'edit_theme_options',
					'panel'             => 'conversions_homepage',
					'priority' 			=> 32,
				] );
				$wp_customize->add_setting( 'conversions_edd_bg_color', [
					'default'       => '',
					'type'          => 'theme_mod',
					'transport'     => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				] );
				$wp_customize->add_control( 'conversions_edd_bg_color_control', [
					'label'      => __('Background color', 'conversions'),
					'description'=> __('Easy Digital Downloads section background color.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_bg_color',
					'priority'   => 10,
					'type'       => 'color',
				] );
				$wp_customize->add_setting( 'conversions_edd_title', [
					'default'       => '',
					'type'          => 'theme_mod',
					'transport'     => 'refresh',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				] );
				$wp_customize->add_control( 'conversions_edd_title_control', [
					'label'      => __('Title', 'conversions'),
					'description'=> __('Add your title.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_title',
					'priority'   => 20,
					'type'       => 'text',
				] );
				$wp_customize->add_setting( 'conversions_edd_title_color', [
					'default'       => '',
					'type'          => 'theme_mod',
					'transport'     => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				] );
				$wp_customize->add_control( 'conversions_edd_title_color_control', [
					'label'      => __('Title color', 'conversions'),
					'description'=> __('Select a color for the title.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_title_color',
					'priority'   => 30,
					'type'       => 'color',
				] );
				$wp_customize->add_setting( 'conversions_edd_desc', [
					'default' 	=> '',
					'type'		=> 'theme_mod',
					'transport' => 'refresh',
					'sanitize_callback' => 'wp_kses_post'
				] );
				$wp_customize->add_control( 'conversions_edd_desc', [
					'label'      => __('Description', 'conversions'),
					'description'=> __('Add some description text. HTML is allowed.', 'conversions'),
					'section' => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_desc',
					'priority' => 40,
					'type' => 'textarea',
					'capability' => 'edit_theme_options',
				] );
				$wp_customize->add_setting( 'conversions_edd_desc_color', [
					'default'       => '',
					'type'          => 'theme_mod',
					'transport'     => 'refresh',
					'sanitize_callback' => 'sanitize_hex_color',
				] );
				$wp_customize->add_control( 'conversions_edd_desc_color_control', [
					'label'      => __('Description color', 'conversions'),
					'description'=> __('Select a color for the description text.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_desc_color',
					'priority'   => 50,
					'type'       => 'color',
				] );
				$wp_customize->add_setting( 'conversions_edd_products', [
					'default'           => 'no',
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_select',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_products', [
							'label'       => __( 'Product type', 'conversions' ),
							'description' => __( 'Select the type of products to show.', 'conversions' ),
							'section'     => 'conversions_homepage_edd',
							'settings'    => 'conversions_edd_products',
							'type'        => 'select',
							'choices'     => [
								'no' => __( 'None', 'conversions' ),
								'all' => __( 'All', 'conversions' ),
								'category' => __( 'Category', 'conversions' ),
								'tags' => __( 'Tags', 'conversions' ),
							],
							'priority'    => '60',
						]
					)
				);
				$wp_customize->add_setting( 'conversions_edd_product_tax', [
					'default'       => '',
					'type'          => 'theme_mod',
					'transport'     => 'refresh',
					'sanitize_callback' => 'wp_filter_nohtml_kses',
				] );
				$wp_customize->add_control( 'conversions_edd_product_tax_control', [
					'label'      => __('Category or tags IDs', 'conversions'),
					'description'=> __('Both the category and tags parameters accept a comma separated list IDs.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_product_tax',
					'priority'   => 61,
					'type'       => 'text',
				] );
				$wp_customize->add_setting( 'conversions_edd_product_limit', [
					'default'       => '6',
					'type'          => 'theme_mod',
					'capability'    => 'edit_theme_options',
					'transport'     => 'refresh',
					'sanitize_callback' => 'absint',
				] );
				$wp_customize->add_control( 'conversions_edd_product_limit', [
					'label'      => __('Products limit', 'conversions'),
					'description'=> __('The number of products to display. Choose 1-12.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_product_limit',
					'priority'   => 70,
					'type'       => 'number',
					'input_attrs'=> [
						'min' => 1,
						'max' => 12,
					],
				] );
				$wp_customize->add_setting( 'conversions_edd_product_columns', [
					'default'       => '3',
					'type'          => 'theme_mod',
					'capability'    => 'edit_theme_options',
					'transport'     => 'refresh',
					'sanitize_callback' => 'absint',
				] );
				$wp_customize->add_control( 'conversions_edd_product_columns', [
					'label'      => __('Product columns', 'conversions'),
					'description'=> __('The number of columns to display. Choose 1-4.', 'conversions'),
					'section'    => 'conversions_homepage_edd',
					'settings'   => 'conversions_edd_product_columns',
					'priority'   => 80,
					'type'       => 'number',
					'input_attrs'=> [
						'min' => 1,
						'max' => 4,
					],
				] );
				$wp_customize->add_setting( 'conversions_edd_products_orderby', [
					'default'           => 'post_date',
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_select',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_products_orderby', [
							'label'       => __( 'Products orderby', 'conversions' ),
							'description' => __( 'Sorts the products displayed by the entered category.', 'conversions' ),
							'section'     => 'conversions_homepage_edd',
							'settings'    => 'conversions_edd_products_orderby',
							'type'        => 'select',
							'choices'     => [
								'post_date' => __( 'Date', 'conversions' ),
								'price' => __( 'Price', 'conversions' ),
								'random' => __( 'Random', 'conversions' ),
								'title' => __( 'Title', 'conversions' ),
							],
							'priority'    => '90',
						]
					)
				);
				$wp_customize->add_setting( 'conversions_edd_products_order', [
					'default'           => 'DESC',
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_select',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_products_order', [
							'label'       => __( 'Products order', 'conversions' ),
							'description' => __( 'Select ascending (small to large) or Descending (large to small) order.', 'conversions' ),
							'section'     => 'conversions_homepage_edd',
							'settings'    => 'conversions_edd_products_order',
							'type'        => 'select',
							'choices'     => [
								'ASC' => __( 'Ascending', 'conversions' ),
								'DESC' => __( 'Descending', 'conversions' ),
							],
							'priority'    => '100',
						]
					)
				);
			}

			//-----------------------------------------------------
			// Easy Digital Downloads - General
			//-----------------------------------------------------
			if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			
				$wp_customize->add_section( 'conversions_edd', [
					'title'             => __('Easy Digital Downloads', 'conversions'),
					'description'       => __('Settings for Easy Digital Downloads.', 'conversions'),
					'priority'          => 121,
					'capability'        => 'edit_theme_options',
				] );
				// Create our settings
				$wp_customize->add_setting( 'conversions_edd_nav_cart', [
					'default'           => true,
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_checkbox',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_nav_cart', [
							'label'       => __( 'Cart icon in navbar', 'conversions' ),
							'description' => __( 'Enable cart icon in the navbar.', 'conversions' ),
							'section'     => 'conversions_edd',
							'settings'    => 'conversions_edd_nav_cart',
							'type'        => 'checkbox',
							'priority'    => '10',
						]
					)
				);
				$wp_customize->add_setting( 'conversions_edd_nav_account', [
					'default'           => false,
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_checkbox',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_nav_account', [
							'label'       => __( 'Account icon in navbar', 'conversions' ),
							'description' => __( 'Enable Account icon in the navbar.', 'conversions' ),
							'section'     => 'conversions_edd',
							'settings'    => 'conversions_edd_nav_account',
							'type'        => 'checkbox',
							'priority'    => '20',
						]
					)
				);
				$wp_customize->add_setting( 'conversions_edd_primary_btn', [
					'default'           => 'btn-primary',
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_select',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_primary_btn', [
							'label'       => __( 'Primary button type', 'conversions' ),
							'description' => __( 'Select the primary button type. Applies to: add to cart, checkout, etc.', 'conversions' ),
							'section'     => 'conversions_edd',
							'settings'    => 'conversions_edd_primary_btn',
							'type'        => 'select',
							'choices' => $button_choices,
							'priority'    => '30',
						]
					)
				);
				$wp_customize->add_setting( 'conversions_edd_download_details', [
					'default'           => true,
					'type'              => 'theme_mod',
					'sanitize_callback' => 'conversions_sanitize_checkbox',
					'capability'        => 'edit_theme_options',
					'transport'     => 'refresh',
				] );
				$wp_customize->add_control(
					new \WP_Customize_Control(
						$wp_customize,
						'conversions_edd_download_details', [
							'label'       => __( 'Download details', 'conversions' ),
							'description' => __( 'Show download details on single posts: date, categories, tags, etc.', 'conversions' ),
							'section'     => 'conversions_edd',
							'settings'    => 'conversions_edd_download_details',
							'type'        => 'checkbox',
							'priority'    => '40',
						]
					)
				);

			}

		}

		/**
			@brief		wp_footer
			@since		2019-08-15 23:16:11
		**/
		public function wp_footer()
		{
			if ( get_theme_mod( 'conversions_nav_search_icon', false ) == true ) {
				// Add modal window for search
				$search_form = get_search_form(false);
				echo '<div id="csearchModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="csearchModal__label" aria-hidden="true">',
					'<div class="modal-dialog">',
						'<div class="modal-content">',
							'<div class="modal-header">',
								'<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times"></i></span></button>',
							'</div>',
							'<div class="modal-body">',
								'<h3 id="csearchModal__label" class="modal-title">'.esc_html__( 'Start typing and press enter to search', 'conversions' ).'</h3>',
								''.$search_form.'',
							'</div>',
						'</div>',
					'</div>',
				'</div>';
			}
		}
		/**
			@brief		wp_head
			@since		2019-08-15 23:12:24
		**/
		public function wp_head()
		{
			// font variables
			if ( get_theme_mod( 'conversions_google_fonts', true ) == true ) {
				// headings
				$headings_font = get_theme_mod( 'conversions_headings_fonts', 'Roboto:400,400italic,700,700italic' );
				$heading_font_pieces = explode(":", $headings_font);
				$headings_font = $heading_font_pieces[0];
				// body
				$body_font = get_theme_mod( 'conversions_body_fonts', 'Roboto:400,400italic,700,700italic' );
				$body_font_pieces = explode(":", $body_font);
				$body_font = $body_font_pieces[0];
			} else {
				$headings_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
				$body_font = "Arial, Helvetica, sans-serif, -apple-system, BlinkMacSystemFont";
			}
			// fixed header height calc variables
			if ( has_custom_logo() ) {
				$logo_height = get_theme_mod( 'conversions_logo_height', '2.5' );
			}
			else {
				$logo_height = 1.875;
			}
			$nav_tbpadding = get_theme_mod( 'conversions_nav_tbpadding', '.5' );
			$logo_padding = .625;
			$total_nav_height = $logo_height + ( $nav_tbpadding * 2 ) + $logo_padding - .1250;
			$nav_offset = $total_nav_height + 3.125;

			// WC button option
			$wc_primary_btn = get_theme_mod( 'conversions_wc_primary_btn', 'btn-outline-primary' );
			$wc_secondary_btn = get_theme_mod( 'conversions_wc_secondary_btn', 'btn-primary' );

			// EDD button option
			$edd_primary_btn = get_theme_mod( 'conversions_edd_primary_btn', 'btn-primary' );

			// button multidimensional array
			$wc_btns = [
				"btn-primary" => [ "btn_bg" => "#007bff", "btn_color" => "#fff", "btn_border" => "#007bff", "btn_bg_hover" => "#0069d9", "btn_color_hover" => "#fff", "btn_border_hover" => "#0069d9" ],
				"btn-secondary" => [ "btn_bg" => "#6c757d", "btn_color" => "#fff", "btn_border" => "#6c757d", "btn_bg_hover" => "#5a6268", "btn_color_hover" => "#fff", "btn_border_hover" => "#5a6268" ],
				"btn-success" => [ "btn_bg" => "#019875", "btn_color" => "#fff", "btn_border" => "#019875", "btn_bg_hover" => "#017258", "btn_color_hover" => "#fff", "btn_border_hover" => "#017258" ],
				"btn-danger" => [ "btn_bg" => "#dc3545", "btn_color" => "#fff", "btn_border" => "#dc3545", "btn_bg_hover" => "#c82333", "btn_color_hover" => "#fff", "btn_border_hover" => "#c82333" ],
				"btn-warning" => [ "btn_bg" => "#ffc107", "btn_color" => "#212529", "btn_border" => "#ffc107", "btn_bg_hover" => "#e0a800", "btn_color_hover" => "#212529", "btn_border_hover" => "#e0a800" ],
				"btn-info" => [ "btn_bg" => "#17a2b8", "btn_color" => "#fff", "btn_border" => "#17a2b8", "btn_bg_hover" => "#138496", "btn_color_hover" => "#fff", "btn_border_hover" => "#138496" ],
				"btn-light" => [ "btn_bg" => "#f8f9fa", "btn_color" => "#212529", "btn_border" => "#f8f9fa", "btn_bg_hover" => "#e2e6ea", "btn_color_hover" => "#212529", "btn_border_hover" => "#e2e6ea" ],
				"btn-dark" => [ "btn_bg" => "#151b26", "btn_color" => "#fff", "btn_border" => "#151b26", "btn_bg_hover" => "#07090d", "btn_color_hover" => "#fff", "btn_border_hover" => "#07090d" ],
				"btn-outline-primary" => [ "btn_bg" => "transparent", "btn_color" => "#007bff", "btn_border" => "#007bff", "btn_bg_hover" => "#007bff", "btn_color_hover" => "#fff", "btn_border_hover" => "#007bff" ],
				"btn-outline-secondary" => [ "btn_bg" => "transparent", "btn_color" => "#6c757d", "btn_border" => "#6c757d", "btn_bg_hover" => "#6c757d", "btn_color_hover" => "#fff", "btn_border_hover" => "#6c757d" ],
				"btn-outline-success" => [ "btn_bg" => "transparent", "btn_color" => "#019875", "btn_border" => "#019875", "btn_bg_hover" => "#019875", "btn_color_hover" => "#fff", "btn_border_hover" => "#019875" ],
				"btn-outline-danger" => [ "btn_bg" => "transparent", "btn_color" => "#dc3545", "btn_border" => "#dc3545", "btn_bg_hover" => "#dc3545", "btn_color_hover" => "#fff", "btn_border_hover" => "#dc3545" ],
				"btn-outline-warning" => [ "btn_bg" => "transparent", "btn_color" => "#ffc107", "btn_border" => "#ffc107", "btn_bg_hover" => "#ffc107", "btn_color_hover" => "#212529", "btn_border_hover" => "#ffc107" ],
				"btn-outline-info" => [ "btn_bg" => "transparent", "btn_color" => "#17a2b8", "btn_border" => "#17a2b8", "btn_bg_hover" => "#17a2b8", "btn_color_hover" => "#fff", "btn_border_hover" => "#17a2b8" ],
				"btn-outline-light" => [ "btn_bg" => "transparent", "btn_color" => "#f8f9fa", "btn_border" => "#f8f9fa", "btn_bg_hover" => "#f8f9fa", "btn_color_hover" => "#212529", "btn_border_hover" => "#f8f9fa" ],
				"btn-outline-dark" => [ "btn_bg" => "transparent", "btn_color" => "#151b26", "btn_border" => "#151b26", "btn_bg_hover" => "#151b26", "btn_color_hover" => "#fff", "btn_border_hover" => "#151b26" ],
			];

			$mods = [
				[ "a.navbar-brand img", "max-height", get_theme_mod( 'conversions_logo_height' ), "rem" ],
				[ ".navbar", "padding-top", get_theme_mod( 'conversions_nav_tbpadding' ), "rem" ],
				[ ".navbar", "padding-bottom", get_theme_mod( 'conversions_nav_tbpadding' ), "rem" ],
				[ "footer.site-footer", "background-color", get_theme_mod( 'conversions_footer_bg_color' ) ],
				[ "footer.site-footer .h1, footer.site-footer .h2, footer.site-footer .h3, footer.site-footer .h4, footer.site-footer .h5, footer.site-footer .h6, footer.site-footer h1, footer.site-footer h2, footer.site-footer h3, footer.site-footer h4, footer.site-footer h5, footer.site-footer h6, footer.site-footer p, footer.site-footer table, footer.site-footer li, footer.site-footer caption, footer.site-footer .site-info .copyright", "color", get_theme_mod( 'conversions_footer_text_color' ) ],
				[ "footer.site-footer a, footer.site-footer .site-info .copyright a, footer.site-footer .social-media-icons ul li.list-inline-item i", "color", get_theme_mod( 'conversions_footer_link_color' ) ],
				[ "footer.site-footer a:hover, footer.site-footer .site-info .copyright a:hover, footer.site-footer .social-media-icons ul li.list-inline-item i:hover", "color", get_theme_mod( 'conversions_footer_link_hcolor' ) ],
				[ "a", "color", get_theme_mod( 'conversions_link_color' ) ],
				[ "a:hover", "color", get_theme_mod( 'conversions_link_hcolor') ],
				[ ".conversions-hero-cover .conversions-hero-cover__inner h1", "color", get_theme_mod( 'conversions_featured_title_color' ) ],
				[ ".page-template-homepage section.c-hero h1", "color", get_theme_mod( 'conversions_hh_title_color' ) ],
				[ ".page-template-homepage section.c-hero .c-hero__description", "color", get_theme_mod( 'conversions_hh_desc_color' ) ],
				[ ".page-template-homepage section.c-clients", "background-color", get_theme_mod( 'conversions_hc_bg_color' ) ],
				[ "section.c-clients img.client", "max-width", get_theme_mod( 'conversions_hc_logo_width' ), "rem" ],
				[ "section.c-cta h2", "color", get_theme_mod( 'conversions_hcta_title_color' ) ],
				[ "section.c-cta p.subtitle", "color", get_theme_mod( 'conversions_hcta_desc_color' ) ],
				[ ".page-template-homepage section.c-news", "background-color", get_theme_mod( 'conversions_news_bg_color' ) ],
				[ ".page-template-homepage section.c-news h2", "color", get_theme_mod( 'conversions_news_title_color' ) ],
				[ ".page-template-homepage section.c-news p.subtitle", "color", get_theme_mod(' conversions_news_desc_color' ) ],
				[ ".page-template-homepage section.c-testimonials", "background-color", get_theme_mod( 'conversions_testimonials_bg_color' ) ],
				[ ".page-template-homepage section.c-testimonials h2", "color", get_theme_mod( 'conversions_testimonials_title_color' ) ],
				[ ".page-template-homepage section.c-testimonials p.subtitle", "color", get_theme_mod( 'conversions_testimonials_desc_color' ) ],
				[ ".page-template-homepage section.c-pricing", "background-color", get_theme_mod( 'conversions_pricing_bg_color' ) ],
				[ ".page-template-homepage section.c-pricing h2", "color", get_theme_mod( 'conversions_pricing_title_color' ) ],
				[ ".page-template-homepage section.c-pricing p.subtitle", "color", get_theme_mod( 'conversions_pricing_desc_color' ) ],
				[ ".page-template-homepage section.c-features", "background-color", get_theme_mod( 'conversions_features_bg_color' ) ],
				[ ".page-template-homepage section.c-features h2, section.c-features .card h3", "color", get_theme_mod( 'conversions_features_title_color' ) ],
				[ ".page-template-homepage section.c-features p.subtitle, section.c-features .card .c-features__block-desc", "color", get_theme_mod( 'conversions_features_desc_color' ) ],
				[ ".conversions-hero-cover", "min-height", get_theme_mod( 'conversions_featured_img_height' ), "vh" ],
				[ ".h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6", "font-family", $headings_font ],
				[ "body, input, select, textarea", "font-family", $body_font ],
				[ "#wrapper-footer .social-media-icons ul li.list-inline-item i", "font-size", get_theme_mod( 'conversions_social_size' ), "rem" ],
				[ ".page-template-homepage section.c-hero", "min-height", get_theme_mod( 'conversions_hh_img_height' ), "vh" ],
				[ ".page-template-homepage section.c-woo", "background-color", get_theme_mod( 'conversions_woo_bg_color' ) ],
				[ ".page-template-homepage section.c-woo h2", "color", get_theme_mod( 'conversions_woo_title_color' ) ],
				[ ".page-template-homepage section.c-woo p.subtitle", "color", get_theme_mod( 'conversions_woo_desc_color' ) ],
				[ ".page-template-homepage section.c-edd", "background-color", get_theme_mod( 'conversions_edd_bg_color' ) ],
				[ ".page-template-homepage section.c-edd h2", "color", get_theme_mod( 'conversions_edd_title_color' ) ],
				[ ".page-template-homepage section.c-edd p.subtitle", "color", get_theme_mod( 'conversions_edd_desc_color' ) ],
			];
			?>

			<style>
				<?php
				foreach($mods as $key => $value) {
					if ( !empty( $value[2] ) ) {
						echo $value[0];
						echo "{";
						echo $value[1];
						echo ":";
						echo esc_html($value[2]);
						if ( !empty($value[3])) {
							echo $value[3];
						}
						echo ";}";
					}
				}

				// Fixed navbar height
				if ( get_theme_mod( 'conversions_nav_position', 'fixed-top' ) == 'fixed-top' ) {
					echo '.content-wrapper {
							margin-top: '.esc_html( $total_nav_height ).'rem;
					}';
					echo '.wrapper :target:before, .wrapper li[id].comment:before {
						display: block;
						content: " ";
						margin-top: -'.esc_html( $nav_offset ).'rem;
						height: '.esc_html( $nav_offset ).'rem;
						visibility: hidden;
						pointer-events: none;
					}';
				}
				// Navbar drop shadow
				if ( get_theme_mod( 'conversions_nav_dropshadow', true ) == true ) {
					echo '#wrapper-navbar nav.navbar {
						box-shadow: 0 3px 5px rgba(57, 63, 72, 0.3);
					}';
				}
				// Featured image
				if ( get_theme_mod( 'conversions_featured_img_parallax', false ) == true ) {
					echo '.conversions-hero-cover {
						background-attachment: fixed;
					}';
				}
				// Woocommerce
				if ( class_exists( 'woocommerce' ) ) {
					if ( get_theme_mod( 'conversions_wc_checkout_columns', 'two-column' ) == 'two-column' ) {
						// checkout columns
						echo '@media screen and (min-width:768px) {
							body.woocommerce-checkout #customer_details { width: 48%; float: left; margin-right: 1.9%; }
							body.woocommerce-checkout .col-12.col-md-7.conversions-wcbilling { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; }
							body.woocommerce-checkout .col-12.col-md-5.conversions-wcshipping { flex: 0 0 100%; -webkit-flex: 0 0 100%; -ms-flex: 0 0 100%; max-width: 100%; margin-top: 1em; }
							body.woocommerce-checkout #order_review, body.woocommerce-checkout #order_review_heading { width: 48%; float: right; margin-right: 0; }
						}';
					}
					// shop buttons
					echo '.woocommerce ul.products li.product .button, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link {
						background: '.esc_html( $wc_btns[$wc_primary_btn]["btn_bg"] ).';
						color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_color"] ).';
						border: 1px solid '.esc_html( $wc_btns[$wc_primary_btn]["btn_border"] ).';
					}';
					echo '.woocommerce ul.products li.product .button:hover, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .wp-block-button__link:hover {
						color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_color_hover"] ).';
						background-color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_bg_hover"] ).';
						border-color: '.esc_html( $wc_btns[$wc_primary_btn]["btn_border_hover"] ).';
					}';
					echo '.woocommerce ul.products li.product .added_to_cart, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .added_to_cart {
						background: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_bg"] ).';
						color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_color"] ).';
						border: 1px solid '.esc_html( $wc_btns[$wc_secondary_btn]["btn_border"] ).';
					}';
					echo '.woocommerce ul.products li.product .added_to_cart:hover, .wc-block-grid .wc-block-grid__products .wc-block-grid__product .added_to_cart:hover {
						color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_color_hover"] ).';
						background-color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_bg_hover"] ).';
						border-color: '.esc_html( $wc_btns[$wc_secondary_btn]["btn_border_hover"] ).';
					}';
				}
				// Easy Digital Downloads
				if ( class_exists( 'Easy_Digital_Downloads' ) ) {
					// primary buttons
					echo '#edd-purchase-button, .edd-submit, [type="submit"].edd-submit {
						background: '.esc_html( $wc_btns[$edd_primary_btn]["btn_bg"] ).';
						color: '.esc_html( $wc_btns[$edd_primary_btn]["btn_color"] ).';
						border: 1px solid '.esc_html( $wc_btns[$edd_primary_btn]["btn_border"] ).';
					}';
					echo '#edd-purchase-button:hover, .edd-submit:hover, [type="submit"].edd-submit:hover {
						color: '.esc_html( $wc_btns[$edd_primary_btn]["btn_color_hover"] ).';
						background-color: '.esc_html( $wc_btns[$edd_primary_btn]["btn_bg_hover"] ).';
						border-color: '.esc_html( $wc_btns[$edd_primary_btn]["btn_border_hover"] ).';
					}';
				}
				// sidebar
				if ( get_theme_mod( 'conversions_sidebar_mv', true ) == false ) {
					echo '@media (max-width: 767.98px) { #sidebar-2, #sidebar-1 { display: none; } }';
				}
				// Homepage hero
				if ( get_theme_mod( 'conversions_hh_img_parallax', false ) == true ) {
					echo '.page-template-homepage section.c-hero {
						background-attachment: fixed;
					}';
				}
				// Homepage news
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 1 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__1,
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				if ( get_theme_mod( 'conversions_news_mposts', '2' ) == 2 ) {
					echo '@media (max-width: 991.98px) {
						section.c-news #c-news__2 {
							display: none;
						}
					}';
				}
				?>
			</style>
			<?php
		}

		/**
			@brief		wp_nav_menu_items
			@since		2019-08-15 23:15:12
		**/
		public function wp_nav_menu_items( $items, $args )
		{
			if ( $args->theme_location === 'primary' ) {

				// Is woocommerce is active?
				if ( class_exists( 'woocommerce' ) ) {

					// Append WooCommerce Cart icon?
					if ( get_theme_mod( 'conversions_wc_cart_nav', true ) == true ) {
						// get WC cart totals and if = 0 only show icon with no text
						$cart_totals = WC()->cart->get_cart_contents_count();
						if( WC()->cart->get_cart_contents_count() > 0) {
							$cart_totals = sprintf( '%s<span class="sr-only">' . __( ' items in your shopping cart', 'conversions' ) . '</span>',
								WC()->cart->get_cart_contents_count()
							);
						}
						else {
							$cart_totals = '<span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>';
						}
						// output the cart icon with item count
						$cart_link = sprintf( '<li class="cart menu-item nav-item"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-bag"></i>%s</a></li>',
							wc_get_cart_url(),
							$cart_totals
						);
						// Add the cart icon to the end of the menu.
						$items = $items . $cart_link;
					}

					// Append WooCommerce Account icon?
					if ( get_theme_mod( 'conversions_wc_account', false ) == true ) {

						if ( is_user_logged_in() ) {
							$wc_al = __('My Account','conversions');
						} else {
							$wc_al = __( 'Login / Register', 'conversions' );
						}
						// output the account icon if active.
						$wc_account_link = sprintf( '<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
							esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ),
							$wc_al
						);

						// Add the account to the end of the menu.
						$items = $items . $wc_account_link;
					}

				}

				// Is Easy Digital Downloads active?
				if ( class_exists( 'Easy_Digital_Downloads' ) ) {

					// Append Easy Digital Downloads Cart icon?
					if ( get_theme_mod( 'conversions_edd_nav_cart', true ) == true ) {

						$edd_cart_totals = sprintf( '<span class="header-cart edd-cart-quantity">%s</span><span class="sr-only">' . __( 'View your shopping cart', 'conversions' ) . '</span>',
							edd_get_cart_quantity()
						);

						// output the cart icon with item count
						$edd_cart_link = sprintf( '<li class="cart menu-item nav-item"><a title="' . __( 'View your shopping cart', 'conversions' ) . '" class="cart-customlocation nav-link" href="%s"><i aria-hidden="true" class="fas fa-shopping-bag"></i>%s</a></li>',
							esc_url( edd_get_checkout_uri() ),
							$edd_cart_totals
						);

						// Add the cart icon to the end of the menu.
						$items = $items . $edd_cart_link;
					}

					// Append Easy Digital Downloads Account icon?
					if ( get_theme_mod( 'conversions_edd_nav_account', false ) == true ) {

						if ( is_user_logged_in() ) {
							$edd_al = __('My Account','conversions');
						} else {
							$edd_al = __( 'Login / Register', 'conversions' );
						}
						// output the account icon if active.
						$edd_account_link = sprintf( '<li class="account-icon menu-item nav-item"><a href="%1$s" class="nav-link" title="%2$s"><i aria-hidden="true" class="fas fa-user"></i><span class="sr-only">%2$s</span></a></li>',
							esc_url( edd_get_user_verification_page() ),
							$edd_al
						);

						// Add the account to the end of the menu.
						$items = $items . $edd_account_link;
					}

				}

				// Append Search Icon to nav? Separate function coversions_nav_search_modal adds modal html to footer.
				if ( get_theme_mod( 'conversions_nav_search_icon', false ) == true ) {
					$nav_search = sprintf( '<li class="search-icon menu-item nav-item"><a href="#csearchModal" data-toggle="modal" class="nav-link" title="%1$s"><i aria-hidden="true" class="fas fa-search"></i><span class="sr-only">%1$s</span></a></li>',
						__( 'Search', 'conversions' )
						);

					// Add the nav button to the end of the menu.
					$items = $items . $nav_search;
				}

				// Append Navigation Button?
				if ( get_theme_mod( 'conversions_nav_button', 'no' ) != 'no' ) {

					$nav_btn_text = get_theme_mod( 'conversions_nav_button_text' );
					if ( empty( $nav_btn_text ) ) {
						$nav_btn_text = "";
					}
					$nav_btn_url = get_theme_mod( 'conversions_nav_button_url' );
					if ( empty( $nav_btn_url ) ) {
						$nav_btn_url = "";
					}

					$nav_button = sprintf( '<li class="nav-callout-button menu-item nav-item"><a title="%1$s" href="%2$s" class="btn %3$s">%1$s</a></li>',
						esc_html( $nav_btn_text ),
						esc_url( $nav_btn_url ),
						esc_attr( get_theme_mod( 'conversions_nav_button' ) )
					);

					// Add the nav button to the end of the menu.
					$items = $items . $nav_button;
				}

			}
			return $items;
		}
	}
	conversions()->customizer = new Customizer();
}

namespace
{
	// Select sanitization
	function conversions_sanitize_select( $input, $setting )
	{
		$control = $setting->manager->get_control( $setting->id );
		$valid = $control->choices;

		//return input if valid or return default option
		return ( array_key_exists( $input, $valid ) ? $input : $setting->default );
	}

	// Checkbox sanitization
	function conversions_sanitize_checkbox( $input )
	{
		return ( $input === true ) ? true : false;
	}

	// Float sanitization
	function conversions_sanitize_float( $input ) 
	{
    	$input = filter_var( $input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
    	return $input;
    }

	// Repeater sanitization
	function conversions_repeater_sanitize( $input )
	{
		$input_decoded = json_decode( $input, true );
		if( !empty( $input_decoded ) ) {
			foreach ( $input_decoded as $boxk => $box ) {
				foreach ( $box as $key => $value ) {
					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
				}
			}
			return json_encode( $input_decoded );
		}
		return $input;
	}

	// Filter to modify input label for repeater controls
	function conversions_repeater_labels( $string, $id, $control ) {

		// testimonial repeater labels
		if ( $id === 'conversions_testimonials_repeater' ) {
			if ( $control === 'customizer_repeater_title_control' ) {
				return esc_html__( 'Full name','conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Company name','conversions' );
			}
			if ( $control === 'customizer_repeater_text_control' ) {
				return esc_html__( 'Testimonial text','conversions' );
			}
		}

		// pricing table repeater labels
		if ( $id === 'conversions_pricing_repeater' ) {
			if ( $control === 'customizer_repeater_subtitle_control' ) {
				return esc_html__( 'Price','conversions' );
			}
			if ( $control === 'customizer_repeater_subtitle2_control' ) {
				return esc_html__( 'Duration','conversions' );
			}
		}

		return $string;
	}
	add_filter( 'repeater_input_labels_filter','conversions_repeater_labels', 10 , 3 );
}