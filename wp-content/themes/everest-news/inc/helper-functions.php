<?php
/**
 * Helper functions for this theme.
 *
 * @package Everest_News
 */

/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'everest_news_fonts_url' ) ) :

    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function everest_news_fonts_url() {

        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== _x('on', 'Muli font: on or off', 'everest-news')) {

            $fonts[] = 'Muli:400,400i,600,700,700i';
        }

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

        if ('off' !== _x('on', 'Open Sans font: on or off', 'everest-news')) {

            $fonts[] = 'Open+Sans:400,400i,600,700,700i';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;


/**
 * Funtion to get main column wrapper class
 */
if ( !function_exists( 'everest_news_get_main_column_wapper_class' ) ) :

    /**
     * Returns main wrapper class.
     *
     * @since 1.0.0
     * @return string.
     */
    function everest_news_get_main_column_wapper_class() {

        $column_wrapper_class = '';

        $sidebar_position = everest_news_sidebar_position();

        if( is_active_sidebar( 'sidebar' ) && $sidebar_position != 'none' ) {
            $column_wrapper_class = 'columns-2';
        } else {
            $column_wrapper_class = 'columns-1';
        }

        return $column_wrapper_class;
    }
endif;


/**
 * Funtion to get sticky class when sidebar is sticky
 */
if ( !function_exists( 'everest_news_get_sticky_class' ) ) :

    /**
     * Returns sticky class.
     *
     * @since 1.0.0
     * @return string.
     */
    function everest_news_get_sticky_class() {

        $sticky_class = '';
        $is_sticky = everest_news_get_option( 'everest_news_enable_sticky_sidebar' );

        if( $is_sticky == true  && is_active_sidebar( 'sidebar' ) ) {
            $sticky_class = 'sticky-sidebar';
        }

        return $sticky_class;
    }
endif;


/**
 * Funtion To Get Sidebar Position
 */
if ( !function_exists( 'everest_news_sidebar_position' ) ) :

    /**
     * Return Position of Sidebar.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function everest_news_sidebar_position() {

        $sidebar_position = '';

        if( is_home() ) {
            $sidebar_position = everest_news_get_option( 'everest_news_select_blog_sidebar_position' );
        }

        if( is_archive() ) {
            $sidebar_position = everest_news_get_option( 'everest_news_select_archive_sidebar_position' );
        }

        if( is_search() ) {
            $sidebar_position = everest_news_get_option( 'everest_news_select_search_sidebar_position' );
        }

        if( is_single() ) {
            $sidebar_position = everest_news_page_post_sidebar_position();
        }

        if( is_page() ) {
            $sidebar_position = everest_news_page_post_sidebar_position();
        }
        
        if( empty( $sidebar_position ) ) {
            $sidebar_position = 'right';
        }

        return $sidebar_position;
    }
endif;



/*
 * Sidebar Position for single post and single page.
 */
if( ! function_exists( 'everest_news_page_post_sidebar_position' ) ) {

    function everest_news_page_post_sidebar_position() {

        $sidebar_position = get_post_meta( get_the_ID(), 'everest_news_sidebar_position', true );

        if( empty( $sidebar_position ) ) {
            $sidebar_position = 'right';
        }

        return $sidebar_position;
    }
}

/**
 * Function to get post thumbnail Alt text
 */
if( !function_exists( 'everest_news_post_thumbnail_alt_text' ) ) {

    function everest_news_post_thumbnail_alt_text( $post_id ) {

        $post_thumbnail_id = get_post_thumbnail_id( $post_id );

        $alt_text = '';

        if( !empty( $post_thumbnail_id ) ) {

            $alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
        }

        return $alt_text;
    }
}

/*
 * Hook - Plugin Recommendation
 */
if ( ! function_exists( 'everest_news_recommended_plugins' ) ) :
    /**
     * Recommend plugins.
     *
     * @since 1.0.0
     */
    function everest_news_recommended_plugins() {

        $plugins = array(
            array(
                'name'     => esc_html__( 'Everest Toolkit', 'everest-news' ),
                'slug'     => 'everest-toolkit',
                'required' => false,
            ),
        );

        tgmpa( $plugins );
    }

endif;
add_action( 'tgmpa_register', 'everest_news_recommended_plugins' );