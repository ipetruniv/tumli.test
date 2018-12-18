<?php
/**
 * The template for displaying single posts.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php tulsi_article_schema( 'CreativeWork' ); ?>>
	<div class="inside-article">
		<?php
		/**
		 * tulsi_before_content hook.
		 *
		 *
		 * @hooked tulsi_featured_page_header_inside_single - 10
		 */
		do_action( 'tulsi_before_content' );
		?>

		<header class="entry-header">
			<?php
			/**
			 * tulsi_before_entry_title hook.
			 *
			 */
			do_action( 'tulsi_before_entry_title' );

			if ( tulsi_show_title() ) {
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			}

			/**
			 * tulsi_after_entry_title hook.
			 *
			 *
			 * @hooked tulsi_post_meta - 10
			 */
			do_action( 'tulsi_after_entry_title' );
			?>
		</header><!-- .entry-header -->

		<?php
		/**
		 * tulsi_after_entry_header hook.
		 *
		 *
		 * @hooked tulsi_post_image - 10
		 */
		do_action( 'tulsi_after_entry_header' );
		?>

		<div class="entry-content" itemprop="text">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'tulsi' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php
		/**
		 * tulsi_after_entry_content hook.
		 *
		 *
		 * @hooked tulsi_footer_meta - 10
		 */
		do_action( 'tulsi_after_entry_content' );

		/**
		 * tulsi_after_content hook.
		 *
		 */
		do_action( 'tulsi_after_content' );
		?>
	</div><!-- .inside-article -->
</article><!-- #post-## -->
