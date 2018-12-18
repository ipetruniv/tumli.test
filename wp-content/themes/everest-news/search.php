<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
        <?php
        /**
        * Hook - everest_news_breadcrumb_action.
        *
        * @hooked everest_news_breadcrumb_action - 10
        */
        do_action( 'everest_news_breadcrumb' );
        ?>
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
	                    	<section class="en-page-entry search-page-entry">
                                <div class="page-title">
                                    <h2 class="clr-primary f-size-l">
										<?php
										/* translators: %s: search query. */
										printf( esc_html__( 'Search Results for: %s', 'everest-news' ), '<span>' . get_search_query() . '</span>' );
										?>
                                    </h2><!-- .clr-primary.f-size-l -->
                                </div><!-- .page-title -->
                                <div class="page-contents-entry">
                                    <div class="en-search-page-layout-1">
                                        <div id="masonry-grids-row">
                                            <?php
                                    		// Start of loop
                                    		while( have_posts() ) {

			                                    the_post();

			                                    get_template_part( 'template-parts/layout/layout', 'masonry' );
			                                }
                                    		?>
                                        </div><!-- .masonry-grids-row -->
                                        <?php
                                    	/**
	                                    * Hook - everest_news_pagination.
	                                    *
	                                    * @hooked everest_news_pagination_action - 10
	                                    */
	                                    do_action( 'everest_news_pagination' );
                                    	?>
                                    </div><!-- .en-search-page-layout-1 -->
                                </div><!-- .page-contents-entry -->
                            </section><!-- .en-page-entry.search-page-entry -->
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
