<?php

if( ! class_exists( 'Everest_News_Social_Widget_One' ) ) {

    class Everest_News_Social_Widget_One extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'everest-news-social-widget-one',  // Base ID
                esc_html__( 'EN: Social Widget', 'everest-news' ),   // Name
                array(
                    'description' => esc_html__( 'Use this widget at sidebar/footer/canvas', 'everest-news' ), 
                )
            );
     
        }
     
        public function widget( $args, $instance ) {

            $title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $facebook       = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
            $twitter        = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
            $google_plus    = ! empty( $instance['google_plus'] ) ? $instance['google_plus'] : '';
            $instagram      = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
            $linkedin       = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
            $youtube        = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
            $pinterest      = ! empty( $instance['pinterest'] ) ? $instance['pinterest'] : '';
            $reddit         = ! empty( $instance['reddit'] ) ? $instance['reddit'] : '';
            $vk             = ! empty( $instance['vk'] ) ? $instance['vk'] : '';
            $medium         = ! empty( $instance['medium'] ) ? $instance['medium'] : '';
            $vimeo          = ! empty( $instance['vimeo'] ) ? $instance['vimeo'] : '';
            $quora          = ! empty( $instance['quora'] ) ? $instance['quora'] : '';
            

            if( $args['id'] == 'footer' ) {
                ?>
                <div class="en-col">
                <?php
            }
            ?>
            <div class="en-socialwidget widget">
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
                    <ul class="social-icons-list colored">
                        <?php
                        if( !empty( $facebook ) ) {
                            ?>
                            <li class="facebook"><a href="<?php echo esc_url( $facebook ); ?>"><i class="fab fa-facebook-f"></i> <span><?php esc_html_e( 'Facebook', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if( !empty( $twitter ) ) {
                            ?>
                            <li class="twitter"><a href="<?php echo esc_url( $twitter ); ?>"><i class="fab fa-twitter"></i> <span><?php esc_html_e( 'Twitter', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if( !empty( $instagram ) ) {
                            ?>
                            <li class="instagram"><a href="<?php echo esc_url( $instagram ); ?>"><i class="fab fa-instagram"></i> <span><?php esc_html_e( 'Instagram', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if( !empty( $vk ) ) {
                            ?>
                            <li class="vk"><a href="<?php echo esc_url( $vk ); ?>"><i class="fab fa-vk"></i> <span><?php esc_html_e( 'Vk', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if( !empty( $linkedin ) ) {
                            ?>
                            <li class="linkedin"><a href="<?php echo esc_url( $linkedin ); ?>"><i class="fab fa-linkedin-in"></i> <span><?php esc_html_e( 'Linkedin', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if( !empty( $pinterest ) ) {
                            ?>
                            <li class="pinterest"><a href="<?php echo esc_url( $pinterest ); ?>"><i class="fab fa-pinterest-p"></i> <span><?php esc_html_e( 'Pinterest', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                        <?php
                        if( !empty( $reddit ) ) {
                            ?>
                            <li class="reddit"><a href="<?php echo esc_url( $reddit ); ?>"><i class="fab fa-reddit-alien"></i> <span><?php esc_html_e( 'Reddit', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        if( !empty( $google_plus ) ) {
                            ?>
                            <li class="googleplus"><a href="<?php echo esc_url( $google_plus ); ?>"><i class="fab fa-google-plus-g"></i> <span><?php esc_html_e( 'Google +', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        if( !empty( $vimeo ) ) {
                            ?>
                            <li class="vimeo"><a href="<?php echo esc_url( $vimeo ); ?>"><i class="fab fa-vimeo-v"></i> <span><?php esc_html_e( 'Vimeo', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        if( !empty( $youtube ) ) {
                            ?>
                            <li class="youtube"><a href="<?php echo esc_url( $youtube ); ?>"><i class="fab fa-youtube"></i> <span><?php esc_html_e( 'Youtube', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        if( !empty( $quora ) ) {
                            ?>
                            <li class="quora"><a href="<?php echo esc_url( $quora ); ?>"><i class="fab fa-quora"></i> <span><?php esc_html_e( 'Quora', 'everest-news' ); ?></span></a></li>
                            <?php
                        }

                        if( !empty( $medium ) ) {
                            ?>
                            <li class="medium"><a href="<?php echo esc_url( $medium ); ?>"><i class="fab fa-medium-m"></i> <span><?php esc_html_e( 'Medium', 'everest-news' ); ?></span></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div><!-- .widgets-contents-entry -->
            </div><!-- .en-socialwidget.widget -->
            <?php
            if( $args['id'] == 'footer' ) {
                ?>
                </div>
                <?php
            }  
        }
     
        public function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, 
                array(
                    'title'         => '',
                    'facebook'      => '',
                    'twitter'       => '',
                    'google_plus'   => '',
                    'instagram'     => '',
                    'linkedin'      => '',
                    'youtube'       => '',
                    'pinterest'     => '',
                    'reddit'        => '',
                    'vk'            => '',
                    'medium'        => '',
                    'vimeo'         => '',
                    'quora'         => '',
                ) 
            );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                    <strong><?php esc_html_e( 'Title: ', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
                    <strong><?php esc_html_e( 'Facebook Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo esc_attr( $instance['facebook'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
                    <strong><?php esc_html_e( 'Twitter Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo esc_attr( $instance['twitter'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>">
                    <strong><?php esc_html_e( 'Google Plus Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_plus' ) ); ?>" value="<?php echo esc_attr( $instance['google_plus'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
                    <strong><?php esc_html_e( 'Instagram Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" value="<?php echo esc_attr( $instance['instagram'] ); ?>">
            </p> 

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>">
                    <strong><?php esc_html_e( 'linkedin Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" value="<?php echo esc_attr( $instance['linkedin'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>">
                    <strong><?php esc_html_e( 'Youtube Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" value="<?php echo esc_attr( $instance['youtube'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>">
                    <strong><?php esc_html_e( 'Pinterest Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'pinterest' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest' ) ); ?>" value="<?php echo esc_attr( $instance['pinterest'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>">
                    <strong><?php esc_html_e( 'Reddit Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'reddit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reddit' ) ); ?>" value="<?php echo esc_attr( $instance['reddit'] ); ?>">
            </p>   

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>">
                    <strong><?php esc_html_e( 'VK Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vk' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vk' ) ); ?>" value="<?php echo esc_attr( $instance['vk'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'medium' ) ); ?>">
                    <strong><?php esc_html_e( 'Medium Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'medium' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'medium' ) ); ?>" value="<?php echo esc_attr( $instance['medium'] ); ?>">
            </p>     

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>">
                    <strong><?php esc_html_e( 'Vimeo Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo' ) ); ?>" value="<?php echo esc_attr( $instance['vimeo'] ); ?>">
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'quora' ) ); ?>">
                    <strong><?php esc_html_e( 'Quora Link:', 'everest-news' ); ?></strong>
                </label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'quora' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'quora' ) ); ?>" value="<?php echo esc_attr( $instance['quora'] ); ?>">
            </p> 
            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance[ 'title' ]        = sanitize_text_field( $new_instance[ 'title' ] );

            $instance[ 'facebook' ]     = esc_url_raw( $new_instance[ 'facebook' ] );

            $instance[ 'twitter' ]      = esc_url_raw( $new_instance[ 'twitter' ] );

            $instance[ 'google_plus' ]  = esc_url_raw( $new_instance[ 'google_plus' ] );

            $instance[ 'instagram' ]    = esc_url_raw( $new_instance[ 'instagram' ] );

            $instance[ 'linkedin' ]     = esc_url_raw( $new_instance[ 'linkedin' ] );

            $instance[ 'youtube' ]      = esc_url_raw( $new_instance[ 'youtube' ] );

            $instance[ 'pinterest' ]    = esc_url_raw( $new_instance[ 'pinterest' ] );

            $instance[ 'reddit' ]       = esc_url_raw( $new_instance[ 'reddit' ] );

            $instance[ 'vk' ]           = esc_url_raw( $new_instance[ 'vk' ] );

            $instance[ 'medium' ]       = esc_url_raw( $new_instance[ 'medium' ] );

            $instance[ 'vimeo' ]        = esc_url_raw( $new_instance[ 'vimeo' ] );

            $instance[ 'quora' ]        = esc_url_raw( $new_instance[ 'quora' ] );

            return $instance;
        } 
    }
}