<?php
/**
 * Plugin Name: WPEX Expert Banner
 * Plugin URI: https://godaddy.com/
 * Description: WPEX WordPress plugin for Expert Banner. Provides a link to expert services in the header of the editor screen. Intended to be used as a sub-plugin of System Plugin.
 * Version: 1.1.2
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Author: GoDaddy
 * Author URI: https://godaddy.com
 * Text Domain: expert-banner
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <http://www.gnu.org/licenses/>.
 *
 * @package Expert_Banner
 */

defined('ABSPATH') || exit;

// We only enqueue the scripts for GD not resellers.
if ( defined( 'GD_RESELLER' ) && GD_RESELLER > 1 ) {
	return;
}

define('WPEX_EB_OPTION_HIDDEN', 'wpex_eb_hidden');

/**
 * Enqueue styles to handle expert banner styles.
 *
 * @action admin_enqueue_scripts
 *
 * @param string $hook
 */
function wpex_eb_enqueue_scripts() {

	global $pagenow;
	// Ensure Expert Banner only loads if within the post editor.
	if (
		! isset( $pagenow ) || strpos( $pagenow, 'post-new.php' ) === false 
	) {
		return;
	}

	wp_enqueue_style(
		'wpex-expert-banner',
		plugins_url("build/index.css", __FILE__),
		[],
		'1.0.0'
	);

	wp_enqueue_script(
		'wpex-expert-banner',
		plugins_url("build/index.js", __FILE__),
		[],
		'1.0.0',
		true,
	);

	wp_localize_script(
		'wpex-expert-banner',
		'wpexExpertBanner',
		[
			'optionHidden' => WPEX_EB_OPTION_HIDDEN
		],
		'1.0.0',
		true,
	);
}

add_action( 'admin_enqueue_scripts', 'wpex_eb_enqueue_scripts' );


/**
 * Register the settings to hide the expert banner.
 *
 * @action admin_enqueue_scripts
 *
 * @param string $hook
 */
function wpex_eb_register_settings() {

	register_setting(
		WPEX_EB_OPTION_HIDDEN,
		WPEX_EB_OPTION_HIDDEN,
		[
			'show_in_rest' => true,
			'default'      => false,
			'type'         => 'boolean',
		]
	);

}

add_action( 'rest_api_init', 'wpex_eb_register_settings' );

/**
 * "Hire a WordPress Expert" Admin bar menu.
 *
 * @action admin_bar_menu
 *
 * @param WP_Admin_Bar $admin_bar
 */
function wpex_eb_hire_expert_admin_bar( WP_Admin_Bar $admin_bar ) {

	$enabled_locales = [
		'en_AU',
		'en_CA',
		'en_GB', // en_UK
		'en_US',
	];

	if ( ! defined( 'GD_ACCOUNT_UID' ) || ! is_admin() || ! current_user_can( 'administrator' ) || ! in_array( get_locale(), $enabled_locales, true ) ) {

		return;

	}

	?>
	<script type="text/javascript">
	document.addEventListener( 'DOMContentLoaded', function() {
		const hireExpertParent = document.getElementById( 'wp-admin-bar-hire-expert' );
		if ( hireExpertParent ) {
			const hireExpertLink = hireExpertParent.querySelector( '.ab-item' );
			if ( hireExpertLink ) {
				hireExpertLink.setAttribute( 'data-eid', 'usi.dify.leadgenplacement.click' );
			}
		}
	} );
	</script>
	<?php

	$hire_an_expert_url = sprintf(
		'https://searchenginevisibility.godaddy.com/v2/requestACall?account_uid=%1$s&redirectURL=https://dashboard.godaddy.com/account/%1$s&origin=%2$s&form=fullPage-nav',
		GD_ACCOUNT_UID,
		( isset( $_GET['page'] ) && 'wp-dashboard' === $_GET['page'] ) ? 'WPAdmin_Dashboard_TopNavigation' : 'WPAdmin_TopNavigation'
	);

	$admin_bar->add_menu(
		[
			'id'    => 'hire-expert',
			'title' => __( 'Hire a WordPress Expert', 'gd-system-plugin' ),
			'href'  => esc_url( $hire_an_expert_url ),
			'meta'  => [
				'target'  => '_blank',
			],
		]
	);

}

add_action( 'admin_bar_menu', 'wpex_eb_hire_expert_admin_bar', PHP_INT_MAX );
