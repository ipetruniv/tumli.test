<?php

if( ! class_exists( 'Everest_News_Author_Widget' ) ) {
    
    class Everest_News_Author_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'everest-news-author-widget',  // Base ID
                esc_html__( 'EN: Author Widget', 'everest-news' ),   // Name
                array(
                    'description' => esc_html__( 'Use this at sidebar/footer/canvas', 'everest-news' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
                
            $author_page = !empty( $instance['author_page'] ) ? $instance['author_page'] : ''; 

            $author_link_title = !empty( $instance['author_link_title'] ) ? $instance['author_link_title'] : ''; 

            $author_args = array(
                'post_type' => 'page',
                'posts_per_page' => 1,
            ); 

            if( $author_page > 0 ) {
                $author_args['page_id'] = absint( $author_page );
            }

            $author = new WP_Query( $author_args );

            

            if( $author->have_posts() ) :

                if( $args['id'] == 'footer' ) {
                    ?>
                    <div class="en-col">
                    <?php
                }

                while( $author->have_posts() ) : $author->the_post();
                    ?>
                    <div class="en-author-widget widget">
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
                            $thumbnail_url = '';
                            $alt_text = '';
                            if( has_post_thumbnail() ) {
                                $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'everest-news-thumbnail-three' );
                                $alt_text = everest_news_post_thumbnail_alt_text( get_the_ID());
                            }

                            if( !empty( $thumbnail_url ) ) {
                                ?>
                                <div class="thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php if( !empty( $alt_text ) ) { echo esc_attr( $alt_text ); } else { the_title_attribute(); } ?>">
                                    </a>
                                </div><!-- .thumbnail -->
                                <?php
                            }
                            ?>
                            
                            <div class="author-name">
                                <h3 class="f-size-m clr-primary"><?php the_title(); ?></h3>
                            </div><!-- .author-name -->
                            <div class="author-bio">
                                <?php the_excerpt(); ?>
                            </div><!-- .author-bio -->
                            <?php
                            if( !empty( $author_link_title ) ) {
                                ?>
                                <div class="read-more">
                                    <a class="btn-general" href="<?php the_permalink(); ?>"><?php echo esc_html( $author_link_title ); ?></a>
                                </div><!-- .read-more -->
                                <?php
                            }
                            ?>
                        </div><!-- .widgets-contents-entry -->
                    </div><!-- .en-author-widget -->
                    <?php
                endwhile;
                wp_reset_postdata();   

                if( $args['id'] == 'footer' ) {
                    ?>
                    </div>
                    <?php
                }             
            endif;
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title' => '',
                'author_page' => '',
                'author_link_title' => '',
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
                <label for="<?php echo esc_attr( $this->get_field_id( 'author_page' ) )?>"><strong><?php esc_html_e( 'Author Page', 'everest-news' ); ?></strong></label>
                <?php
                    wp_dropdown_pages( array(
                        'id'               => esc_attr( $this->get_field_id( 'author_page' ) ),
                        'class'            => 'widefat',
                        'name'             => esc_attr( $this->get_field_name( 'author_page' ) ),
                        'selected'         => esc_attr( $instance[ 'author_page' ] ),
                        'show_option_none' => esc_html__( '&mdash; Select Page &mdash;', 'everest-news' ),
                        )
                    );
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_name('author_link_title') ); ?>">
                    <strong><?php esc_html_e('Author Link Title', 'everest-news'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('author_link_title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('author_link_title') ); ?>" type="text" value="<?php echo esc_attr( $instance['author_link_title'] ); ?>" />   
            </p>
            <?php 
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']              = sanitize_text_field( $new_instance['title'] );

            $instance['author_page']        = absint( $new_instance['author_page'] );

            $instance['author_link_title']  = sanitize_text_field( $new_instance['author_link_title'] );

            return $instance;
        } 
    }   
}