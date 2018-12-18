<?php
/**
 * Helper functions for this theme
 *
 * @package Everest_News
 */

/**
 * Sanitization Function - Select
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 *
 */

/**
 * Sanitization Function - Choices
 * 
 * @param $input, $setting
 * @return $input
 */
if( !function_exists( 'everest_news_sanitize_choices' ) ) {

    function everest_news_sanitize_choices( $input, $setting ) {
        
        
        if(!empty($input)){
            $input = array_map('absint', $input);
        }
        return $input;
    } 
}


if ( !function_exists('everest_news_sanitize_select') ) {

    function everest_news_sanitize_select( $input, $setting ) {

        // Ensure input is a slug.
        $input = sanitize_key( $input );
        // Get list of choices from the control associated with the setting.
        $choices = $setting->manager->get_control( $setting->id )->choices;
        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
}

/**
 * Sanitization Function - Number
 *
 * @param $input
 * @param $setting
 * @return sanitized output
 *
 */
if ( !function_exists('everest_news_sanitize_number') ) {

    function everest_news_sanitize_number( $input, $setting ) {

        $number = absint( $input );
        // If the input is a positibe number, return it; otherwise, return the default.
        return ( $number ? $number : $setting->default );
    }
}

/**
 * Switch sanitization
 *
 * @param  string       Switch value
 * @return integer  Sanitized value
 */
if ( ! function_exists( 'everest_news_switch_sanitization' ) ) {

    function everest_news_switch_sanitization( $input ) {

        if ( true === $input ) {
            return 1;
        } else {
            return 0;
        }
    }
}