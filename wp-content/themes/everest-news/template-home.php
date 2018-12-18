<?php
/**
 * Template Name: Home Page Template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Everest_News
 */

get_header();

everest_news_ticker_news();

    ?>
    <div class="en-container">
    	<?php
    	if( is_active_sidebar( 'banner-widget-area' ) ) {
    		dynamic_sidebar( 'banner-widget-area' );
    	}
        
        if( is_active_sidebar( 'fullwidth-top-news-area' ) ) {
            dynamic_sidebar( 'fullwidth-top-news-area' );
        }
        ?>

        <div class="en-widgets-holder-mid-block-wrap column-2-layout">
            <div class="row">
                <?php
                $home_sidebar_position = everest_news_get_option( 'everest_news_homepage_sidebar' );
                if( $home_sidebar_position == 'left' ) {
                    get_sidebar();
                }
                ?>
                <div class="en-col main-content-box-outer sticky-sidebar">
                    <?php
                    if( is_active_sidebar( 'middle-news-area' ) ) { 
                        dynamic_sidebar( 'middle-news-area' ); 
                    }
                    ?>
                </div><!-- .en-col main-content-box-outer -->
                <?php
                if( $home_sidebar_position == 'right' ) {
                    get_sidebar();
                }
                ?>
            </div><!-- .row -->
        </div><!-- .en-widgets-holder-mid-block-wrap.column-2-layout -->

        <?php
        if( is_active_sidebar( 'fullwidth-bottom-news-area' ) ) {
            dynamic_sidebar( 'fullwidth-bottom-news-area' );
        }
        ?>
    </div><!-- .en-container -->
    <?php

get_footer();