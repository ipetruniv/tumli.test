<?php

if( ! class_exists( 'Everest_News_Banner_Widget_One' ) ) {
    
    class Everest_News_Banner_Widget_One extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'everest-news-banner-widget-one',  // Base ID
                esc_html__( 'EN: Banner Widget', 'everest-news' ),   // Name
                array(
                    'description' => esc_html__( 'First Banner Layout.', 'everest-news' ), 
                )
            ); 
        }
     
        public function widget( $args, $instance ) {

            $categories = !empty( $instance[ 'categories' ] ) ? $instance[ 'categories' ] : '';

            $no_of_posts = !empty( $instance[ 'no_of_posts' ] ) ? $instance[ 'no_of_posts' ] : 5;

            $banner_args = array(
                'post_type' => 'post'
            );

            if( absint( $no_of_posts ) > 0 ) {
                $banner_args['posts_per_page'] = absint( $no_of_posts );
            } else {
                $banner_args['posts_per_page'] = 5;
            }

            if( !empty( $categories ) ) {
                $categories = implode(',', $categories);
                $banner_args['category_name'] = $categories;
            }

            $banner_query = new WP_Query( $banner_args );

            if( $banner_query->have_posts() ) {
                ?>
                <div class="en-general-banner en-standard-section-spacing">
                    <div class="banner-inner">
                        <div class="owl-carousel" id="en-banner-lay-1">
                            <?php
                            while( $banner_query->have_posts() ) {
                                $banner_query->the_post();

                                if( has_post_thumbnail() ) {
                                    $banner_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                    ?>
                                    <div class="item">
                                        <article class="card thumb lazyload" data-bg="<?php echo esc_url( $banner_image ); ?>">
                                            <?php everest_news_post_meta( 'clr-white', false, false, true, true, true ); ?>
                                            <div class="post-overlay absolute">
                                                <?php everest_news_post_categories_meta(); ?>
                                                <div class="entry-title">
                                                    <h2 class="post-title f-size-m clr-white">
                                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h2><!-- .post-title.f-size-m.clr-white -->
                                                </div>
                                                <?php everest_news_post_meta( 'clr-white', true, true, false ); ?>
                                            </div><!-- .post-overlay.absolute -->
                                            <div class="mask"></div>
                                        </article><!-- .card.thumb.lazyload -->
                                    </div><!-- .item -->
                                    <?php
                                }
                            }
                            wp_reset_postdata();
                            ?>
                        </div><!-- #en-banner-lay-1.owl-carousel -->
                    </div><!-- .banner-inner -->
                </div><!-- .en-general-banner.en-standard-section-spacing -->
                <?php
            }
     
        }
     
        public function form( $instance ) {
            $defaults = array(
                'categories'   => '',
                'no_of_posts'     => 5,
            );

            $instance = wp_parse_args( (array) $instance, $defaults );

            ?>
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
                        <input id="<?php echo $this->get_field_id( 'categories' ) . $cat->term_id; ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" type="checkbox" value="<?php echo $cat->slug; ?>" <?php if(!empty($instance['categories'])) { ?><?php foreach ( $instance['categories'] as $checked ) { checked( $checked, $cat->slug, true ); } ?><?php } ?>><?php echo esc_html( $cat->name ); ?>
                        <br>
                        <?php
                        }
                    } else {
                        ?>
                        <input id="<?php echo $this->get_field_id( 'categories' ); ?>" name="<?php echo $this->get_field_name('categories'); ?>" type="hidden" value="" checked>
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

            $instance['categories']    = $new_instance['categories'];

            $instance['no_of_posts']    = absint( $new_instance['no_of_posts'] );

            return $instance;
        } 
    }   
}