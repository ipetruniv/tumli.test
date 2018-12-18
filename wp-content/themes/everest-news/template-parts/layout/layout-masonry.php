<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */
?>
<div class="masonry-item">
    <article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
        <div class="thumb">
            <?php everest_news_post_thumbnail(); ?>
        </div><!-- .thumb -->
        <div class="content-holder">
            <div class="entry-title">
                <h3 class="post-title f-size-s clr-primary">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3><!-- .post-title.f-size-s.clr-primary -->
            </div><!-- .entry-title -->
            <?php everest_news_post_meta( 'clr-special', true, true, false ); ?>
            <div class="excerpt">
                <?php the_excerpt(); ?>
            </div><!-- .excerpt -->
        </div><!-- .content-holder -->
    </article><!-- .card -->
</div><!-- .masonry-item -->