<?php
/**
 *  Function to display ticker news
 */
if( ! function_exists( 'everest_news_ticker_news' ) ) {

    function everest_news_ticker_news() {

        $enable_ticker_news = everest_news_get_option( 'everest_news_enable_ticker_news' );
        $ticker_news_title = everest_news_get_option( 'everest_news_ticker_news_title' );
        $ticker_news_categories = everest_news_get_option( 'everest_news_ticker_news_categories' );
        $ticker_news_no = everest_news_get_option( 'everest_news_ticker_news_posts_no' );

        $ticker_news_args = array(
            'post_type' => 'post',
        );

        if( !empty( $ticker_news_categories ) ) {
            $ticker_news_args['cat'] = $ticker_news_categories;
        }

        if( absint( $ticker_news_no ) > 0 ) {
            $ticker_news_args['posts_per_page'] = absint( $ticker_news_no );
        }

        $ticker_news_query = new WP_Query( $ticker_news_args );

        if( $ticker_news_query->have_posts() && $enable_ticker_news == true ) {
            ?>
            <div class="en-container">
                <div class="en-breaking-news en-standard-section-spacing">
                    <div class="breaking-news-inner">
                        <div class="en-row">
                            <?php 
                            if( !empty( $ticker_news_title ) ) { 
                                ?>
                                <div class="en-col ticker-head-col">
                                    <span><?php echo esc_html( $ticker_news_title ); ?></span>
                                </div><!-- .en-col.ticker-head-col -->
                                <?php
                            }
                            ?>
                            <div class="en-col ticker-items">
                                <div class="owl-carousel" id="news-ticker">
                                    <?php
                                    while( $ticker_news_query->have_posts() ) {
                                        $ticker_news_query->the_post();
                                        ?>
                                        <div class="item">
                                            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                        </div>
                                        <?php
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div><!-- .owl-carousel -->
                            </div><!-- .col -->
                        </div><!-- .en-row -->
                    </div><!-- .breaking-news-inner -->
                </div><!-- .en-breaking-news -->
            </div><!-- .en-container -->
            <?php
        }
    }
}


/**
 *  Function to display the toggle canvas sidebar.
 */
if( ! function_exists( 'everest_news_toggle_canvas_sidebar' ) ) {

    function everest_news_toggle_canvas_sidebar() {
        $show_canvas_sidebar_toggle_btn = everest_news_get_option( 'everest_news_enable_toggle_sidebar_button' );
        if( $show_canvas_sidebar_toggle_btn == true ) {
            ?>
            <div id="canvas-aside">
                <div class="canvas-inner">
                    <?php 
                    if( is_active_sidebar( 'toggle-sidebar' ) ) {
                        dynamic_sidebar( 'toggle-sidebar' );
                    } 
                    ?>
                </div><!-- .canvas-inner -->
            </div><!-- #canvas-aside -->
            <div id="canvas-aside-mask"></div>
            <?php
        }
    }
}