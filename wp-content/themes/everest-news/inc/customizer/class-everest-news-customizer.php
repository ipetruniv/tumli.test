<?php
/**
 * Handles the theme's theme customizer functionality.
 *
 * @package    Everest_News
 * @author     everestthemes <themeseverest@gmail.com>
 * @copyright  Copyright (c) 2018, everestthemes
 * @link       http://everestthemes.com/themes/everest-news/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
class Everest_News_Customize {

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	public function __construct() {
		$this->setup_actions();
	}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	public function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'register_panels'   ) );
		add_action( 'customize_register', array( $this, 'register_sections' ) );
		add_action( 'customize_register', array( $this, 'register_settings' ) );
		add_action( 'customize_register', array( $this, 'register_controls' ) );
		add_action( 'customize_register', array( $this, 'add_partials' ) );
		add_action( 'wp_head', array( $this, 'dynamic_style' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_scripts' ), 0 );

		// Enqueue scripts and styles for the preview.
		add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
	}

	/**
	 * Sets up the customizer panels.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $wp_customize
	 * @return void
	 */
	public function register_panels( $wp_customize ) {

		// Home Page Customization Panel
		$wp_customize->add_panel(
			'everest_news_theme_customization',
			array(
				'title' => esc_html__( 'Theme Customization', 'everest-news' ),
				'description' => esc_html__( 'Cream Magazine Pro Homepage Customization. Set Options For Homepage Customization.', 'everest-news' ),
				'priority' => 10,
			)
		);
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $wp_customize
	 * @return void
	 */
	public function register_sections( $wp_customize ) {

		// Page Layout
		$wp_customize->add_section( 
			'everest_news_page_layout_options', 
			array(
				'title'			=> esc_html__( 'Site Layout', 'everest-news' ),
				'priority'		=> 4,
			) 
		);

		// Home
		$wp_customize->add_section( 
			'everest_news_homepage_options', 
			array(
				'title'			=> esc_html__( 'Home', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Header Options
		$wp_customize->add_section( 
			'everest_news_header_options', 
			array(
				'title'			=> esc_html__( 'Header', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Footer Options
		$wp_customize->add_section( 
			'everest_news_footer_options', 
			array(
				'title'			=> esc_html__( 'Footer', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Blog Page Options
		$wp_customize->add_section( 
			'everest_news_blog_page_options', 
			array(
				'title'			=> esc_html__( 'Blog Page', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Archive Page Options
		$wp_customize->add_section( 
			'everest_news_archive_page_options', 
			array(
				'title'			=> esc_html__( 'Archive Page', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Search Page Options
		$wp_customize->add_section( 
			'everest_news_search_page_options', 
			array(
				'title'			=> esc_html__( 'Search Page', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Single Post Options
		$wp_customize->add_section( 
			'everest_news_single_post_options', 
			array(
				'title'			=> esc_html__( 'Single Post', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Post Meta Options
		$wp_customize->add_section( 
			'everest_news_post_meta_options', 
			array(
				'title'			=> esc_html__( 'Post Meta', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Excerpt Options
		$wp_customize->add_section( 
			'everest_news_post_excerpt_options', 
			array(
				'title'			=> esc_html__( 'Post Excerpt', 'everest-news' ),
				'description'	=> esc_html__( 'Post Excerpt is the number of words of content which are displayed instead of full content. You can control the number of words to be displyed in this section.', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Social Links
		$wp_customize->add_section( 
			'everest_news_social_links_options', 
			array(
				'title'			=> esc_html__( 'Social Links', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Breadcrumb Options
		$wp_customize->add_section( 
			'everest_news_breadcrumb_options', 
			array(
				'title'			=> esc_html__( 'Breadcrumb', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);

		// Other Options
		$wp_customize->add_section( 
			'everest_news_miscellaneous_options', 
			array(
				'title'			=> esc_html__( 'Miscellaneous', 'everest-news' ),
				'panel'			=> 'everest_news_theme_customization',
			) 
		);
	}

	/**
	 * Sets up the customizer settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $wp_customize
	 * @return void
	 */
	public function register_settings( $wp_customize ) {

		require get_template_directory() . '/inc/customizer/functions/sanitize-callback.php';

		$defaults = everest_news_get_default_theme_options();

		// Page Layout
		$wp_customize->add_setting( 
			'everest_news_page_layout', 
			array(
				'sanitize_callback'		=> 'everest_news_sanitize_select',
				'default'				=> $defaults['everest_news_page_layout'], 
			) 
		);	

		// Show Ticker News
		$wp_customize->add_setting( 
			'everest_news_enable_ticker_news', 
			array(
				'sanitize_callback'		=> 'everest_news_switch_sanitization',
				'default'				=> $defaults['everest_news_enable_ticker_news'], 
			) 
		);	

		// Ticker News Title
		$wp_customize->add_setting( 
			'everest_news_ticker_news_title', 
			array(
				'sanitize_callback'		=> 'sanitize_text_field',
				'default'				=> $defaults['everest_news_ticker_news_title'], 
			) 
		);

		// Ticker News Cateogries
		$wp_customize->add_setting( 
			'everest_news_ticker_news_categories', 
			array(
				'sanitize_callback' => 'everest_news_sanitize_choices',
			) 
		);

		// Ticker News No
		$wp_customize->add_setting( 
			'everest_news_ticker_news_posts_no', 
			array(
				'sanitize_callback'		=> 'everest_news_sanitize_number',
				'default'				=> $defaults['everest_news_ticker_news_posts_no'], 
			) 
		);

		// Home Sidebar Position
		$wp_customize->add_setting( 
			'everest_news_homepage_sidebar', 
			array(
				'sanitize_callback'	=> 'everest_news_sanitize_select',
				'default'			=> $defaults['everest_news_homepage_sidebar'],
			) 
		);

		// Enable Top Header
		$wp_customize->add_setting( 
			'everest_news_enable_top_header', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_top_header'],
			) 
		);

		// Enable Home Button
		$wp_customize->add_setting( 
			'everest_news_enable_home_button', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_home_button'],
			) 
		);

		// Enable Search Button
		$wp_customize->add_setting( 
			'everest_news_enable_search_button', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_search_button'],
			) 
		);

		// Enable Toggle Sidebar Button
		$wp_customize->add_setting( 
			'everest_news_enable_toggle_sidebar_button', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_toggle_sidebar_button'],
			) 
		);

		// Select Header Layout
		$wp_customize->add_setting( 
			'everest_news_select_header_layout', 
			array(
				'sanitize_callback'	=> 'everest_news_sanitize_select',
				'default'			=> $defaults['everest_news_select_header_layout'],
			) 
		);

		// Coyright
		$wp_customize->add_setting( 
			'everest_news_copyright', 
			array(
				'sanitize_callback'	=> 'sanitize_text_field',
				'default'			=> $defaults['everest_news_copyright'],
			) 
		);


		// Select Sidebar Position For Blog Page
		$wp_customize->add_setting( 
			'everest_news_select_blog_sidebar_position', 
			array(
				'sanitize_callback'	=> 'everest_news_sanitize_select',
				'default'			=> $defaults['everest_news_select_blog_sidebar_position'],
			) 
		);

		// Select Sidebar Position For Archive Page
		$wp_customize->add_setting( 
			'everest_news_select_archive_sidebar_position', 
			array(
				'sanitize_callback'	=> 'everest_news_sanitize_select',
				'default'			=> $defaults['everest_news_select_archive_sidebar_position'],
			) 
		);

		// Select Sidebar Position For Search Page
		$wp_customize->add_setting( 
			'everest_news_select_search_sidebar_position', 
			array(
				'sanitize_callback'	=> 'everest_news_sanitize_select',
				'default'			=> $defaults['everest_news_select_search_sidebar_position'],
			) 
		);

		// Enable Author Section
		$wp_customize->add_setting( 
			'everest_news_enable_author_section', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_author_section'],
			) 
		);

		// Enable Related Section
		$wp_customize->add_setting( 
			'everest_news_enable_related_section', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_related_section'],
			) 
		);

		// Related Section Title
		$wp_customize->add_setting( 
			'everest_news_related_section_title', 
			array(
				'sanitize_callback'	=> 'sanitize_text_field',
				'default'			=> $defaults['everest_news_related_section_title'],
			) 
		);

		// Related Section Posts No
		$wp_customize->add_setting( 
			'everest_news_related_section_posts_number', 
			array(
				'sanitize_callback'		=> 'everest_news_sanitize_number',
				'default'				=> $defaults['everest_news_related_section_posts_number'], 
			) 
		);

		// Enable Author Meta
		$wp_customize->add_setting( 
			'everest_news_enable_author_meta', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_author_meta'],
			) 
		);

		// Enable Date Meta
		$wp_customize->add_setting( 
			'everest_news_enable_date_meta', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_date_meta'],
			) 
		);

		// Enable Comment Meta
		$wp_customize->add_setting( 
			'everest_news_enable_comment_meta', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_comment_meta'],
			) 
		);

		// Enable Tag Meta
		$wp_customize->add_setting( 
			'everest_news_enable_tag_meta', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_tag_meta'],
			) 
		);

		// Enable Category Meta
		$wp_customize->add_setting( 
			'everest_news_enable_category_meta', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_category_meta'],
			) 
		);

		// Excerpt Length
		$wp_customize->add_setting( 
			'everest_news_post_excerpt_length', 
			array(
				'sanitize_callback'		=> 'everest_news_sanitize_number',
				'default'				=> $defaults['everest_news_post_excerpt_length'], 
			) 
		);

		// Social Link - Facebook
		$wp_customize->add_setting( 
			'everest_news_facebook_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_facebook_link'], 
			) 
		);

		// Social Link - Twitter
		$wp_customize->add_setting( 
			'everest_news_twitter_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_twitter_link'], 
			) 
		);

		// Social Link - Instagram
		$wp_customize->add_setting( 
			'everest_news_instagram_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_instagram_link'], 
			) 
		);

		// Social Link - Reddit
		$wp_customize->add_setting( 
			'everest_news_reddit_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_reddit_link'], 
			) 
		);

		// Social Link - Google Plus
		$wp_customize->add_setting( 
			'everest_news_google_plus_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_google_plus_link'], 
			) 
		);

		// Social Link - VK
		$wp_customize->add_setting( 
			'everest_news_vk_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_vk_link'], 
			) 
		);

		// Social Link - Linkedin
		$wp_customize->add_setting( 
			'everest_news_linkedin_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_linkedin_link'], 
			) 
		);

		// Social Link - Quora
		$wp_customize->add_setting( 
			'everest_news_quora_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_quora_link'], 
			) 
		);

		// Social Link - Pinterest
		$wp_customize->add_setting( 
			'everest_news_pinterest_link', 
			array(
				'sanitize_callback'		=> 'esc_url_raw',
				'default'				=> $defaults['everest_news_pinterest_link'], 
			) 
		);

		// Enable Breadcrumb
		$wp_customize->add_setting( 
			'everest_news_enable_breadcrumb', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_breadcrumb'],
			) 
		);

		// Enable Scroll Top Button
		$wp_customize->add_setting( 
			'everest_news_enable_scroll_top_button', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_scroll_top_button'],
			) 
		);

		// Enable Sticky Sidebar
		$wp_customize->add_setting( 
			'everest_news_enable_sticky_sidebar', 
			array(
				'sanitize_callback'	=> 'everest_news_switch_sanitization',
				'default'			=> $defaults['everest_news_enable_sticky_sidebar'],
			) 
		);

		// Theme Color
		$wp_customize->add_setting( 
			'everest_news_primary_theme_color', 
			array(
				'sanitize_callback'	=> 'sanitize_hex_color',
				'default'			=> $defaults['everest_news_primary_theme_color'],
			) 
		);
	}

	/**
	 * Sets up the customizer controls.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $wp_customize
	 * @return void
	 */
	public function register_controls( $wp_customize ) {

		require get_template_directory() . '/inc/customizer/controls/class-image-radio-button-custom-control.php';
		require get_template_directory() . '/inc/customizer/controls/class-toggle-switch-custom-control.php';
		require get_template_directory() . '/inc/customizer/controls/class-multiple-select-dropdown-custom-control.php';

		// Page Layout
		$wp_customize->add_control( 'everest_news_page_layout', 
			array(
				'label'				=> esc_html__( 'Site Layout', 'everest-news' ),
				'section'			=> 'everest_news_page_layout_options',
				'type'				=> 'radio',
				'choices'			=> array(
					'boxed' => esc_html__( 'Boxed', 'everest-news' ),
					'fullwidth' => esc_html__( 'Full Width', 'everest-news' ),
				),
			)
		);

		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_ticker_news',
				array(
					'label' => esc_html__( 'Enable Ticker News', 'everest-news' ),
					'section' => 'everest_news_homepage_options'
				)
			) 
		);

		// Ticker News Title
		$wp_customize->add_control( 
			'everest_news_ticker_news_title', 
			array(
				'label' => esc_html__( 'Ticker News: Section Title', 'everest-news' ),
				'section' => 'everest_news_homepage_options',
				'type' => 'text',
			) 
		);

		// Ticker News Categories
		$wp_customize->add_control( 
			new Everest_News_Multiple_Select_Dropdown_Taxonomies( 
				$wp_customize, 'everest_news_ticker_news_categories',
				array(
					'label'	=> esc_html__( 'Ticker News: Categories', 'everest-news' ),
					'section' => 'everest_news_homepage_options',
					'choices' => $this->get_category_taxonomies(),
				)
			) 
		);

		// Ticker News Posts No
		$wp_customize->add_control( 
			'everest_news_ticker_news_posts_no', 
			array(
				'label' => esc_html__( 'Ticker News: Posts Number', 'everest-news' ),
				'section' => 'everest_news_homepage_options',
				'type' => 'number',
			) 
		);

		// Home Sidebar Position
		$wp_customize->add_control( 
			new Everest_News_Image_Radio_Button_Custom_Control( 
				$wp_customize,  
				'everest_news_homepage_sidebar', 
				array(
					'label'				=> esc_html__( 'Sidebar Position', 'everest-news' ),
					'section'			=> 'everest_news_homepage_options',
					'type'				=> 'radio',
					'choices'			=> $this->get_homepage_sidebar(), 
				) 
			) 
		);

		// Enable Top Header
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_top_header',
				array(
					'label'				=> esc_html__( 'Enable Top Header', 'everest-news' ),
					'section'			=> 'everest_news_header_options',
					'active_callback'	=> 'everest_news_active_header_two',
				) 
			) 
		);

		// Enable Home
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_home_button',
				array(
					'label'				=> esc_html__( 'Enable Home Button', 'everest-news' ),
					'section'			=> 'everest_news_header_options',
					'active_callback'	=> 'everest_news_active_header_two',
				) 
			) 
		);

		// Enable Search Button
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_search_button',
				array(
					'label'				=> esc_html__( 'Enable Search Button', 'everest-news' ),
					'section'			=> 'everest_news_header_options',
				) 
			)
		);

		// Enable Sidebar Toggle Button
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_toggle_sidebar_button',
				array(
					'label'				=> esc_html__( 'Enable Toggle Sidebar Button', 'everest-news' ),
					'section'			=> 'everest_news_header_options',
					'active_callback'	=> 'everest_news_active_header_five',
				) 
			) 
		);

		// Select Header Layout
		$wp_customize->add_control( 
			new Everest_News_Image_Radio_Button_Custom_Control( 
				$wp_customize,
				'everest_news_select_header_layout', 
				array(
					'label'				=> esc_html__( 'Select Header Layout', 'everest-news' ),
					'section'			=> 'everest_news_header_options',
					'type'				=> 'select',
					'choices'			=> $this->get_header_layout(), 
				) 
			)
		);

		// Copyright Text
		$wp_customize->add_control( 
			'everest_news_copyright', 
			array(
				'label'				=> esc_html__( 'Copyright Text', 'everest-news' ),
				'section'			=> 'everest_news_footer_options',
				'type'				=> 'text',
			) 
		);


		// Select Sidebar Position For Blog Page
		$wp_customize->add_control( 
			new Everest_News_Image_Radio_Button_Custom_Control( 
				$wp_customize,
				'everest_news_select_blog_sidebar_position', 
				array(
					'label'				=> esc_html__( 'Select Sidebar Position', 'everest-news' ),
					'section'			=> 'everest_news_blog_page_options',
					'type'				=> 'select',
					'choices'			=> $this->get_sidebar_position(), 
				) 
			)
		);

		// Select Sidebar Position For Archive Page
		$wp_customize->add_control( 
			new Everest_News_Image_Radio_Button_Custom_Control( 
				$wp_customize,
				'everest_news_select_archive_sidebar_position', 
				array(
					'label'				=> esc_html__( 'Select Sidebar Position', 'everest-news' ),
					'section'			=> 'everest_news_archive_page_options',
					'type'				=> 'select',
					'choices'			=> $this->get_sidebar_position(), 
				) 
			)
		);

		// Select Sidebar Position For Search Page
		$wp_customize->add_control( 
			new Everest_News_Image_Radio_Button_Custom_Control( 
				$wp_customize,
				'everest_news_select_search_sidebar_position', 
				array(
					'label'				=> esc_html__( 'Select Sidebar Position', 'everest-news' ),
					'section'			=> 'everest_news_search_page_options',
					'type'				=> 'select',
					'choices'			=> $this->get_sidebar_position(), 
				) 
			)
		);

		// Enable Author Section
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_author_section',
				array(
					'label'				=> esc_html__( 'Enable Author Section', 'everest-news' ),
					'section'			=> 'everest_news_single_post_options',
				) 
			) 
		);

		// Enable Related Section
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_related_section',
				array(
					'label'				=> esc_html__( 'Enable Related Posts Section', 'everest-news' ),
					'section'			=> 'everest_news_single_post_options',
				) 
			) 
		);

		// Related Section Title
		$wp_customize->add_control( 
			'everest_news_related_section_title', 
			array(
				'label'				=> esc_html__( 'Related Posts Section Title', 'everest-news' ),
				'section'			=> 'everest_news_single_post_options',
				'type'				=> 'text',
				'active_callback'	=> 'everest_news_active_related_posts',
			) 
		);

		// Related Section Posts No
		$wp_customize->add_control( 
			'everest_news_related_section_posts_number', 
			array(
				'label' => esc_html__( 'Related Section Posts Number', 'everest-news' ),
				'section' => 'everest_news_single_post_options',
				'type' => 'number',
				'active_callback'	=> 'everest_news_active_related_posts',
			) 
		);

		// Enable Author Meta
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_author_meta',
				array(
					'label'				=> esc_html__( 'Enable Author Meta', 'everest-news' ),
					'section'			=> 'everest_news_post_meta_options',
				) 
			) 
		);

		// Enable Date Meta
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_date_meta',
				array(
					'label'				=> esc_html__( 'Enable Posted Date Meta', 'everest-news' ),
					'section'			=> 'everest_news_post_meta_options',
				) 
			) 
		);

		// Enable Comment Meta
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_comment_meta',
				array(
					'label'				=> esc_html__( 'Enable Comments Meta', 'everest-news' ),
					'section'			=> 'everest_news_post_meta_options',
				) 
			) 
		);

		// Enable Category Meta
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_category_meta',
				array(
					'label'				=> esc_html__( 'Enable Categories Meta', 'everest-news' ),
					'section'			=> 'everest_news_post_meta_options',
				) 
			) 
		);

		// Enable Tag Meta
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_tag_meta',
				array(
					'label'				=> esc_html__( 'Enable Tags Meta', 'everest-news' ),
					'section'			=> 'everest_news_post_meta_options',
				) 
			) 
		);

		// Enable View Meta
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_tag_meta',
				array(
					'label'				=> esc_html__( 'Enable Tags Meta', 'everest-news' ),
					'section'			=> 'everest_news_post_meta_options',
				) 
			) 
		);

		// Excerpt Length
		$wp_customize->add_control( 
			'everest_news_post_excerpt_length', 
			array(
				'label' => esc_html__( 'Excerpt Length', 'everest-news' ),
				'section' => 'everest_news_post_excerpt_options',
				'type' => 'number',
			) 
		);

		// Social Links - Facebook
		$wp_customize->add_control( 
			'everest_news_facebook_link', 
			array(
				'label' => esc_html__( 'Facebook Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Twitter
		$wp_customize->add_control( 
			'everest_news_twitter_link', 
			array(
				'label' => esc_html__( 'Twitter Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Instagram
		$wp_customize->add_control( 
			'everest_news_instagram_link', 
			array(
				'label' => esc_html__( 'Instagram Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Reddit
		$wp_customize->add_control( 
			'everest_news_reddit_link', 
			array(
				'label' => esc_html__( 'Reddit Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Google Plus
		$wp_customize->add_control( 
			'everest_news_google_plus_link', 
			array(
				'label' => esc_html__( 'Google Plus Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - VK
		$wp_customize->add_control( 
			'everest_news_vk_link', 
			array(
				'label' => esc_html__( 'VK Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Linkedin
		$wp_customize->add_control( 
			'everest_news_linkedin_link', 
			array(
				'label' => esc_html__( 'Linkedin Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Quora
		$wp_customize->add_control( 
			'everest_news_quora_link', 
			array(
				'label' => esc_html__( 'Quora Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Social Links - Pinterest
		$wp_customize->add_control( 
			'everest_news_pinterest_link', 
			array(
				'label' => esc_html__( 'Pinterest Link', 'everest-news' ),
				'section' => 'everest_news_social_links_options',
				'type' => 'url',
			) 
		);

		// Enable Breadcrumb
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_breadcrumb',
				array(
					'label'				=> esc_html__( 'Enable Breadcrumb', 'everest-news' ),
					'section'			=> 'everest_news_breadcrumb_options',
				) 
			) 
		);

		// Enable Scroll Top Button
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_scroll_top_button',
				array(
					'label'			=> esc_html__( 'Enable Scroll Top Button', 'everest-news' ),
					'section'		=> 'everest_news_miscellaneous_options',
				) 
			) 
		);

		// Enable Sticky Sidebar
		$wp_customize->add_control( 
			new Everest_News_Toggle_Switch_Custom_control( 
				$wp_customize, 'everest_news_enable_sticky_sidebar',
				array(
					'label'			=> esc_html__( 'Enable Sticky Sidebar', 'everest-news' ),
					'section'		=> 'everest_news_miscellaneous_options',
				) 
			) 
		);

		// Set Primary Theme Color
		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
				$wp_customize, 
				'everest_news_primary_theme_color', 
				array(
					'label'		=> esc_html__( 'Primary Color', 'everest-news' ),
					'section'	=> 'colors'
				) 
			) 
		);
	}
	
	/**
	 * Sets up the customizer partials.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function add_partials( $manager ) {

		if ( isset( $wp_customize->selective_refresh ) ) {

			$wp_customize->selective_refresh->add_partial( 
				'blogname', 
				array(
					'selector'        => '.site-title a',
					'render_callback' => array( $this, 'customize_partial_blogname' ),
				) 
			);

			$wp_customize->selective_refresh->add_partial( 
				'blogdescription', 
				array(
					'selector'        => '.site-description',
					'render_callback' => array( $this, 'customize_partial_blogdescription' ),
				) 
			);
		}
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	function customize_partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	function customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

	/**
	 * Loads theme customizer JavaScript.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function customize_preview_js() {

		wp_enqueue_script( 'cream-magazine-pro-customizer', get_template_directory_uri() . '/inc/customizer/assets/js/customizer.js', array( 'customize-preview' ), EVEREST_NEWS_VERSION, true );
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function customizer_scripts() {
		
		wp_enqueue_style( 'chosen', get_template_directory_uri() . '/inc/customizer/assets/css/chosen.css' );

		wp_enqueue_style( 'everest-news-customizer', get_template_directory_uri() . '/inc/customizer/assets/css/customizer.css' );
		
		wp_enqueue_script( 'chosen', get_template_directory_uri() . '/inc/customizer/assets/js/chosen.js', array( 'jquery' ), EVEREST_NEWS_VERSION, true );

		wp_enqueue_script( 'everest-news-customizer-script', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-script.js', array( 'jquery' ), EVEREST_NEWS_VERSION, true );
	}

	/**
	 * Function to load choices for controls.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	function get_category_taxonomies() {
		$taxonomy = 'category';
		$terms = get_terms( $taxonomy );
		$blog_cat = array();
		foreach( $terms as $term ) {
			$blog_cat[$term->term_id] = $term->name;
		}
		return $blog_cat;
	}

	/**
	 * Function to load layout choices for homepage sidebar.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_homepage_sidebar() {

		$sidebar_position = array(

			'left' => array(  // Required. Value for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/sidebar-placeholders/sidebar_left.png', // Required. URL for the image
				'name' => esc_html__( 'Left Sidebar', 'everest-news' ) // Required. Title text to display
			),
			'right' => array(  // Required. Value for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/sidebar-placeholders/sidebar_right.png', // Required. URL for the image
				'name' => esc_html__( 'Right Sidebar', 'everest-news' ) // Required. Title text to display
			)
		);
		return $sidebar_position;
	}

	/**
	 * Function to load layout choices for header.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_header_layout() {
		$header_layouts = array(
			'header_2' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/header-placeholders/header_2.png',
				'name' => esc_html__( 'Header One', 'everest-news' )
			),
			'header_5' => array(
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/header-placeholders/header_5.png',
				'name' => esc_html__( 'Header Two', 'everest-news' )
			),
		);
		return $header_layouts;
	}

	/**
	 * Function to load layout choices for sidebar.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_sidebar_position() {

		$sidebar_position = array(
			'left' => array(  // Required. Value for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/sidebar-placeholders/sidebar_left.png', // Required. URL for the image
				'name' => esc_html__( 'Left Sidebar', 'everest-news' ) // Required. Title text to display
			),
			'right' => array(  // Required. Value for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/sidebar-placeholders/sidebar_right.png', // Required. URL for the image
				'name' => esc_html__( 'Right Sidebar', 'everest-news' ) // Required. Title text to display
			),
			'none' => array(  // Required. Value for this particular radio button choice
				'image' => trailingslashit( get_template_directory_uri() ) . 'admin/images/sidebar-placeholders/sidebar_none.png', // Required. URL for the image
				'name' => esc_html__( 'No Sidebar', 'everest-news' ) // Required. Title text to display
			),
		);
		return $sidebar_position;
	}

	/**
	 * Function to load dynamic styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return null
	 */
	public function dynamic_style() {

		$show_scroll_top_icon = everest_news_get_option( 'everest_news_enable_scroll_top_button' );

		$primary_theme_color = everest_news_get_option( 'everest_news_primary_theme_color' );

		$show_search_icon = everest_news_get_option( 'everest_news_enable_search_button' );
		$show_scroll_top_icon = everest_news_get_option( 'everest_news_enable_scroll_top_button' );
		?>
		<noscript>
			<style>
				img.lazyload {
				 	display: none;
				}

				img.image-fallback {
				 	display: block;
				}
			</style>
		</noscript>
		<style>
			.primary-navigation li.primarynav_search_icon {
				<?php
				if( $show_search_icon == false ) {
					?>
					display: none;
					<?php
				}
				?>
			}
			#toTop {
				<?php
				if( $show_scroll_top_icon == false ) {
					?>
					display: none !important;
					<?php
				}
				?>
			}

			<?php
			if( !empty( $primary_theme_color ) ) {
				?>
				.copyright-notice a,
				.social-icons-list li a:hover,
				.social-icons-list-post-page li:first-child,
				.en-author-box .author-name h3,
				.page-404-entry .header-404 h3 span,
				.widget_rss ul li a,
				.event-page-top-box .event-metas ul p {
					color: <?php echo esc_attr( $primary_theme_color ); ?>;
				}

				.en-breaking-news .ticker-head-col span,
				.owl-carousel .owl-nav button.owl-next, 
				.owl-carousel .owl-nav button.owl-prev,
				ul.post-categories li a,
				.widget-title:after,
				.en-custom-category ul li a,
				.btn-general,
				.en-popular-trending-posts-widget-1 ul.tabs li.current,
				#toTop,
				#header-search input[type=submit], 
				.search-box input[type=submit], 
				.widget_search input[type=submit],
				.en-pagination .pagi-layout-1 .nav-links span.current,
				.header-lay-2 .main-navigation .home-btn a, 
				.header-lay-3 .main-navigation .home-btn a,
				button, 
				input[type=button], 
				input[type=reset], 
				input[type=submit],
				.calendar_wrap caption,
				.live-feeds-entry .live-feed .leftbox span,
				.en-popular-trending-posts-widget-1 .content-holder .left-col span {
					background-color: <?php echo esc_attr( $primary_theme_color ); ?>;
				}

				ul.post-categories li a:before,
				.en-breaking-news .ticker-head-col span:before {
					border-top-color: <?php echo esc_attr( $primary_theme_color ); ?>;
				}

				.header-lay-2 .main-navigation, 
				.header-lay-3 .main-navigation {
					border-bottom-color: <?php echo esc_attr( $primary_theme_color ); ?>;
				}

				.post-page-layout-1 .page-title h2,
				.post-format.quote-format blockquote {
					border-left-color: <?php echo esc_attr( $primary_theme_color ); ?>;
				}
				<?php
			}
			?>
		</style>
		<?php
	}
}
