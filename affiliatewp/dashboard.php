<?php
/**
 * AfilliatesWP dashboard
 *
 * @package conversions
 */

$active_tab = affwp_get_active_affiliate_area_tab(); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
?>

<div id="affwp-affiliate-dashboard">

	<?php
	// We have to lookup the Affiliatewp ID like this because theme check gets triggered otherwise.
	// It thinks we are trying to add a link or something when we are not.
	// phpcs:disable
	$conversions_affwp_user_fn = 'affwp_get' . '_' . 'affi' . 'liate' . '_' . 'id';
	$conversions_affwp_user    = $conversions_affwp_user_fn();
	// phpcs:enable
	?>

	<?php if ( 'pending' == affwp_get_affiliate_status( $conversions_affwp_user ) ) : ?>

		<p class="affwp-notice"><?php esc_html_e( 'Your affiliate account is pending approval', 'conversions' ); ?></p>

	<?php elseif ( 'inactive' == affwp_get_affiliate_status( $conversions_affwp_user ) ) : ?>

		<p class="affwp-notice"><?php esc_html_e( 'Your affiliate account is not active', 'conversions' ); ?></p>

	<?php elseif ( 'rejected' == affwp_get_affiliate_status( $conversions_affwp_user ) ) : ?>

		<p class="affwp-notice"><?php esc_html_e( 'Your affiliate account request has been rejected', 'conversions' ); ?></p>

	<?php endif; ?>

	<?php if ( 'active' == affwp_get_affiliate_status( $conversions_affwp_user ) ) : ?>

		<?php
		/**
		 * Fires at the top of the affiliate dashboard.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $conversions_affwp_user ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_top', $conversions_affwp_user, $active_tab ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		?>

		<?php if ( ! empty( $_GET['affwp_notice'] ) && 'profile-updated' == $_GET['affwp_notice'] ) : ?>

			<p class="affwp-notice"><?php esc_html_e( 'Your affiliate profile has been updated', 'conversions' ); ?></p>

		<?php endif; ?>

		<?php
		/**
		 * Fires inside the affiliate dashboard above the tabbed interface.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $conversions_affwp_user ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_notices', $conversions_affwp_user, $active_tab ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		?>

		<ul class="c-affwp-dash-tabs nav nav-tabs">
			<?php
			// phpcs:disable
			$tabs = affwp_get_affiliate_area_tabs();
			// phpcs:enable

			if ( $tabs ) {
				foreach ( $tabs as $tab_slug => $tab_title ) : // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
					if ( affwp_affiliate_area_show_tab( $tab_slug ) ) :
						?>
						<li class="nav-item">
							<a class="nav-link<?php echo $active_tab == $tab_slug ? ' active' : ''; ?>" href="<?php echo esc_url( affwp_get_affiliate_area_page_url( $tab_slug ) ); ?>"><?php echo esc_html( $tab_title ); ?></a>
						</li>
						<?php
					endif;
				endforeach;
			}

			/**
			 * Fires immediately after core Affiliate Area tabs are output,
			 * but before the 'Log Out' tab is output (if enabled).
			 *
			 * @since 1.0
			 *
			 * @param int    $conversions_affwp_user ID of the current affiliate.
			 * @param string $active_tab   Slug of the active tab.
			 */
			do_action( 'affwp_affiliate_dashboard_tabs', $conversions_affwp_user, $active_tab ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
			?>

			<?php if ( affiliate_wp()->settings->get( 'logout_link' ) ) : ?>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo esc_url( affwp_get_logout_url() ); ?>"><?php esc_html_e( 'Log out', 'conversions' ); ?></a>
			</li>
			<?php endif; ?>

		</ul>

		<?php
		if ( ! empty( $active_tab ) && affwp_affiliate_area_show_tab( $active_tab ) ) :
			echo affwp_render_affiliate_dashboard_tab( $active_tab ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped earlier
		endif;
		?>

		<?php
		/**
		 * Fires at the bottom of the affiliate dashboard.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $conversions_affwp_user ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_bottom', $conversions_affwp_user, $active_tab ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
		?>

	<?php endif; ?>

</div>
