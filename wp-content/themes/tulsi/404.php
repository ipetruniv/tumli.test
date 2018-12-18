<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php tulsi_content_class(); ?>>
		<main id="main" <?php tulsi_main_class(); ?>>
			<?php
			/**
			 * tulsi_before_main_content hook.
			 *
			 */
			do_action( 'tulsi_before_main_content' );
			?>

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
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'tulsi_404_title', __( 'Oops! That page can&rsquo;t be found.', 'tulsi' ) ); // WPCS: XSS OK. ?></h1>
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
					echo '<p>' . apply_filters( 'tulsi_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'tulsi' ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * tulsi_after_content hook.
				 *
				 */
				do_action( 'tulsi_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
			/**
			 * tulsi_after_main_content hook.
			 *
			 */
			do_action( 'tulsi_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * tulsi_after_primary_content_area hook.
	 *
	 */
	 do_action( 'tulsi_after_primary_content_area' );

	 tulsi_construct_sidebars();

get_footer();
