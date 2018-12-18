<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'tulsi_create_menu' ) ) {
	add_action( 'admin_menu', 'tulsi_create_menu' );
	/**
	 * Adds our "Tulsi" dashboard menu item
	 *
	 */
	function tulsi_create_menu() {
		$tulsi_page = add_theme_page( 'Tulsi', 'Tulsi', apply_filters( 'tulsi_dashboard_page_capability', 'edit_theme_options' ), 'tulsi-options', 'tulsi_settings_page' );
		add_action( "admin_print_styles-$tulsi_page", 'tulsi_options_styles' );
	}
}

if ( ! function_exists( 'tulsi_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Tulsi dashboard page
	 *
	 */
	function tulsi_options_styles() {
		wp_enqueue_style( 'tulsi-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), TULSI_VERSION );
	}
}

if ( ! function_exists( 'tulsi_settings_page' ) ) {
	/**
	 * Builds the content of our Tulsi dashboard page
	 *
	 */
	function tulsi_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="tulsi-masthead clearfix">
					<div class="tulsi-container">
						<div class="tulsi-title">
							<a href="<?php echo esc_url(TULSI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Tulsi', 'tulsi' ); ?></a> <span class="tulsi-version"><?php echo TULSI_VERSION; ?></span>
						</div>
						<div class="tulsi-masthead-links">
							<?php if ( ! defined( 'TULSI_PREMIUM_VERSION' ) ) : ?>
								<a class="tulsi-masthead-links-bold" href="<?php echo esc_url(TULSI_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'tulsi' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(TULSI_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'tulsi' ); ?></a>
                            <a href="<?php echo esc_url(TULSI_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'tulsi' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * tulsi_dashboard_after_header hook.
				 *
				 */
				 do_action( 'tulsi_dashboard_after_header' );
				 ?>

				<div class="tulsi-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * tulsi_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'tulsi_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'tulsi-settings-group' ); ?>
									<?php do_settings_sections( 'tulsi-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="tulsi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'tulsi' )
										);
										?>
									</div>

									<?php
									/**
									 * tulsi_inside_options_form hook.
									 *
									 */
									 do_action( 'tulsi_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => TULSI_THEME_URL,
									),
									'Blog' => array(
											'url' => TULSI_THEME_URL,
									),
									'Colors' => array(
											'url' => TULSI_THEME_URL,
									),
									'Copyright' => array(
											'url' => TULSI_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => TULSI_THEME_URL,
									),
									'Demo Import' => array(
											'url' => TULSI_THEME_URL,
									),
									'Hooks' => array(
											'url' => TULSI_THEME_URL,
									),
									'Import / Export' => array(
											'url' => TULSI_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => TULSI_THEME_URL,
									),
									'Page Header' => array(
											'url' => TULSI_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => TULSI_THEME_URL,
									),
									'Spacing' => array(
											'url' => TULSI_THEME_URL,
									),
									'Typography' => array(
											'url' => TULSI_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => TULSI_THEME_URL,
									)
								);

								if ( ! defined( 'TULSI_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox tulsi-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'tulsi' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated tulsi-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'More info', 'tulsi' ); ?></a>
													</div>
												</div>
												<div class="tulsi-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * tulsi_options_items hook.
								 *
								 */
								do_action( 'tulsi_options_items' );
								?>
							</div>

							<div class="tulsi-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="tulsi_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'tulsi' )
									);
									?>
								</div>

								<?php
								/**
								 * tulsi_admin_right_panel hook.
								 *
								 */
								 do_action( 'tulsi_admin_right_panel' );

								  ?>
                                
                                <div class="wpkoi-doc">
                                	<h3><?php esc_html_e( 'Tulsi documentation', 'tulsi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You`ve stuck, the documentation may help on WPKoi.com', 'tulsi' ); ?></p>
                                    <a href="<?php echo esc_url(TULSI_DOCUMENTATION); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Tulsi documentation', 'tulsi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-social">
                                	<h3><?php esc_html_e( 'WPKoi on Facebook', 'tulsi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You want to get useful info about WordPress and the theme, follow WPKoi on Facebook.', 'tulsi' ); ?></p>
                                    <a href="<?php echo esc_url(TULSI_WPKOI_SOCIAL_URL); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Go to Facebook', 'tulsi' ); ?></a>
                                </div>
                                
                                <div class="wpkoi-review">
                                	<h3><?php esc_html_e( 'Help with You review', 'tulsi' ); ?></h3>
                                	<p><?php esc_html_e( 'If You like Tulsi theme, show it to the world with Your review. Your feedback helps a lot.', 'tulsi' ); ?></p>
                                    <a href="<?php echo esc_url(TULSI_WORDPRESS_REVIEW); ?>" class="wpkoi-admin-button" target="_blank"><?php esc_html_e( 'Add my review', 'tulsi' ); ?></a>
                                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'tulsi_admin_errors' ) ) {
	add_action( 'admin_notices', 'tulsi_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function tulsi_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_tulsi-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'tulsi-notices', 'true', esc_html__( 'Settings saved.', 'tulsi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'tulsi-notices', 'imported', esc_html__( 'Import successful.', 'tulsi' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'tulsi-notices', 'reset', esc_html__( 'Settings removed.', 'tulsi' ), 'updated' );
		}

		settings_errors( 'tulsi-notices' );
	}
}
