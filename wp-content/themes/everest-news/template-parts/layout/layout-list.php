<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News_Pro
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("card"); ?>>
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-4 col-12">
            <div class="thumb">
                <?php everest_news_post_thumbnail(); ?>
                <?php everest_news_post_meta( 'clr-white', false, false, true ); ?>
            </div><!-- .thumb -->
        </div><!-- .col -->
        <div class="col-lg-7 col-md-7 col-sm-8 col-12">
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
        </div><!-- .col -->
    </div><!-- .row -->
</article>