<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Everest_News
 */

get_header();
	?>
	<div class="en-inner-pages-main-wrapper columns-1">
        <div class="en-container">
            <div class="row">
                <div class="en-col main-content-area-outer">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <section class="en-page-entry page-404-entry">
                                <div class="page-contents-entry">
                                    <div class="header-404">
                                        <h3 class="clr-primary"><?php esc_html_e( '404', 'everest-news' ); ?></h3>
                                        <h4 class="clr-primary f-size-l"><?php esc_html_e( 'Page not found !', 'everest-news' ); ?></h4>
                                    </div>
                                    <div class="page-404-message">
                                        <p><?php esc_html_e( 'The page/post that you are looking for either has moved recently or doesn&apos;t exists in this server.', 'everest-news' ); ?></p>
                                    </div>
                                    <div class="page-404-search">
                                        <div class="search-box">
                                            <?php get_search_form(); ?>
                                        </div>
                                    </div>
                                </div><!-- .page-contents-entry -->
                            </section>
                        </main><!-- #main -->
                    </div><!-- #primary -->
                </div><!-- .en-col.main-content-area-outer -->
            </div><!-- .row -->
        </div><!-- .en-container -->
    </div><!-- .en-inner-pages-main-wrapper -->
	<?php
get_footer();
