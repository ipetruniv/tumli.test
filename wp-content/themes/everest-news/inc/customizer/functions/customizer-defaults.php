<?php

if ( ! function_exists( 'everest_news_get_option' ) ) {

    /**
     * Get theme option.
     *
     * @since 1.0.0
     *
     * @param string $key Option key.
     * @return mixed Option value.
     */
    function everest_news_get_option( $key ) {

           if ( empty( $key ) ) {
            return;
        }

        $value = '';

        $default = everest_news_get_default_theme_options();

        $default_value = null;

        if ( is_array( $default ) && isset( $default[ $key ] ) ) {
            $default_value = $default[ $key ];
        }

        if ( null !== $default_value ) {
            $value = get_theme_mod( $key, $default_value );
        }
        else {
            $value = get_theme_mod( $key );
        }

        return $value;
    }
}


if ( ! function_exists( 'everest_news_get_default_theme_options' ) ) {

    /**
     * Get default theme options.
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function everest_news_get_default_theme_options() {

        $defaults = array();

        $defaults['everest_news_page_layout'] = 'fullwidth';

        $defaults['everest_news_enable_ticker_news'] = false;
        $defaults['everest_news_ticker_news_title'] = esc_html__( 'Breaking News', 'everest-news' );
        $defaults['everest_news_ticker_news_posts_no'] = 5;

        $defaults['everest_news_homepage_sidebar'] = 'right';

        $defaults['everest_news_enable_top_header'] = true;
        $defaults['everest_news_enable_home_button'] = true;
        $defaults['everest_news_enable_search_button'] = true;
        $defaults['everest_news_enable_toggle_sidebar_button'] = true;
        $defaults['everest_news_select_header_layout'] = 'header_2';
        
        $defaults['everest_news_copyright'] = '';

        $defaults['everest_news_select_blog_sidebar_position'] = 'right';

        $defaults['everest_news_select_archive_sidebar_position'] = 'right';

        $defaults['everest_news_select_search_sidebar_position'] = 'right';

        $defaults['everest_news_enable_author_section'] = false;

        $defaults['everest_news_enable_related_section'] = false;
        $defaults['everest_news_related_section_title'] = '';
        $defaults['everest_news_related_section_posts_number'] = 6;        

        $defaults['everest_news_enable_category_meta'] = true;
        $defaults['everest_news_enable_date_meta'] = true;
        $defaults['everest_news_enable_author_meta'] = true;
        $defaults['everest_news_enable_tag_meta'] = true;
        $defaults['everest_news_enable_comment_meta'] = true;

        $defaults['everest_news_post_excerpt_length'] = 15;

        $defaults['everest_news_facebook_link'] = '';
        $defaults['everest_news_twitter_link'] = '';
        $defaults['everest_news_instagram_link'] = '';
        $defaults['everest_news_google_plus_link'] = '';
        $defaults['everest_news_vk_link'] = '';
        $defaults['everest_news_linkedin_link'] = '';
        $defaults['everest_news_reddit_link'] = '';
        $defaults['everest_news_quora_link'] = '';
        $defaults['everest_news_pinterest_link'] = '';

        $defaults['everest_news_enable_breadcrumb'] = true;

        $defaults['everest_news_enable_scroll_top_button'] = true;
        $defaults['everest_news_enable_sticky_sidebar'] = true;        

        $defaults['everest_news_primary_theme_color'] = '#ED1D25';

        return $defaults;
    }
}