<?php
/**
 * The template for displaying related posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Everest_News
 */
$enable_related_posts = everest_news_get_option( 'everest_news_enable_related_section' );
$section_title = everest_news_get_option( 'everest_news_related_section_title' );
$related_posts_no = everest_news_get_option( 'everest_news_related_section_posts_number');

$related_args = array(
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
);

if( absint( $related_posts_no ) > 0 ) {
	$related_args['posts_per_page'] = absint( $related_posts_no );
} else {
	$related_args['posts_per_page'] = 6;
}

$current_object = get_queried_object();

if ( $current_object instanceof WP_Post ) {
	$current_id = $current_object->ID;
	if ( absint( $current_id ) > 0 ) {
		// Exclude current post.
		$related_args['post__not_in'] = array( absint( $current_id ) );
		// Include current posts categories.
		$categories = wp_get_post_categories( $current_id );
		if ( ! empty( $categories ) ) {
			$related_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $categories,
					'operator' => 'IN',
					)
				);
		}
	}
}

$related_posts = new WP_Query( $related_args );

if( $related_posts->have_posts() && $enable_related_posts == true ) {
    ?>
    <section class="en-front-widget-9 en-related-posts-block">
    <?php
        if( !empty( $section_title ) ) {
            ?>
            <div class="related-posts-title">
                <h3 class="clr-primary f-size-l"><?php echo esc_html( $section_title ); ?></h3>
            </div><!-- .related-posts-title -->
            <?php
        }
        ?>
        <div class="widgets-contents-entry">
            <div class="row">
                <?php
                while( $related_posts->have_posts() ) {
                    $related_posts->the_post();
                    ?>
                    <div class="en-col">
                        <article class="box">
                            <div class="thumb">
                                <?php
                                $thumbnail_url = '';
                                $alt_text = '';
                                if( has_post_thumbnail() ) {
                                    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                    $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                }

                                if( !empty( $thumbnail_url ) ) {
                                    ?>
                                    <a class="lazyloading" href="<?php the_permalink(); ?>">
                                        <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $thumbnail_url ); ?>" data-srcset="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                        <noscript>
                                            <img src="<?php echo esc_url( $thumbnail_url ); ?>" srcset="<?php echo esc_url( $thumbnail_url ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                        </noscript>

                                    </a>
                                    <?php
                                }
                                everest_news_post_categories_meta(); 
                                ?>
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
                        </article><!-- .box -->
                    </div><!-- .en-col -->
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div><!-- .row -->
        </div><!-- .widgets-contents-entry -->
    </section><!-- .en-front-widget-9.en-related-posts-block -->
    <?php
}