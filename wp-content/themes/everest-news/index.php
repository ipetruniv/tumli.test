<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */

get_header();
$wrapper_class = everest_news_get_main_column_wapper_class();
$sticky_class = everest_news_get_sticky_class();
$sidebar_position = everest_news_sidebar_position();
?>
<div class="en-inner-pages-main-wrapper <?php echo esc_attr( $wrapper_class ); ?>">
    <div class="en-container">
        <div class="row">
            <?php
            if( $sidebar_position == 'left' && is_active_sidebar( 'sidebar' ) ) {
                get_sidebar();
            }
            ?>
            <div class="en-col main-content-area-outer <?php echo esc_attr( $sticky_class ); ?>">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <?php
                        if( have_posts() ) {
                            ?>
                            <section class="en-page-entry archive-page-entry">
                                <div class="page-contents-entry">
                                    <div class="en-archive-page-layout-2">
                                        <?php
                                        // Start of loop
                                        while( have_posts() ) {

                                            the_post();

                                            get_template_part( 'template-parts/layout/layout', 'list' );
                                        }

                                        /**
                                        * Hook - everest_news_pagination.
                                        *
                                        * @hooked everest_news_pagination_action - 10
                                        */
                                        do_action( 'everest_news_pagination' );
                                        ?>
                                    </div><!-- .en-archive-page-layout-2 -->
                                </div><!-- .page-contents-entry -->
                            </section>
                            <?php
                        } else {
                            get_template_part( 'template-parts/content', 'none' );
                        }
                        ?>
                    </main><!-- #main.site-main -->
                </div><!-- #primary.content-area -->
            </div><!-- .en-col.main-content-area-outer -->
            <?php
            if( $sidebar_position == 'right' && is_active_sidebar( 'sidebar' ) ) {
                get_sidebar();
            }
            ?>
        </div><!-- .row -->
    </div><!-- .en-container -->
</div><!-- .en-inner-pages-main-wrapper -->
<?php
get_footer();
