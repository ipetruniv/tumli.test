<?php
/**
 * Template part for displaying author detail
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */
$enable_author_section = everest_news_get_option( 'everest_news_enable_author_section' );
if( $enable_author_section == true ) {
	?>
	<div class="en-author-box">
        <div class="author-box-inner">
            <div class="author-thumb">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 300 ); ?>
            </div><!-- .author-thumb -->
            <div class="author-box-contents">
                <div class="author-name">
                    <h3 class="clr-primary f-size-m"><?php echo esc_html( get_the_author() ); ?></h3>
                </div><!-- .author-name -->
                <div class="author-desc">
                    <p><?php the_author_meta('description'); ?></p>
                </div><!-- .author-desc -->
            </div><!-- .author-box-contents -->
        </div><!-- .author-box-inner -->
    </div><!-- .en-author-box -->
	<?php
}