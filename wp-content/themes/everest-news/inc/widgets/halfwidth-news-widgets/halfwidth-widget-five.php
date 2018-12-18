<?php
/**
 * Fired during plugin activation
 *
 * @link       https://everestthemes.com
 * @since      1.0.0
 *
 * @package    Everest_News
 * @subpackage Everest_News/inc/widgets
 */
if( ! class_exists( 'Everest_News_Halfwidth_Widget_Five' ) ) {
    
    class Everest_News_Halfwidth_Widget_Five extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'everest-news-halfwidth-widget-five',  // Base ID
                esc_html__( 'EN: Halfwidth Widget 3', 'everest-news' ),   // Name
                array(
                    'description' => esc_html__( 'Displays posts. Use this widget at middle & top middle news area.', 'everest-news' ), 
                )
            ); 
        }
     
        public function widget( $args, $instance ) {

            $title_one = !empty( $instance['title_one'] ) ? $instance['title_one'] : '';

            $post_cat_one = !empty( $instance[ 'post_cat_one' ] ) ? $instance[ 'post_cat_one' ] : 0;

            $title_two = !empty( $instance['title_two'] ) ? $instance['title_two'] : '';

            $post_cat_two = !empty( $instance[ 'post_cat_two' ] ) ? $instance[ 'post_cat_two' ] : 0;

            $post_no = !empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;

            $post_args_one = array(
                'post_type' => 'post',
            );

            $post_args_two = array(
                'post_type' => 'post',
            );

            if( !empty( $post_cat_one ) ) {
                $post_args_one['cat'] = absint( $post_cat_one );
            }

            if( !empty( $post_cat_two ) ) {
                $post_args_two['cat'] = absint( $post_cat_two );
            }

            if( absint( $post_no ) > 0 ) {
                $post_args_one['posts_per_page'] = absint( $post_no );
                $post_args_two['posts_per_page'] = absint( $post_no );
            }

            $post_query_one = new WP_Query( $post_args_one );

            $post_query_two = new WP_Query( $post_args_two );

            if( $post_query_one->have_posts() || $post_query_two->have_posts() ) {
                ?>
                <section class="en-front-widget-5 en-standard-section-spacing">
                    <div class="widgets-contents-entry">
                        <div class="row">
                            <?php
                            if( $post_query_one->have_posts() ) {
                                ?>
                                <div class="en-col">
                                    <?php
                                    if( !empty( $title_one ) ) {
                                        ?>
                                        <div class="widget-title">
                                            <h3><?php echo esc_html( $title_one ); ?></h3>
                                        </div><!-- .widget-title -->
                                        <?php
                                    }

                                    $count = 1;

                                    while( $post_query_one->have_posts() ) {
                                        $post_query_one->the_post();

                                        if( $count == 1 ) {
                                            $featured_image = '';
                                            $alt_text = '';
                                            if( has_post_thumbnail() ) {
                                                $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                                $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                            }
                                            if( !empty( $featured_image ) ) {
                                                ?>
                                                <article class="card">
                                                    <div class="thumb">
                                                        <a class="lazyloading" href="<?php the_permalink(); ?>">
                                                            <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $featured_image ); ?>" data-srcset="<?php echo esc_url( $featured_image ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                            <noscript>
                                                                <img src="<?php echo esc_url( $featured_image ); ?>" srcset="<?php echo esc_url( $featured_image ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                            </noscript>
                                                       </a>
                                                       <?php everest_news_post_meta( 'clr-white', false, false, true  ); ?>
                                                    </div><!-- .thumb -->
                                                    <div class="content-holder">
                                                        <?php everest_news_post_categories_meta(); ?>
                                                        <div class="entry-title">
                                                            <h3 class="post-title f-size-m clr-primary">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                        </div>
                                                        <?php everest_news_post_meta( 'clr-special', true, true, false ); ?>
                                                        <div class="excerpt">
                                                            <?php the_excerpt(); ?>
                                                        </div>
                                                    </div><!-- .content-holder -->
                                                </article><!-- .card -->
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    wp_reset_postdata();

                                    $count = 1;
                                    while( $post_query_one->have_posts() ) {
                                        $post_query_one->the_post();

                                        if( $count > 1 ) {
                                            ?>
                                            <article class="card">
                                                <div class="en-row">
                                                    <?php
                                                    $featured_image = '';
                                                    $alt_text = '';
                                                    if( has_post_thumbnail() ) {
                                                        $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                                        $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                                    }
                                                    if( !empty( $featured_image ) ) {
                                                        ?>
                                                        <div class="left-col">
                                                            <div class="thumb">
                                                                <a class="lazyloading" href="<?php the_permalink(); ?>">
                                                                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $featured_image ); ?>" data-srcset="<?php echo esc_url( $featured_image ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                                    <noscript>
                                                                        <img src="<?php echo esc_url( $featured_image ); ?>" srcset="<?php echo esc_url( $featured_image ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                                    </noscript>
                                                               </a>
                                                            </div><!-- .thumb -->
                                                        </div><!-- .left-col -->
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="right-col">
                                                        <div class="content-holder">
                                                            <div class="entry-title">
                                                                <h3 class="post-title f-size-s clr-primary">
                                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                                </h3>
                                                            </div>
                                                            <?php everest_news_post_meta( 'clr-special', true, false, false ); ?>
                                                            <div class="excerpt">
                                                                <?php the_excerpt(); ?>
                                                            </div>
                                                        </div><!-- .content-holder -->
                                                    </div><!-- .right-col -->
                                                </div><!-- .en-row -->
                                            </article><!-- .card -->
                                            <?php
                                        }
                                        $count++;
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </div><!-- .en-col -->
                                <?php
                            }

                            if( $post_query_two->have_posts() ) {
                                ?>
                                <div class="en-col">
                                    <?php
                                    if( !empty( $title_two ) ) {
                                        ?>
                                        <div class="widget-title">
                                            <h3><?php echo esc_html( $title_two ); ?></h3>
                                        </div><!-- .widget-title -->
                                        <?php
                                    }

                                    $count = 1;

                                    while( $post_query_two->have_posts() ) {
                                        $post_query_two->the_post();

                                        if( $count == 1 ) {
                                            $featured_image = '';
                                            $alt_text = '';
                                            if( has_post_thumbnail() ) {
                                                $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                                $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                            }
                                            if( !empty( $featured_image ) ) {
                                                ?>
                                                <article class="card">
                                                    <div class="thumb">
                                                        <a class="lazyloading" href="<?php the_permalink(); ?>">
                                                            <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $featured_image ); ?>" data-srcset="<?php echo esc_url( $featured_image ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                            <noscript>
                                                                <img src="<?php echo esc_url( $featured_image ); ?>" srcset="<?php echo esc_url( $featured_image ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                            </noscript>
                                                       </a>
                                                       <?php everest_news_post_meta( 'clr-white', false, false, true  ); ?>
                                                    </div><!-- .thumb -->
                                                    <div class="content-holder">
                                                        <?php everest_news_post_categories_meta(); ?>
                                                        <div class="entry-title">
                                                            <h3 class="post-title f-size-m clr-primary">
                                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                            </h3>
                                                        </div>
                                                        <?php everest_news_post_meta( 'clr-special', true, true, false ); ?>
                                                        <div class="excerpt">
                                                            <?php the_excerpt(); ?>
                                                        </div>
                                                    </div><!-- .content-holder -->
                                                </article><!-- .card -->
                                                <?php
                                            }
                                            ?>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    wp_reset_postdata();

                                    $count = 1;
                                    while( $post_query_two->have_posts() ) {
                                        $post_query_two->the_post();

                                        if( $count > 1 ) {
                                            ?>
                                            <article class="card">
                                                <div class="en-row">
                                                    <?php
                                                    $featured_image = '';
                                                    $alt_text = '';
                                                    if( has_post_thumbnail() ) {
                                                        $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                                        $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                                    }
                                                    if( !empty( $featured_image ) ) {
                                                        ?>
                                                        <div class="left-col">
                                                            <div class="thumb">
                                                                <a class="lazyloading" href="<?php the_permalink(); ?>">
                                                                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $featured_image ); ?>" data-srcset="<?php echo esc_url( $featured_image ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                                    <noscript>
                                                                        <img src="<?php echo esc_url( $featured_image ); ?>" srcset="<?php echo esc_url( $featured_image ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                                    </noscript>
                                                               </a>
                                                            </div><!-- .thumb -->
                                                        </div><!-- .left-col -->
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="right-col">
                                                        <div class="content-holder">
                                                            <div class="entry-title">
                                                                <h3 class="post-title f-size-s clr-primary">
                                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                                </h3>
                                                            </div>
                                                            <?php everest_news_post_meta( 'clr-special', true, false, false ); ?>
                                                            <div class="excerpt">
                                                                <?php the_excerpt(); ?>
                                                            </div>
                                                        </div><!-- .content-holder -->
                                                    </div><!-- .right-col -->
                                                </div><!-- .en-row -->
                                            </article><!-- .card -->
                                            <?php
                                        }
                                        $count++;
                                    }
                                    wp_reset_postdata();
                                    ?>
                                <?php
                            }
                            ?>
                        </div><!-- .row -->
                    </div><!-- .widgets-contents-entry -->
                </section><!-- .en-front-widget-5.en-standard-section-spacing -->
                <?php
            }
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title_one'       => '',
                'post_cat_one'  => 0,
                'title_two'       => '',
                'post_cat_two'  => 0,
                'post_no'     => 6,
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('title_one') ); ?>">
                    <strong><?php esc_html_e('First Title', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title_one') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title_one') ); ?>" type="text" value="<?php echo esc_attr( $instance['title_one'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_cat_one' ) )?>"><strong><?php echo esc_html__( 'Select First Category: ', 'everest-news' ); ?></strong></label>
                <?php
                    $cat_args = array(
                        'orderby'   => 'name',
                        'hide_empty'    => 0,
                        'id'    => $this->get_field_id( 'post_cat_one' ),
                        'name'  => $this->get_field_name( 'post_cat_one' ),
                        'class' => 'widefat',
                        'taxonomy'  => 'category',
                        'selected'  => $instance['post_cat_one'],
                        'show_option_all'   => esc_html__( 'Show Recent Posts', 'everest-news' )
                    );
                    wp_dropdown_categories( $cat_args );
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('title_two') ); ?>">
                    <strong><?php esc_html_e('Second Title', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title_two') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title_two') ); ?>" type="text" value="<?php echo esc_attr( $instance['title_two'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_cat_two' ) )?>"><strong><?php echo esc_html__( 'Select Second Category: ', 'everest-news' ); ?></strong></label>
                <?php
                    $cat_args = array(
                        'orderby'   => 'name',
                        'hide_empty'    => 0,
                        'id'    => $this->get_field_id( 'post_cat_two' ),
                        'name'  => $this->get_field_name( 'post_cat_two' ),
                        'class' => 'widefat',
                        'taxonomy'  => 'category',
                        'selected'  => $instance['post_cat_two'],
                        'show_option_all'   => esc_html__( 'Show Recent Posts', 'everest-news' )
                    );
                    wp_dropdown_categories( $cat_args );
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>">
                    <strong><?php esc_html_e('No of Posts', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>" type="number" value="<?php echo esc_attr( $instance['post_no'] ); ?>" />
            </p>
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title_one']      = sanitize_text_field( $new_instance['title_one'] );

            $instance['post_cat_one']   = absint( $new_instance['post_cat_one'] );

            $instance['title_two']      = sanitize_text_field( $new_instance['title_two'] );

            $instance['post_cat_two']   = absint( $new_instance['post_cat_two'] );

            $instance['post_no']    = absint( $new_instance['post_no'] );

            return $instance;
        } 
    }   
}