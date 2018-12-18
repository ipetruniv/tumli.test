<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Everest_News
 */
?>

		<footer class="footer">
            <div class="footer-inner">
                <div class="en-container">
                    <?php if( is_active_sidebar( 'footer' ) ) : ?>
                        <div class="top-footer">
                            <div class="en-row">
                                <?php dynamic_sidebar( 'footer' ); ?>
                            </div><!-- .en-row -->
                        </div><!-- .top-footer -->
                    <?php endif; ?>
                    <div class="bottom-footer">
                        <div class="row">
                            <?php
                            $copyright_text = everest_news_get_option( 'everest_news_copyright' );
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="copyright-notice">
                                    <p>
                                        <?php
                                        if( !empty( $copyright_text ) ) {
                                            /* translators: 1: Copyright Text 2: Theme name, 3: Theme author. */
                                            printf( esc_html__( '%1$s %2$s by %3$s','everest-news' ), $copyright_text, get_bloginfo( 'name' ), '<a href="'. esc_url( 'https://everestthemes.com' ) . '">' . esc_html__( 'Everestthemes', 'everest-news' ) . '</a>' );
                                        } else {
                                            /* translators: 1: Theme name, 2: Theme author. */
                                            printf( esc_html__( '%1$s by %2$s', 'everest-news' ), get_bloginfo( 'name' ), '<a href="'. esc_url( 'https://everestthemes.com' ) . '">' . esc_html__( 'Everestthemes', 'everest-news' ) . '</a>' );
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div><!-- .col -->
                            <?php

                            if( has_nav_menu( 'menu-3' ) ) {
                                ?>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="footer-navigation">
                                        <?php  wp_nav_menu( array( 'theme_location' => 'menu-3', 'container' => '', 'depth' => 1 ) );
                                        ?>
                                    </div>
                                </div><!-- .col -->
                                <?php
                            }
                            ?>
                        </div><!-- .row -->
                    </div><!-- .bottom-footer -->
                </div><!-- .en-container -->
            </div><!-- .footer-inner -->
        </footer><!-- .footer -->
    </div><!-- .en-pagewrap -->
    
<?php wp_footer(); ?>
</body>
</html>

