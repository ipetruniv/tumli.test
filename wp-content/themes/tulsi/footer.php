<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * tulsi_before_footer hook.
 *
 */
do_action( 'tulsi_before_footer' );
?>

<div <?php tulsi_footer_class(); ?>>
	<?php
	/**
	 * tulsi_before_footer_content hook.
	 *
	 */
	do_action( 'tulsi_before_footer_content' );

	/**
	 * tulsi_footer hook.
	 *
	 *
	 * @hooked tulsi_construct_footer_widgets - 5
	 * @hooked tulsi_construct_footer - 10
	 */
	do_action( 'tulsi_footer' );

	/**
	 * tulsi_after_footer_content hook.
	 *
	 */
	do_action( 'tulsi_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * tulsi_after_footer hook.
 *
 */
do_action( 'tulsi_after_footer' );

wp_footer();
?>

</body>
</html>
