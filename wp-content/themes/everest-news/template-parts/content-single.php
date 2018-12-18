<?php
/**
 * Template part for displaying post detail
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */

?>
<section class="en-page-entry post-page-entry post-page-layout-1">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="page-title">
            <h2 class="clr-white f-size-xl">
                <?php the_title(); ?>
            </h2><!-- .clr-white.f-size-xl -->
        </div><!-- .page-title -->
        <?php
        everest_news_post_thumbnail();
        
        everest_news_post_meta( 'clr-white', true, true, true );
        ?>
        
        <div class="page-contents-entry">
            <div class="editor-entry">
                <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'everest-news' ),
                    'after'  => '</div>',
                ) );
                ?>
            </div><!-- .editor-entry -->
        </div><!-- .page-contents-entry -->
    </article>
</section><!-- .en-page-entry.post-page-entry.post-page-layout-1 -->