<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */

?>
<section class="en-page-entry default-page-entry">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="page-title">
            <h2 class="clr-primary f-size-xl"><?php the_title(); ?></h2>
        </div><!-- .page-title -->
        <?php everest_news_post_thumbnail(); ?>
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
</section>
