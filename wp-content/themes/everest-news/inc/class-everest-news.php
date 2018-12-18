<?php
/**
 * Everest News class and the class object initialization.
 *
 * @package    Everest_News
 * @author     everestthemes <themeseverest@gmail.com>
 * @copyright  Copyright (c) 2018, everestthemes
 * @link       http://everestthemes.com/themes/everest-news/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Everest News Class
 */
class Everest_News {

	/**
	 * Setup class.
	 *
	 * @return  void
	 */
	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'setup' ), 10 );		
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 10 );
		add_filter( 'body_class', array( $this, 'body_classes' ), 10, 1 );
		add_action( 'wp_head', array( $this, 'pingback_header' ), 10 );
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ), 10, 1 );
		add_filter( 'get_search_form', array( $this, 'search_form' ), 10 );
		add_action( 'widgets_init', array( $this, 'widgets_area_init' ), 10 );

		$this->load_dependencies();
		$this->customizer_initialization();
		$this->post_meta_initialization();
		$this->widget_initialization();
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @return  void
	 */
	public function setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Everest News, use a find and replace
		 * to change 'everest-news' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'everest-news', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'everest-news-thumbnail-one', 800, 450, true ); //16:9
		add_image_size( 'everest-news-thumbnail-two', 500, 375, true ); //4:3
		add_image_size( 'everest-news-thumbnail-three', 150, 150, true ); //1:1 Author Widget

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary Menu', 'everest-news' ), // Primary Menu
			'menu-2' => esc_html__( 'Top Header Menu', 'everest-news' ), // Top Header Menu
			'menu-3' => esc_html__( 'Bottom Footer Menu', 'everest-news' ), // Bottom Footer Menu
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'everest_news_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for core custom header.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
		 */
		add_theme_support( 'custom-header', apply_filters( 'everest_news_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '000000',
			'width'                  => 1170,
			'height'                 => 290,
			'flex-height'            => true,
			'wp-head-callback'       => array( $this, 'header_style' ),
		) ) );

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'everest_news_content_width', 640 );
	}

	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see everest_news_custom_header_setup().
	 */
	public function header_style() {

		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.header-lay-5 .site-title a,
			.header-lay-2 .site-title a,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
		// If the user has set a custom color for the text use that.
		else :
			?>
			.header-lay-5 .site-title a,
			.header-lay-2 .site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}

	/**
	 * Enqueue scripts and styles.
	 *
	 * @see 	https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
	 * @see 	https://developer.wordpress.org/reference/functions/wp_enqueue_style/
	 * @see 	https://developer.wordpress.org/reference/functions/wp_enqueue_script/
	 * @return 	void
	 */
	public function enqueue_scripts() {

		wp_enqueue_style( 'everest-news-style', get_stylesheet_uri() );

		wp_enqueue_style( 'everest-news-fonts', everest_news_fonts_url() );

		wp_enqueue_style( 'everest-news-main', get_template_directory_uri() . '/assets/dist/css/main.css' );

		wp_enqueue_script( 'everest-news-bundle', get_template_directory_uri() . '/assets/dist/js/bundle.min.js', array( 'jquery', 'masonry' ), EVEREST_NEWS_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function widgets_area_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'everest-news' ),
			'id'            => 'sidebar',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget"><div class="%2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );


		register_sidebar( array(
			'name'          => esc_html__( 'Toggle Sidebar', 'everest-news' ),
			'id'            => 'toggle-sidebar',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget"><div class="%2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'everest-news' ),
			'id'            => 'footer',
			'description'   => '',
			'before_widget' => '<div class="en-col"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		$header_layout = everest_news_get_option( 'everest_news_select_header_layout' );
		if( $header_layout == 'header_2' ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Header Advertisement', 'everest-news' ),
				'id'            => 'header-advertisement',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3></div>',
			) );
		}
	}

	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param  array $classes Classes for the body element.
	 * @return array
	 */
	public function body_classes( $classes ) {

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		// Adds a class of no-sidebar when there is no sidebar present.
		if ( ! is_active_sidebar( 'sidebar' ) ) {
			$classes[] = 'no-sidebar';
		}

		$site_layout = everest_news_get_option( 'everest_news_page_layout' );

		if( $site_layout == 'boxed' ) {
			$classes[] = 'boxed';
		}

		return $classes;
	}


	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 * @return  void
	 */
	public function pingback_header() {

		if ( is_singular() && pings_open() ) {

			echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
		}
	}	


	/**
	 * Trailing text for post excerpts.
	 *
	 * @return  void
	 */
	public function excerpt_more( $more ) {

		if ( is_admin() ) {

			return $more;
		}

		return '';

	}

	/**
	 * Load the required dependencies for this this.
	 *
	 * @return void
	 */
	public function load_dependencies() {
		
		// Load theme functions
		require get_template_directory() . '/inc/theme-functions.php';
		// Load template functions
		require get_template_directory() . '/inc/template-functions.php';
		// Load custom hook functions
		require get_template_directory() . '/inc/theme-hooks.php';
		// Load helper functions
		require get_template_directory() . '/inc/helper-functions.php';
		// Load breadcrumb class
		require get_template_directory() . '/third-party/breadcrumbs.php';
		// Load TGM Plugin Activation
		require get_template_directory() . '/third-party/class-tgm-plugin-activation.php';
		// Load Customizer
		require get_template_directory() . '/inc/customizer/class-everest-news-customizer.php';
		// Load customizer defaults
		require get_template_directory() . '/inc/customizer/functions/customizer-defaults.php';
		// Load Active Callback Functions 
		require get_template_directory() . '/inc/customizer/functions/active-callback.php';
		// Load Widgets
		require get_template_directory() . '/inc/widgets/class-everest-news-widget-init.php';
		/**
		 * The class responsible for creating custom meta fields for post.
		 */
		require get_template_directory() . '/inc/metabox/class-everest-news-post-meta.php';
	}

	/**
	 * Initialize Customizer
	 *
	 * @return void
	 */
	public function customizer_initialization() {
		
		$customize = new Everest_News_Customize();
	}

	/**
	 * Initialize Widgets and Widget Areas
	 *
	 * @return void
	 */
	public function widget_initialization() {
		
		$widget = new Everest_News_Widget_Init();
	}

	/**
	 * Register custom meta fields for post.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function post_meta_initialization() {

		$post_meta = new Everest_News_Post_Meta();
	}

	
	/**
	 * Custom Search Form
	 *
	 * @return void
	 */
	public function search_form() {
		$form = '<form role="search" method="get" id="search-form" class="clearfix" action="' . esc_url( home_url( '/' ) ) . '"><input type="search" name="s" placeholder="' . esc_attr__( 'Type Something', 'everest-news' ) . '" value"' . get_search_query() . '" ><input type="submit" id="submit" value="'. esc_attr__( 'Search', 'everest-news' ).'"></form>';

        return $form;
	}
}