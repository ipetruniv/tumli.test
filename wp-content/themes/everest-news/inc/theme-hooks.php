<?php
/**
 * Custom hooks for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Everest_News
 */ 

/**
 * Header top menu declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'everest_news_header_menu_action' ) ) :

 	function everest_news_header_menu_action() {

 		if( has_nav_menu( 'menu-2' ) ) {
 			wp_nav_menu( array( 
 				'theme_location' => 'menu-2',
 				'container' => '', 
 				'depth' => 1,
 			) );
 		}
 	}
endif;
add_action( 'everest_news_header_menu', 'everest_news_header_menu_action', 10 );


/**
 * Main menu declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'everest_news_primary_menu_action' ) ) :

 	function everest_news_primary_menu_action() {
 		$menu_args = array(
 			'theme_location' => 'menu-1',
 			'container' => '',
 			'menu_class' => '',
			'menu_id' => '',
			'items_wrap' => everest_news_main_menu_wrap(),
			'fallback_cb' => 'everest_news_navigation_fallback',
 		);
		wp_nav_menu( $menu_args );
 	}
endif;
add_action( 'everest_news_primary_menu', 'everest_news_primary_menu_action', 10 );


/**
 * Site identity declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'everest_news_site_identity_action' ) ) :
 	function everest_news_site_identity_action() {
 		?>
 		<div class="branding-col">
            <?php 
			if( has_custom_logo() ) { 
				the_custom_logo(); 
			} else {
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php 
                $site_description = get_bloginfo( 'description', 'display' );
                if ( $site_description || is_customize_preview() ) {
	                ?>
	                <p class="site-description"><?php echo esc_html( $site_description ); /* WPCS: xss ok. */ ?></p>
					<?php
				}
			}
			?>
        </div><!-- .branding-col -->
 		<?php
 	}
endif;
add_action( 'everest_news_site_identity', 'everest_news_site_identity_action', 10 );



/**
 * Breadcrumb declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'everest_news_breadcrumb_action' ) ) :

 	function everest_news_breadcrumb_action() {

 		$enable_breadcrumb = everest_news_get_option( 'everest_news_enable_breadcrumb' ); 

 		if( $enable_breadcrumb == true ) {
 			?>
 			<div class="en-breadcrumb breadcrumb-layout-1 en-standard-section-spacing">
                <?php
                $breadcrumb_args = array(
                    'show_browse' => false,
                );
                everest_news_breadcrumb_trail( $breadcrumb_args );
	            ?>
            </div><!-- .en-breadcrumb.breadcrumb-layout-1.en-standard-section-spacing -->
 			<?php
 		}  		
 	}
endif;
add_action( 'everest_news_breadcrumb', 'everest_news_breadcrumb_action', 10 );

/**
 * Pagination declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'everest_news_pagination_action' ) ) :

 	function everest_news_pagination_action() {
 		?>
 		<div class="en-pagination">
            <div class="pagi-layout-1">
            	<?php
	        	the_posts_pagination( array(
	        		'mid_size' 			 => 3,
	        		'prev_text'          => '<i class="fas fa-angle-left"></i>',
		            'next_text'          => '<i class="fas fa-angle-right"></i>',
	        	) );
		        ?>
            </div><!-- .pagi-layout-1 -->
        </div><!-- .cb-pagination -->
		<?php
 	}
endif;
add_action( 'everest_news_pagination', 'everest_news_pagination_action', 10 );


/**
 * Post navigation declaration of the theme.
 *
 * @since 1.0.0
 */
if( ! function_exists( 'everest_news_post_navigation_action' ) ) :

 	function everest_news_post_navigation_action() {

 		the_post_navigation( array(
			'prev_text'	=> esc_html__( 'Prev Post', 'everest-news' ),
			'next_text'	=> esc_html__( 'Next Post', 'everest-news' ),
		) );
 	}
endif;
add_action( 'everest_news_post_navigation', 'everest_news_post_navigation_action', 10 );