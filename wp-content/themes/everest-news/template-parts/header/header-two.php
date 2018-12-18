<?php
/**
 * Template part for displaying header layout two
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */
$show_search_btn = everest_news_get_option( 'everest_news_enable_search_button' );
$show_top_header = everest_news_get_option( 'everest_news_enable_top_header' );
?>
<header class="en-general-header header-lay-2 en-standard-section-spacing">
    <div class="header-inner">
        <?php
        if( $show_top_header == true ) {
            ?>
            <div class="header-top-wrapper">
                <div class="en-container">
                    <div class="en-row">
                        <div class="en-col category-nav-col">
                            <div class="category-navigation">
                                <?php
                                /**
                                * Hook - everest_news_header_menu_action.
                                *
                                * @hooked everest_news_header_menu_action - 10
                                */
                                do_action( 'everest_news_header_menu' );
                                ?>
                            </div><!-- .category-navigation -->
                        </div><!-- .en-col.category-nav-col -->
                        <div class="en-col social-col">
                            <?php everest_news_get_header_social_links(); ?>
                        </div><!-- .en-col.social-col -->
                    </div><!-- .en-row -->
                </div><!-- .en-container -->
            </div><!-- .header-top-wrapper -->
            <?php
        }
        ?>
        <div class="header-logo-advt-wrapper">
            <div class="en-container">
                <div class="en-row">
                    <div class="en-col logo-col">
                        <?php
                        /**
                        * Hook - everest_news_site_identity_action.
                        *
                        * @hooked everest_news_site_identity_action - 10
                        */
                        do_action( 'everest_news_site_identity' );
                        ?>
                    </div><!-- .en-col.logo-col -->
                    <?php
                    if( is_active_sidebar( 'header-advertisement' ) ) {
                        ?>
                        <div class="en-col advt-col">
                            <?php dynamic_sidebar( 'header-advertisement' ); ?>
                        </div><!-- .en-col -->
                        <?php
                    }
                    ?>
                </div><!-- .en-row.advt-col -->
            </div><!-- .en-container -->
        </div><!-- .header-logo-advt-wrapper -->

        <div class="header-nav-extra-wrapper">
            <div class="en-container">
                <div class="en-row">
                    <div class="en-col nav-col">
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
                            <?php
                            if( $show_search_btn == true ) {
                                ?>
                                <div class="header-search">
                                    <a id="search-toggle" href="javascript:;"><i class="icon ion-ios-search"></i></a>
                                    <div id="header-search">
                                        <?php get_search_form(); ?>
                                    </div><!-- .header_search -->
                                </div><!-- .header-search -->
                                <?php
                            }
                            ?>
                        </div><!-- .primary-menu-wrap -->
                    </div><!-- .en-col.nav-col -->
                </div><!-- .en-row -->
            </div><!-- .en-container -->
        </div><!-- .header-nav-extra-wrapper -->
    </div><!-- .header-inner -->
</header><!-- .en-general-header.header-lay-2.en-standard-section-spacing -->