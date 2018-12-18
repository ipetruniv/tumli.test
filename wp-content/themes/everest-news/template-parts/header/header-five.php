<?php
/**
 * Template part for displaying header layout five
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */
$show_canvas_sidebar_toggle_btn = everest_news_get_option( 'everest_news_enable_toggle_sidebar_button' );
$show_search_btn = everest_news_get_option( 'everest_news_enable_search_button' );
?>
<header class="en-general-header header-lay-5 en-standard-section-spacing">
    <div class="header-inner">
        <div class="mid-header-outer">
            <div class="en-container">
                <div class="mid-header-inner">
                    <div class="row">
                        <div class="en-col social-col">
                            <?php everest_news_get_header_social_links(); ?>
                        </div><!-- .en-col -->
                        <div class="en-col logo-col">
                            <?php
                            /**
                            * Hook - everest_news_site_identity_action.
                            *
                            * @hooked everest_news_site_identity_action - 10
                            */
                            do_action( 'everest_news_site_identity' );
                            ?>
                        </div><!-- .en-col -->
                        <div class="en-col search-col">
                            <div class="header-search">
                                <?php 
                                if( $show_canvas_sidebar_toggle_btn == true ) { 
                                    ?>
                                    <a id="canvas-toggle" href="javascript:;"><i class="icon ion-ios-menu"></i></a>
                                    <?php
                                }
                                if( $show_search_btn == true ) {
                                    ?>
                                    <a id="search-toggle" href="javascript:;"><i class="icon ion-ios-search"></i></a>
                                    <div id="header-search">
                                        <?php get_search_form(); ?>
                                    </div><!-- .header_search -->
                                    <?php
                                }
                                ?>
                            </div><!-- .header-extra -->
                        </div><!-- .en-col.search-col -->
                    </div><!-- .row -->
                </div><!-- .mid-header-inner -->
            </div><!-- .en-container -->
        </div><!-- .mid-header-outer -->

        <div class="navigation-outer">
            <div class="en-container">
                <div class="row">
                    <div class="col-12">
                        <div class="primary-menu-wrap">
                            <div class="main-navigation" id="main-menu">
                                <?php
                                /**
                                * Hook - everest_news_primary_menu_action.
                                *
                                * @hooked everest_news_primary_menu_action - 10
                                */
                                do_action( 'everest_news_primary_menu' );
                                ?>
                            </div><!-- #main-menu.main-navigation -->
                        </div><!-- .primary-menu-wrap -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .en-container -->
        </div><!-- .navigation-outer -->
    </div><!-- .header-inner -->
</header><!-- .en-general-header.header-lay-5.en-standard-section-spacing -->