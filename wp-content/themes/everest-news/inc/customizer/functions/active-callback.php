<?php
/**
 * Active callback functions for customizer fields
 *
 * @package Everest_News
 */

if( ! function_exists( 'everest_news_active_header_two' ) ) {

	function everest_news_active_header_two( $control ) {

		if ( $control->manager->get_setting( 'everest_news_select_header_layout' )->value() == 'header_2' ) {
			return true;
		} else {
			return false;
		}		
	}
}

if( ! function_exists( 'everest_news_active_header_two' ) ) {

	function everest_news_active_header_two( $control ) {

		if ( $control->manager->get_setting( 'everest_news_select_header_layout' )->value() == 'header_2' ) {
			return true;
		} else {
			return false;
		}
	}
}


if( ! function_exists( 'everest_news_active_header_five' ) ) {

	function everest_news_active_header_five( $control ) {

		if ( $control->manager->get_setting( 'everest_news_select_header_layout' )->value() == 'header_5' ) {
			return true;
		} else {
			return false;
		}
	}
}


if( ! function_exists( 'everest_news_active_related_posts' ) ) {

	function everest_news_active_related_posts( $control ) {

		if ( $control->manager->get_setting( 'everest_news_enable_related_section' )->value() == true ) {
			return true;
		} else {
			return false;
		}
	}
}