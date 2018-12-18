<?php
/**
 * Custom functions for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Everest_News
 */

/*
 * Menu Wrapper
 */
if( ! function_exists( 'everest_news_main_menu_wrap' ) ) {
	
	function everest_news_main_menu_wrap() {

		$header_template = everest_news_get_option( 'everest_news_select_header_layout' );
		$show_home_icon = everest_news_get_option( 'everest_news_enable_home_button' );

	  	$wrap  = '<ul id="%1$s" class="%2$s">';
	  	if( $show_home_icon == true && $header_template == 'header_2' ) {
	  		$wrap .= '<li class="home-btn"><a href="' . esc_url( home_url( '/' ) ) . '"><i class="fas fa-home"></i></a></li>';
	  	}
	  	$wrap .= '%3$s';
	  	$wrap .= '</ul>';

	  	return $wrap;
	}
}


/**
 * Fallback For Main Menu
 */
if ( !function_exists( 'everest_news_navigation_fallback' ) ) {

    function everest_news_navigation_fallback() {

    	$header_template = everest_news_get_option( 'everest_news_select_header_layout' );
    	$show_home_icon = everest_news_get_option( 'everest_news_enable_home_button' );
        ?>
        <ul>
		  	<?php 
		  	if( $show_home_icon == true && $header_template == 'header_2' ) { 
		  		?>
	        	<li class="home-btn"><a href="<?php echo esc_url( home_url( '/' ) );?>"><i class="fas fa-home"></i></a></li>
	        	<?php 
	    	}

            wp_list_pages( array( 
                'title_li' => '', 
                'depth' => 3,
            ) ); 
            ?>
        </ul>
        <?php    
    }
}


/*
 * Post Metas: Author, Date, Views, Likes, and Comments
 */
if( ! function_exists( 'everest_news_post_meta' ) ) {

	function everest_news_post_meta( $meta_class, $show_date, $show_author, $show_comment ) {
		
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$comments_number = 0;

		if( ( comments_open() || get_comments_number() ) ) {

			$comments_number = get_comments_number();
		}

		if( get_post_type() == 'post' ) {
			if( is_single() ) {
				?>
				<div class="entry-meta">
	                <ul class="metas">
	                	<?php
	                	if( $show_date == true ) {

	                		$enable_date = everest_news_get_option( 'everest_news_enable_date_meta' );

	                		if( $enable_date == true ) {
			                	?>
			                    <li class="posted-date clr-special">
			                    	<?php
					            	printf(
										/* translators: %1$s: post date. */
										esc_html_x( 'Posted On: %1$s', 'post date', 'everest-news' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
									);
					            	?>
					            </li><!-- .posted-date.clr-white -->
					            <?php
					        }
				        }

				        if( $show_author == true ) {

				        	$enable_author = everest_news_get_option( 'everest_news_enable_author_meta' );

				        	if( $enable_author == true ) {
						        ?>
			                    <li class="author clr-special">
			                    	<?php
					            	printf(
										/* translators: %1$s: post author. */
										esc_html_x( 'Posted By: %1$s', 'post author', 'everest-news' ),
										 '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
									);
					            	?>
			                    </li><!-- .author.clr-white -->
			                    <?php
			                }
		                }

		                if( $show_comment == true ) {

		                	$enable_comment = everest_news_get_option( 'everest_news_enable_comment_meta' );

		                	if( $enable_comment == true ) {
			                	?>
			                	<li class="Comment clr-special">
			                		<?php
					            	printf(
										/* translators: %1$s: post likes. */
										esc_html_x( 'Comments: %1$s', 'post likes', 'everest-news' ),
										 '<a href="' . get_the_permalink() . '">' . esc_html( $comments_number ) . '</a>'
									);
					            	?>
			                	</li>
			                	<?php
			                }
		                }
		                ?>
	                    
	                </ul><!-- .metas -->
	            </div><!-- .entry-meta -->
				<?php
			} else {
				?>
				<div class="entry-meta">
	                <ul class="metas">
	                	<?php
	                	if( $show_date == true ) {

	                		$enable_date = everest_news_get_option( 'everest_news_enable_date_meta' );

	                		if( $enable_date == true ) {
			                	?>
			                    <li class="posted-date <?php echo esc_attr( $meta_class ); ?>">
			                    	<?php
					            	printf(
										/* translators: %1$s: i tag open, %2$s: i tag close, %3$s: post date. */
										esc_html_x( '%1$s %2$s', 'post date', 'everest-news' ), '<i class="far fa-clock"></i>', '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
									);
					            	?>
					            </li><!-- .posted-date.clr-white -->
					            <?php
					        }
				        }

				        if( $show_author == true ) {

				        	$enable_author = everest_news_get_option( 'everest_news_enable_author_meta' );

				        	if( $enable_author == true ) {
						        ?>
			                    <li class="author <?php echo esc_attr( $meta_class ); ?>">
			                    	<?php
					            	printf(
										/* translators: %1$s: span i tag open, %2$s: span i tag close, %3$s: post author. */
										esc_html_x( '%1$s %2$s', 'post author', 'everest-news' ),
										'<i class="fas fa-user"></i>', '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
									);
					            	?>
			                    </li><!-- .author.clr-white -->
			                    <?php
			                }
		                }

		                if( $show_comment == true ) {

		                	$enable_comment = everest_news_get_option( 'everest_news_enable_comment_meta' );

		                	if( $enable_comment == true ) {
			                	?>
			                	<li class="Comment <?php echo esc_attr( $meta_class ); ?>">
			                		<a href="<?php the_permalink(); ?>">
			                			<i class="fas fa-comments"></i><?php echo esc_html( $comments_number ); ?>
			                		</a>
			                	</li>
			                	<?php
			                }
		                }
		                ?>
	                </ul><!-- .metas -->
	            </div><!-- .entry-meta -->
				<?php
			}
		}
	}
}


/*
 * Post Meta: Categories
 */
if( ! function_exists( 'everest_news_post_categories_meta' ) ) {

	function everest_news_post_categories_meta() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$enable_category_meta = everest_news_get_option( 'everest_news_enable_category_meta' );

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list();

			if( $enable_category_meta == true ) {

				if ( $categories_list ) {
					/* translators: 1: list of categories. */
					printf( '<div class="entry-cats">' . esc_html__( ' %1$s', 'everest-news' ) . '</div>', $categories_list ); // WPCS: XSS OK.
				}
			}
		}
	}
}

/*
 * Post Meta: Tags
 */
if( ! function_exists( 'everest_news_post_tags_meta' ) ) {

	function everest_news_post_tags_meta() {

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			$enable_tags_meta = everest_news_get_option( 'everest_news_enable_tag_meta' ); 

			if( $enable_tags_meta == true ) {

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list();
				if ( $tags_list ) {
					/* translators: 1: list of categories. */
					printf( '<div class="entry-tags"><div class="post-tags">' . esc_html__( ' %1$s', 'everest-news' ) . '</div></div>', $tags_list ); // WPCS: XSS OK.
				}
			}
		}
	}
}


/*
 * Function to get header template
 */
if( ! function_exists( 'everest_news_get_header_template' ) ) {

	function everest_news_get_header_template() {
		
		$header_template = everest_news_get_option( 'everest_news_select_header_layout' );

		switch ( $header_template ) {

			case 'header_2' :
				get_template_part( 'template-parts/header/header', 'two' );
				break;

			default : 
				get_template_part( 'template-parts/header/header', 'five' );
		}
	}
}


/*
 * Function to get header social links
 */
if( ! function_exists( 'everest_news_get_header_social_links' ) ) {

	function everest_news_get_header_social_links() {
		
		$facebook_link = everest_news_get_option( 'everest_news_facebook_link' );
		$twitter_link = everest_news_get_option( 'everest_news_twitter_link' );
		$instagram_link = everest_news_get_option( 'everest_news_instagram_link' );
		$vk_link = everest_news_get_option( 'everest_news_vk_link' );
		$linkedin_link = everest_news_get_option( 'everest_news_linkedin_link' );
		$pinterest_link = everest_news_get_option( 'everest_news_pinterest_link' );
		$reddit_link = everest_news_get_option( 'everest_news_reddit_link' );
		$googleplus_link = everest_news_get_option( 'everest_news_google_plus_link' );
		$quora_link = everest_news_get_option( 'everest_news_quora_link' );
		?>
		<ul class="social-icons-list">
			<?php
			if( !empty( $facebook_link ) ) {
				?>
				<li class="facebook"><a href="<?php echo esc_url( $facebook_link ); ?>"><i class="fab fa-facebook-f"></i></a></li>
				<?php
			}
			if( !empty( $twitter_link ) ) {
				?>
				<li class="twitter"><a href="<?php echo esc_url( $twitter_link ); ?>"><i class="fab fa-twitter"></i></a></li>
				<?php
			}
			if( !empty( $instagram_link ) ) {
				?>
				<li class="instagram"><a href="<?php echo esc_url( $instagram_link ); ?>"><i class="fab fa-instagram"></i></a></li>
				<?php
			}if( !empty( $vk_link ) ) {
				?>
				<li class="vk"><a href="<?php echo esc_url( $vk_link ); ?>"><i class="fab fa-vk"></i></a></li>
				<?php
			}
			if( !empty( $linkedin_link ) ) {
				?>
				<li class="linkedin"><a href="<?php echo esc_url( $linkedin_link ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
				<?php
			}
			if( !empty( $pinterest_link ) ) {
				?>
				<li class="pinterest"><a href="<?php echo esc_url( $pinterest_link ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
				<?php
			}if( !empty( $reddit_link ) ) {
				?>
				<li class="reddit"><a href="<?php echo esc_url( $reddit_link ); ?>"><i class="fab fa-reddit-alien"></i></a></li>
				<?php
			}
			if( !empty( $googleplus_link ) ) {
				?>
				<li class="googleplus"><a href="<?php echo esc_url( $googleplus_link ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
				<?php
			}
			if( !empty( $quora_link ) ) {
				?>
				<li class="quora"><a href="<?php echo esc_url( $quora_link ); ?>"><i class="fab fa-quora"></i></a></li>
				<?php
			}
			?>
        </ul><!-- .social-icons-list -->
		<?php
	}
}

/*
 * Function for post thumbnail
 */
if ( ! function_exists( 'everest_news_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function everest_news_post_thumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if( is_archive() || is_search() || is_home() ) {

			$thumbnail_size = '';

			if( is_archive() ) {
				$thumbnail_size = 'everest-news-thumbnail-one';
			}

			if( is_search() ) {
				$thumbnail_size = 'full';
			}

			if( is_home() ) {
				$thumbnail_size = 'everest-news-thumbnail-one';
			}

			if( has_post_thumbnail() ) {
				
				$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail_size );
				$alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
				?>
			 	<a class="lazyloading" href="<?php the_permalink(); ?>">
				 	<img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $thumbnail_url ); ?>" data-srcset="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
				 	<noscript>
				 		<img src="<?php echo esc_url( $thumbnail_url ); ?>" srcset="<?php echo esc_url( $thumbnail_url ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
				 	</noscript>

			 	</a>
				<?php
			}
		}

		if( is_single() || is_page() ) {
			if( has_post_thumbnail() ) {
				$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				?>
				<div class="featured-image">
			        <?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
			    </div><!-- .featured-image.thumb.lazyloading -->
				<?php
			}
		}
	}
endif;



/**
 * Filters For Excerpt Length
 */
if( !function_exists( 'everest_news_excerpt_length' ) ) :
    /*
     * Excerpt More
     */
    function everest_news_excerpt_length( $length ) {

        if( is_admin() ) {
            return $length;
        }

        $excerpt_length = everest_news_get_option( 'everest_news_post_excerpt_length' );

        if ( absint( $excerpt_length ) > 0 ) {
            $excerpt_length = absint( $excerpt_length );
        }

        return $excerpt_length;
    }
endif;
add_filter( 'excerpt_length', 'everest_news_excerpt_length' );