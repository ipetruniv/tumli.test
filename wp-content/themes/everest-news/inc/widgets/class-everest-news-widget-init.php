<?php
/**
 * Cream Blog Pro Extension Widget Init class for widgets and widget area initialization.
 *
 * @package    Everest_News
 * @author     everestthemes <themeseverest@gmail.com>
 * @copyright  Copyright (c) 2018, everestthemes
 * @link       http://everestthemes.com/themes/everest-news/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Cream Blog Pro Widget Init Class
 */
class Everest_News_Widget_Init {

	/**
	 * Setup class.
	 *
	 * @return  void
	 */
	public function __construct() {

		add_action( 'widgets_init', array( $this, 'widgets_init' ), 20 );

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for this this.
	 *
	 * @return void
	 */
	public function load_dependencies() {
		
		
		// Class for Banner Three Widget
		require_once get_template_directory() . '/inc/widgets/banner-widgets/banner-widget-one.php';

		
		// Class for Fullwidth Widget Two
		require_once get_template_directory() . '/inc/widgets/fullwidth-news-widgets/fullwidth-widget-two.php';
		// Class for Fullwidth Widget Four
		require_once get_template_directory() . '/inc/widgets/fullwidth-news-widgets/fullwidth-widget-four.php';

		// Class for Halfwidth Widget One
		require_once get_template_directory() . '/inc/widgets/halfwidth-news-widgets/halfwidth-widget-one.php';
		// Class for Halfwidth Widget Three
		require_once get_template_directory() . '/inc/widgets/halfwidth-news-widgets/halfwidth-widget-three.php';
		// Class for Halfwidth Widget Five
		require_once get_template_directory() . '/inc/widgets/halfwidth-news-widgets/halfwidth-widget-five.php';

		// Class For Author Widget
		require_once get_template_directory() . '/inc/widgets/sidebar-footer-widgets/class-everest-news-author-widget.php';
		// Class For Social Widget One
		require_once get_template_directory() . '/inc/widgets/sidebar-footer-widgets/class-everest-news-social-widget-one.php';
		// Class For Post Widget
		require_once get_template_directory() . '/inc/widgets/sidebar-footer-widgets/class-everest-news-post-widget.php';
	}

	/**
	 * Register widget area.
	 *
	 * @see 	https://codex.wordpress.org/Function_Reference/register_sidebar
	 * @return  void
	 */
	public function widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Banner Widget Area', 'everest-news' ),
			'id'            => 'banner-widget-area',
			'description'   => esc_html__( 'Place banner widgets here.', 'everest-news' ),
			'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Fullwidth Top News Area', 'everest-news' ),
			'id'            => 'fullwidth-top-news-area',
			'description'   => esc_html__( 'Place fullwidth widgets here.', 'everest-news' ),
			'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Middle News Area', 'everest-news' ),
			'id'            => 'middle-news-area',
			'description'   => esc_html__( 'Place halfwidth widgets here.', 'everest-news' ),
			'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Fullwidth Bottom News Area', 'everest-news' ),
			'id'            => 'fullwidth-bottom-news-area',
			'description'   => esc_html__( 'Place fullwidth widgets here.', 'everest-news' ),
			'before_widget' => '<div id="%1$s"><div class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );


		register_widget( 'Everest_News_Banner_Widget_One' );

		register_widget( 'Everest_News_Fullwidth_Widget_Two' );

		register_widget( 'Everest_News_Fullwidth_Widget_Four' );

		register_widget( 'Everest_News_Halfwidth_Widget_One' );

		register_widget( 'Everest_News_Halfwidth_Widget_Three' );

		register_widget( 'Everest_News_Halfwidth_Widget_Five' );

		register_widget( 'Everest_News_Author_Widget' );

		register_widget( 'Everest_News_Social_Widget_One' );

		register_widget( 'Everest_News_Post_Widget' );
	}
}