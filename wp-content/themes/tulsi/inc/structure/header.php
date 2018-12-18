<?php
/**
 * Header elements.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'tulsi_construct_header' ) ) {
	add_action( 'tulsi_header', 'tulsi_construct_header' );
	/**
	 * Build the header.
	 *
	 */
	function tulsi_construct_header() {
		?>
		<header itemtype="https://schema.org/WPHeader" itemscope="itemscope" id="masthead" <?php tulsi_header_class(); ?> style="background-image: url(<?php header_image(); ?>)">
			<div <?php tulsi_inside_header_class(); ?>>
            	<div class="header-content-h">
				<?php
				/**
				 * tulsi_before_header_content hook.
				 *
				 */
				do_action( 'tulsi_before_header_content' );

				// Add our main header items.
				tulsi_header_items();

				/**
				 * tulsi_after_header_content hook.
				 *
				 *
				 * @hooked tulsi_add_navigation_float_right - 5
				 */
				do_action( 'tulsi_after_header_content' );
				?>
                </div><!-- .header-content-h -->
			</div><!-- .inside-header -->
		</header><!-- #masthead -->
		<?php
	}
}

if ( ! function_exists( 'tulsi_header_items' ) ) {
	/**
	 * Build the header contents.
	 * Wrapping this into a function allows us to customize the order.
	 *
	 */
	function tulsi_header_items() {
		tulsi_construct_header_widget();
		tulsi_construct_site_title();
		tulsi_construct_logo();
	}
}

if ( ! function_exists( 'tulsi_construct_logo' ) ) {
	/**
	 * Build the logo
	 *
	 */
	function tulsi_construct_logo() {
		$logo_url = ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) ? wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' ) : false;
		$logo_url = ( $logo_url ) ? $logo_url[0] : '';

		$logo_url = esc_url( apply_filters( 'tulsi_logo', $logo_url ) );
		$retina_logo_url = esc_url( apply_filters( 'tulsi_retina_logo', '' ) );

		// If we don't have a logo, bail.
		if ( empty( $logo_url ) ) {
			return;
		}

		/**
		 * tulsi_before_logo hook.
		 *
		 */
		do_action( 'tulsi_before_logo' );

		$attr = apply_filters( 'tulsi_logo_attributes', array(
			'class' => 'header-image',
			'src'	=> $logo_url,
			'title'	=> esc_attr( apply_filters( 'tulsi_logo_title', get_bloginfo( 'name', 'display' ) ) ),
		) );

		if ( '' !== $retina_logo_url ) {
			$attr[ 'srcset' ] = $logo_url . ' 1x, ' . $retina_logo_url . ' 2x';

			// Add dimensions to image if retina is set. This fixes a container width bug in Firefox.
			if ( function_exists( 'the_custom_logo' ) && get_theme_mod( 'custom_logo' ) ) {
				$data = wp_get_attachment_metadata( get_theme_mod( 'custom_logo' ) );

				if ( ! empty( $data ) ) {
					$attr['width'] = $data['width'];
					$attr['height'] = $data['height'];
				}
			}
		}

		$attr = array_map( 'esc_attr', $attr );

		$html_attr = '';
		foreach ( $attr as $name => $value ) {
			$html_attr .= " $name=" . '"' . $value . '"';
		}

		// Print our HTML.
		echo apply_filters( 'tulsi_logo_output', sprintf( // WPCS: XSS ok, sanitization ok.
			'<div class="site-logo">
				<a href="%1$s" title="%2$s" rel="home">
					<img %3$s />
				</a>
			</div>',
			esc_url( apply_filters( 'tulsi_logo_href' , home_url( '/' ) ) ),
			esc_attr( apply_filters( 'tulsi_logo_title', get_bloginfo( 'name', 'display' ) ) ),
			$html_attr
		), $logo_url, $html_attr );

		/**
		 * tulsi_after_logo hook.
		 *
		 */
		do_action( 'tulsi_after_logo' );
	}
}

if ( ! function_exists( 'tulsi_construct_site_title' ) ) {
	/**
	 * Build the site title and tagline.
	 *
	 */
	function tulsi_construct_site_title() {
		$tulsi_settings = wp_parse_args(
			get_option( 'tulsi_settings', array() ),
			tulsi_get_defaults()
		);

		// Get the title and tagline.
		$title = get_bloginfo( 'title' );
		$tagline = get_bloginfo( 'description' );

		// If the disable title checkbox is checked, or the title field is empty, return true.
		$disable_title = ( '1' == $tulsi_settings[ 'hide_title' ] || '' == $title ) ? true : false;

		// If the disable tagline checkbox is checked, or the tagline field is empty, return true.
		$disable_tagline = ( '1' == $tulsi_settings[ 'hide_tagline' ] || '' == $tagline ) ? true : false;

		// Build our site title.
		$site_title = apply_filters( 'tulsi_site_title_output', sprintf(
			'<%1$s class="main-title" itemprop="headline">
				<a href="%2$s" rel="home">
					%3$s
				</a>
			</%1$s>',
			( is_front_page() && is_home() ) ? 'h1' : 'p',
			esc_url( apply_filters( 'tulsi_site_title_href', home_url( '/' ) ) ),
			get_bloginfo( 'name' )
		) );

		// Build our tagline.
		$site_tagline = apply_filters( 'tulsi_site_description_output', sprintf(
			'<p class="site-description">
				%1$s
			</p>',
			html_entity_decode( get_bloginfo( 'description', 'display' ) )
		) );

		// Site title and tagline.
		if ( false == $disable_title || false == $disable_tagline ) {
			echo apply_filters( 'tulsi_site_branding_output', sprintf( // WPCS: XSS ok, sanitization ok.
				'<div class="site-branding">
					%1$s
					%2$s
				</div>',
				( ! $disable_title ) ? $site_title : '',
				( ! $disable_tagline ) ? $site_tagline : ''
			) );
		}
	}
}

if ( ! function_exists( 'tulsi_construct_header_widget' ) ) {
	/**
	 * Build the header widget.
	 *
	 */
	function tulsi_construct_header_widget() {
		if ( is_active_sidebar('header') ) : ?>
			<div class="header-widget">
				<?php dynamic_sidebar( 'header' ); ?>
			</div>
		<?php endif;
	}
}

if ( ! function_exists( 'tulsi_top_bar' ) ) {
	add_action( 'tulsi_before_header', 'tulsi_top_bar', 5 );
	/**
	 * Build our top bar.
	 *
	 */
	function tulsi_top_bar() {
		$socials_display_top =  tulsi_get_setting( 'socials_display_top' );
		if ( ( ! is_active_sidebar( 'top-bar' ) ) && ( $socials_display_top != true ) ) {
			return;
		}
		?>
		<div <?php tulsi_top_bar_class(); ?>>
			<div class="inside-top-bar<?php if ( 'contained' == tulsi_get_setting( 'top_bar_inner_width' ) ) echo ' grid-container grid-parent'; ?>">
				<?php if ( is_active_sidebar( 'top-bar' ) ) {
					dynamic_sidebar( 'top-bar' ); 
				} ?>
                <?php if ( $socials_display_top == true ) {
					do_action( 'tulsi_social_bar_action' );
				}?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tulsi_pingback_header' ) ) {
	add_action( 'wp_head', 'tulsi_pingback_header' );
	/**
	 * Add a pingback url auto-discovery header for singularly identifiable articles.
	 *
	 */
	function tulsi_pingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
}

if ( ! function_exists( 'tulsi_add_viewport' ) ) {
	add_action( 'wp_head', 'tulsi_add_viewport' );
	/**
	 * Add viewport to wp_head.
	 *
	 */
	function tulsi_add_viewport() {
		echo apply_filters( 'tulsi_meta_viewport', '<meta name="viewport" content="width=device-width, initial-scale=1">' ); // WPCS: XSS ok.
	}
}

add_action( 'tulsi_before_header', 'tulsi_do_skip_to_content_link', 2 );
/**
 * Add skip to content link before the header.
 *
 */
function tulsi_do_skip_to_content_link() {
	printf( '<a class="screen-reader-text skip-link" href="#content" title="%1$s">%2$s</a>',
		esc_attr__( 'Skip to content', 'tulsi' ),
		esc_html__( 'Skip to content', 'tulsi' )
	);
}

add_action( 'tulsi_before_header', 'tulsi_side_padding', 1 );
/**
 * Add holder div if sidebar padding is enabled
 *
 */
function tulsi_side_padding() { 
	$tulsi_settings = wp_parse_args(
		get_option( 'tulsi_spacing_settings', array() ),
		tulsi_spacing_get_defaults()
	);
	
	if ( ( $tulsi_settings[ 'side_top' ] != 0 ) || ( $tulsi_settings[ 'side_right' ] != 0 ) || ( $tulsi_settings[ 'side_bottom' ] != 0 ) || ( $tulsi_settings[ 'side_left' ] != 0 ) ) {
	?>
	<div class="tulsi-side-padding-inside">
	<?php
	}
}
