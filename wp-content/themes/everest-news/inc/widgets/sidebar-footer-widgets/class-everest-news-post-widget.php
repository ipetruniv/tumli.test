<?php
/**
 * Everest News Core class and the class object initialization.
 *
 * @package    Everest_News
 * @author     everestthemes <themeseverest@gmail.com>
 * @copyright  Copyright (c) 2018, everestthemes
 * @link       http://everestthemes.com/themes/everest-news/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
if( ! class_exists( 'Everest_News_Post_Widget' ) ) {

    class Everest_News_Post_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'everest-news-post-widget',  // Base ID
                esc_html__( 'EN: Sidebar Posts Widget', 'everest-news' ),   // Name
                array(
                    'description' => esc_html__( 'Displays Recent Posts. Use this at sidebar/footer/canvas.', 'everest-news' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $posts_no = !empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;

            $layout = !empty( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : 'layout_one';

            $post_args = array(
                'post_type' => 'post'
            );

            if( absint( $posts_no ) > 0 ) {
                $post_args['posts_per_page'] = absint( $posts_no );
            }

            $post_query = new WP_Query( $post_args );

            if( $post_query->have_posts() ) {

                if( $args['id'] == 'footer' ) {
                    ?>
                    <div class="en-col">
                    <?php
                }

                if( $layout == 'layout_one' ) {
                    ?>
                    <div class="en-postwidget en-trending-posts-widget widget">
                        <?php
                        if( !empty( $title ) ) {
                            ?>
                            <div class="widget-title">
                                <h3><?php echo esc_html( $title ); ?></h3>
                            </div><!-- .widget-title -->
                            <?php
                        }
                        ?>
                        <div class="widgets-contents-entry">
                            <?php
                            while( $post_query->have_posts() ) {
                                $post_query->the_post();
                                ?>
                                <article class="box">
                                    <div class="left-box">
                                        <div class="thumb">
                                            <a class="lazyloading" href="<?php the_permalink(); ?>">
                                                <?php
                                                $thumbnail_url = '';
                                                $alt_text = '';
                                                if( has_post_thumbnail() ) {
                                                    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                                    $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                                }

                                                if( !empty( $thumbnail_url ) ) {
                                                    ?>
                                                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $thumbnail_url ); ?>" data-srcset="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                    <noscript>
                                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" srcset="<?php echo esc_url( $thumbnail_url ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                    </noscript>
                                                    <?php
                                                }
                                                ?>
                                            </a>
                                        </div><!-- .thumb -->
                                    </div><!-- .left-box -->
                                    <div class="right-box">
                                        <div class="content-holder">
                                            <div class="entry-title">
                                                <h3 class="post-title f-size-s clr-primary">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                            </div><!-- .entry-title -->
                                            <?php everest_news_post_meta( 'clr-special', true, false, false ); ?>
                                        </div><!-- .content-holder -->
                                    </div><!-- .right-box -->
                                </article><!-- .box --> 
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- .widgets-contents-entry -->
                    </div><!-- .en-postwidget.en-trending-posts-widget.widget -->
                    <?php
                } else {
                    ?>
                    <div class="en-postwidget en-latestpost widget">
                        <?php
                        if( !empty( $title ) ) {
                            ?>
                            <div class="widget-title">
                                <h3><?php echo esc_html( $title ); ?></h3>
                            </div><!-- .widget-title -->
                            <?php
                        }
                        ?>
                        <div class="widgets-contents-entry">
                            <?php
                            while( $post_query->have_posts() ) {
                                $post_query->the_post();
                                ?>
                                <article class="box">
                                    <div class="thumb">
                                        <a class="lazyloading" href="<?php the_permalink(); ?>">
                                            <?php
                                            $thumbnail_url = '';
                                            $alt_text = '';
                                            if( has_post_thumbnail() ) {
                                                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                                $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                            }
                                            if( !empty( $thumbnail_url ) ) {
                                                ?>
                                                <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $thumbnail_url ); ?>" data-srcset="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                <noscript>
                                                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" srcset="<?php echo esc_url( $thumbnail_url ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                </noscript>
                                                <?php
                                            }
                                            ?>
                                        </a>
                                        <?php everest_news_post_categories_meta(); ?>
                                    </div><!-- .thumb -->
                                    <div class="content-holder">
                                        <div class="entry-title">
                                            <h3 class="post-title f-size-s clr-primary"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        </div>
                                        <?php everest_news_post_meta( 'clr-special', true, false, false  ); ?>
                                    </div><!-- .content-holder -->
                                </article><!-- .box -->
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- .widgets-contents-entry -->
                    </div><!-- .en-postwidget.en-latestpost.widget -->
                    <?php
                }

                if( $args['id'] == 'footer' ) {
                    ?>
                    </div>
                    <?php
                }              
            }
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title'       => '',
                'post_no'     => 5,
                'layout' => 'layout_one',
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>">
                    <strong><?php esc_html_e('No of Posts', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>" type="number" value="<?php echo esc_attr( $instance['post_no'] ); ?>" />   
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('layout') ); ?>">
                    <?php esc_html_e('Display Layout:', 'everest-news'); ?>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>">
                    <?php
                        $layout_choices = array(
                            'layout_one' => esc_html__( 'Layout One', 'everest-news' ),
                            'layout_two' => esc_html__( 'Layout Two', 'everest-news' ),
                        );

                        foreach( $layout_choices as $key => $layout ) {
                            ?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php if( $instance['layout'] == $key ) { echo esc_attr( 'selected' ); } ?>>
                                <?php
                                    echo esc_html( $layout );
                                ?>
                            </option>
                            <?php
                        }
                    ?>
                </select>
            </p> 
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']      = sanitize_text_field( $new_instance['title'] );

            $instance['post_no']    = absint( $new_instance['post_no'] );

            $instance['layout']    = sanitize_text_field( $new_instance['layout'] );

            return $instance;
        } 
    }
}
