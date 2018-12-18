<?php
/**
 * Everest News class and the class object initialization.
 *
 * @package    Everest_News
 * @author     everestthemes <themeseverest@gmail.com>
 * @copyright  Copyright (c) 2018, everestthemes
 * @link       http://everestthemes.com/themes/everest-news/
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

$everest_news_theme = wp_get_theme( 'everest-news' );

define( 'EVEREST_NEWS_VERSION', $everest_news_theme->get( 'Version' ) );

require get_template_directory() . '/inc/class-everest-news.php';


function everest_news_run() {

	$everest_news = new Everest_News();
}

everest_news_run();
