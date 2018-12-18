<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Everest_News
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

$sticky_sidebar = everest_news_get_option( 'everest_news_enable_sticky_sidebar' );
$sticky_class = '';
if( $sticky_sidebar == true ) {
    $sticky_class = 'sticky-sidebar';
}
?>
<div class="en-col aside-sidebar-outer aside-right-outer <?php echo esc_attr( $sticky_class ); ?>">
    <aside class="secondary">
        <?php
        if( is_active_sidebar( 'sidebar' ) ) {
        	dynamic_sidebar( 'sidebar' );
        }
       	?>
    </aside><!-- .secondary -->
</div><!-- .en-col aside-sidebar-outer -->