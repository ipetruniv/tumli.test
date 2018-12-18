<?php

if( ! class_exists( 'Everest_News_Fullwidth_Widget_Two' ) ) {
    
    class Everest_News_Fullwidth_Widget_Two extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'everest-news-fullwidth-widget-two',  // Base ID
                esc_html__( 'EN: Fullwidth Widget 1', 'everest-news' ),   // Name
                array(
                    'description' => esc_html__( 'Displays posts. Use this widget at full-width top & bottom news area.', 'everest-news' ), 
                )
            ); 
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $categories = !empty( $instance[ 'categories' ] ) ? $instance[ 'categories' ] : '';

            $no_of_posts = !empty( $instance[ 'no_of_posts' ] ) ? $instance[ 'no_of_posts' ] : 6;

            $banner_args = array(
                'post_type' => 'post'
            );

            if( absint( $no_of_posts ) > 0 ) {
                $banner_args['posts_per_page'] = absint( $no_of_posts );
            } else {
                $banner_args['posts_per_page'] = 6;
            }

            if( !empty( $categories ) ) {
                $categories = implode(',', $categories);
                $banner_args['category_name'] = $categories;
            }

            $banner_query = new WP_Query( $banner_args );

            if( $banner_query->have_posts() ) {
                ?>
                <section class="en-front-widget-7 en-standard-section-spacing">
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
                        <div class="en-row">
                            <?php
                            while( $banner_query->have_posts() ) {
                                $banner_query->the_post();

                                $banner_image = '';
                                $alt_text = '';
                                if( has_post_thumbnail() ) {
                                    $banner_image = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-one' );
                                    $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                                }
                                ?>
                                <div class="en-col">
                                    <article class="box">
                                        <div class="left-box">
                                            <div class="thumb">
                                                <a class="lazyloading" href="<?php the_permalink(); ?>">
                                                    <img class="lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="<?php echo esc_url( $banner_image ); ?>" data-srcset="<?php echo esc_url( $banner_image ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                    <noscript>
                                                        <img src="<?php echo esc_url( $banner_image ); ?>" srcset="<?php echo esc_url( $banner_image ); ?>" class="image-fallback" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                                    </noscript>
                                               </a>
                                            </div><!-- .thumb -->
                                        </div><!-- .left-box -->
                                        <div class="right-box">
                                            <div class="content-holder">
                                                <div class="entry-title">
                                                    <h3 class="post-title f-size-s clr-primary"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                </div>
                                                <?php everest_news_post_meta( 'clr-special', true, false, true ); ?>
                                            </div><!-- .content-holder -->
                                        </div><!-- .right-box -->
                                    </article><!-- .box -->
                                </div><!-- .en-col -->
                                <?php
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- .en-row -->
                    </div><!-- .widgets-contents-entry -->
                </section><!-- .en-front-widget-7.en-standard-section-spacing -->
                <?php
            }
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title'       => '',
                'categories'   => '',
                'no_of_posts'     => 6,
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
                <label for="<?php echo esc_attr( $this->get_field_id( 'product_cat' ) )?>"><strong><?php echo esc_html__( 'Select Category:', 'everest-news' ); ?></strong></label>
                <span class="widget_multicheck">
                <br>
                <?php
                    $categories = get_terms( 
                        array( 
                            'taxonomy' => 'category', 
                        )
                    );
                    if( !empty( $categories ) ) {
                        foreach($categories as $cat) {
                        ?>
                        <input id="<?php echo esc_attr( $this->get_field_id( 'categories' ) . $cat->term_id ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories') ); ?>[]" type="checkbox" value="<?php echo esc_attr( $cat->slug ); ?>" <?php if(!empty($instance['categories'])) { ?><?php foreach ( $instance['categories'] as $checked ) { checked( $checked, $cat->slug, true ); } ?><?php } ?>><?php echo esc_html( $cat->name ); ?>
                        <br>
                        <?php
                        }
                    } else {
                        ?>
                        <input id="<?php echo esc_attr( $this->get_field_id( 'categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories') ); ?>" type="hidden" value="" checked>
                        <small><?php echo esc_html__( 'No categories to select.', 'everest-news' ); ?></small>
                        <?php
                    }
                ?>
                </span>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('no_of_posts') ); ?>">
                    <strong><?php esc_html_e('No of Posts', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('no_of_posts') ); ?>" name="<?php echo esc_attr( $this->get_field_name('no_of_posts') ); ?>" type="number" value="<?php echo esc_attr( $instance['no_of_posts'] ); ?>" />   
            </p>
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']      = sanitize_text_field( $new_instance['title'] );

            $instance['categories']    = array_map( 'sanitize_key', $new_instance['categories'] );

            $instance['no_of_posts']    = absint( $new_instance['no_of_posts'] );

            return $instance;
        } 
    }   
}