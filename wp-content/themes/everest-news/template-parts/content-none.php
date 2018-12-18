<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Everest_News
 */

?>
<section class="en-page-entry nothingfound-page-entry">
    <div class="page-title">
        <h2 class="clr-primary f-size-xl"><?php esc_html_e( 'Nothing Found !', 'everest-news' ); ?></h2>
    </div>
    <!-- // page-title -->
    <div class="page-contents-entry">
        <div class="en-nothingfound-page">
            <div class="nothingfound-message">
                <p><?php esc_html_e( 'Nothing was found at this location. Try adjusting your keyword &amp; search again ...', 'everest-news' ); ?></p>
            </div>
            <div class="nothingfound-page-search">
                <div class="search-box">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <!-- // en-nothingfound-page -->
    </div>
    <!-- // page-contents-entry -->
</section>
