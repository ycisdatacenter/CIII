<?php
/**
 * Google Analytics
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Google Analytics to newer
 * versions in the future. If you wish to customize Google Analytics for your
 * needs please refer to https://help.godaddy.com/help/40882 for more information.
 *
 * @author      SkyVerge
 * @copyright   Copyright (c) 2015-2024, SkyVerge, Inc.
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

namespace GoDaddy\WordPress\MWC\GoogleAnalytics\API;

use SkyVerge\WooCommerce\PluginFramework\v5_12_1 as Framework;
use function GoDaddy\WordPress\MWC\GoogleAnalytics\wc_google_analytics_pro;

defined( 'ABSPATH' ) or exit;

/**
 * Google APIs Auth handler.
 *
 * This class functions as a lightweight auth handler that authenticates the plugin with Google APIs via the
 * authentication proxy service.
 *
 * @since 3.0.0
 */
class Auth {


	/** @var string HOST for the Google Analytics Pro Authentication proxy */
	protected const PROXY_HOST = 'https://wc-ga-pro-proxy.com';

	/** @var string read-only scope for Google Analytics APIs */
	public const SCOPE_ANALYTICS_READONLY = 'https://www.googleapis.com/auth/analytics.readonly';

	/** @var string edit scope for Google Analytics APIs */
	public const SCOPE_ANALYTICS_EDIT = 'https://www.googleapis.com/auth/analytics.edit';

	/** @var array|null the current token */
	protected ?array $token = null;


	/**
	 * Auth class constructor
	 *
	 * @since 3.0.0
	 */
	public function __construct() {

		$this->token = $this->parse_json_token();

		// handle Google Client API callbacks
		add_action( 'woocommerce_api_wc-google-analytics-pro/auth', [$this, 'authenticate'] );
	}


	/**
	 * Parses the raw JSON token into an associative array.
	 *
	 * @since 3.0.0
	 *
	 * @return array<string, mixed>|null
	 */
	protected function parse_json_token(): ?array {

		$token = $this->get_access_token_json();

		return $token ? json_decode( $token, true ) : null;
	}


	/**
	 * Gets the raw access token JSON
	 *
	 * @since 3.0.0
	 *
	 * @return string|null
	 */
	protected function get_access_token_json(): ?string {

		return get_option( 'wc_google_analytics_pro_access_token', null );
	}


	/**
	 * Gets the refresh token.
	 *
	 * @since 3.0.0
	 *
	 * @return string|null
	 */
	protected function get_refresh_token(): ?string {

		return $this->token['refresh_token'] ?? null;
	}


	/**
	 * Gets the access token value.
	 *
	 * @since 3.0.0
	 *
	 * @return string
	 */
	public function get_access_token(): string {

		return $this->token['access_token'] ?? '';
	}


	/**
	 * Gets either the current or a fresh access token if the current one is expired.
	 *
	 * @since 3.0.0
	 *
	 * @return string
	 */
	public function get_fresh_access_token() : string {

		// refresh token if it's expired
		if ( $this->token && $this->is_access_token_expired() ) {

			try {

				$this->refresh_access_token();

			} catch ( Framework\SV_WC_API_Exception $e ) {

				// we can't access the integration instance directly to get the debug mode value as it may cause circular reference loops
				if ( 'no' !== get_option( 'woocommerce_google_analytics_pro_settings', [] )['debug_mode'] ?? 'no' ) {
					wc_google_analytics_pro()->log( $e->getMessage() );
				}

				return '';
			}
		}

		return $this->token['access_token'] ?? '';
	}


	/**
	 * Determines if the current access token is expired.
	 *
	 * @since 3.0.0
	 *
	 * @return bool
	 */
	public function is_access_token_expired() : bool {

		if ( ! $this->token ) {
			return true;
		}

		// if the token does not have an "expires_in", then it's considered expired
		if ( ! isset( $this->token['expires_in'] ) ) {
			return true;
		}

		$created = $this->token['created'] ?? 0;

		// if the token is set to expire in the next 30 seconds, consider it expired
		return ( $created + ( $this->token['expires_in'] - 30 ) ) < current_time( 'timestamp', true );
	}


	/**
	 * Refreshes the access token.
	 *
	 * @since 3.0.0
	 *
	 * @throws Framework\SV_WC_API_Exception
	 */
	protected function refresh_access_token(): void {

		if ( ! $this->get_refresh_token() ) {
			throw new Framework\SV_WC_API_Exception( 'Could not refresh access token: refresh token not available.' );
		}

		$refresh_url = $this->get_access_token_refresh_url();
		$response    = wp_remote_get( $refresh_url, ['timeout' => MINUTE_IN_SECONDS] );

		// bail out if the request failed
		if ( $response instanceof \WP_Error ) {
			throw new Framework\SV_WC_API_Exception( sprintf( 'Could not refresh access token: %s', json_encode( $response->errors ) ) );
		}

		// bail out if the response was empty
		if ( ! $response || empty( $response['body'] ) ) {
			throw new Framework\SV_WC_API_Exception( 'Could not refresh access token: response was empty.' );
		}

		// bail out if the Google Analytics proxy produced a 500 server error
		if ( isset( $response['response']['code'] ) && 500 === (int) $response['response']['code'] ) {
			throw new Framework\SV_WC_API_Exception( 'Could not refresh access token: a server error occurred.' );
		}

		// try to decode the token
		$json_token = base64_decode( $response['body'] );

		// bail out if the token was invalid
		if ( ! $json_token || ! ( $this->token = json_decode( $json_token, true ) ) ) {
			throw new Framework\SV_WC_API_Exception( 'Could not refresh access token: returned token was invalid.' );
		}

		// we're good: update the access token
		$updated = update_option( 'wc_google_analytics_pro_access_token', $json_token );

		// there's a rare possibility we could not store the token
		if ( ! $updated ) {
			throw new Framework\SV_WC_API_Exception( 'Could not refresh access token: a database error occurred.' );
		}
	}


	/**
	 * Authenticates with Google API.
	 *
	 * @internal
	 *
	 * @since 3.0.0
	 */
	public function authenticate(): void {

		// missing token
		if ( ! isset( $_REQUEST['token'] ) || ! $_REQUEST['token'] ) {
			return;
		}

		$json_token = base64_decode( $_REQUEST['token'] );
		$token      = $json_token ? json_decode( $json_token, true ) : null;

		// invalid token
		if ( ! $token ) {
			return;
		}

		// update access token
		update_option( 'wc_google_analytics_pro_access_token', $json_token );
		update_option( 'wc_google_analytics_pro_account_id', md5( $json_token ) );

		$this->token = $this->parse_json_token();

		// if we can't fetch the existing property, it probably means the authenticated user does not have access to it,
		// so we need to clear the account related settings
		if ( $ga4_property = wc_google_analytics_pro()->get_properties_handler_instance()->get_ga_property_id() ) {
			try {
				wc_google_analytics_pro()->get_api_client_instance()->get_admin_api()->get_property( $ga4_property );
			} catch ( Framework\SV_WC_API_Exception $e ) {
				// clear everything except account ID and token (as we've already overwritten these)
				$this->clear_account_related_settings( false );
			}
		}

		echo '<script>window.opener.wc_google_analytics_pro.auth_callback(' . $json_token . ')</script>';
		exit();
	}


	/**
	 * Get the Authorization Proxy Service Host.
	 *
	 * @since 2.0.7
	 *
	 * @return string proxy host
	 */
	protected function get_proxy_host() : string {

		/**
		 * Filters the host for the OAuth proxy app.
		 *
		 * @since 3.0.7
		 *
		 * @param string $proxy_host defaults to Auth::PROXY_HOST
		 */
		return (string) apply_filters( 'wc_google_analytics_pro_proxy_host', static::PROXY_HOST );
	}


	/**
	 * Gets the full proxy app URL.
	 *
	 * @since 2.0.0
	 *
	 * @param string $endpoint
	 * @param array<string, mixed> $params
	 * @return string
	 */
	protected function get_proxy_app_url( string $endpoint = '', array $params = [] ) : string {

		return add_query_arg( array_merge( $params, [ 'context' => 'mwc' ] ), $this->get_proxy_host() . '/' . $endpoint );
	}


	/**
	 * Gets the Google API authentication URL.
	 *
	 * @since 3.0.0
	 *
	 * @return string the Google Client API authentication URL
	 */
	public function get_auth_url(): string {

		return $this->get_proxy_app_url( 'auth/google', [ 'callback' => urlencode( $this->get_callback_url() ) ] );
	}


	/**
	 * Gets the Google API refresh access token URL, if a refresh token is available.
	 *
	 * @since 3.0.0
	 *
	 * @return string|null
	 */
	private function get_access_token_refresh_url(): ?string {

		$refresh_url = null;

		if ( $refresh_token = $this->get_refresh_token() ) {
			$refresh_url = $this->get_proxy_app_url( 'auth/google/refresh', [ 'token' => base64_encode( $refresh_token ) ] );
		}

		return $refresh_url;
	}


	/**
	 * Revokes our access to the Google API.
	 *
	 * @since 3.0.0
	 *
	 * @return void
	 */
	public function revoke_access(): void {

		$response = wp_safe_remote_get( $this->get_access_token_revoke_url() );

		// log errors
		if ( is_wp_error( $response ) ) {

			wc_google_analytics_pro()->log( sprintf( 'Could not revoke access token: %s', json_encode( $response->errors ) ) );
		}

		$this->clear_account_related_settings();
	}


	/**
	 * Clear settings, options & cached values related to the authenticated account.
	 *
	 * @since 3.0.0
	 *
	 * @param bool $clear_token_and_id whether to clear the access token and account ID
	 * @return void
	 */
	private function clear_account_related_settings( bool $clear_token_and_id = true ) : void {

		$settings = get_option( 'woocommerce_google_analytics_pro_settings', [] );

		unset(
			$settings['property'],
			$settings['tracking_id'],
			$settings['ga4_property'],
			$settings['measurement_id']
		);

		update_option( 'woocommerce_google_analytics_pro_settings', $settings );

		delete_option( 'wc_google_analytics_pro_ga4_data_streams' );
		delete_option( 'wc_google_analytics_pro_ga4_data_stream_api_secrets' );
		delete_option( 'wc_google_analytics_pro_mp_api_secret' );
		delete_transient( 'wc_google_analytics_pro_properties' );
		delete_transient( 'wc_google_analytics_pro_ga4_properties' );

		if ( $clear_token_and_id ) {
			delete_option( 'wc_google_analytics_pro_access_token' );
			delete_option( 'wc_google_analytics_pro_account_id' );
		}
	}


	/**
	 * Gets the Google API revoke access token URL, if a token is available.
	 *
	 * @since 3.0.0
	 *
	 * @return string|null
	 */
	private function get_access_token_revoke_url(): ?string {

		$revoke_url = null;

		if ( $token = $this->get_access_token() ) {
			$revoke_url = $this->get_proxy_app_url( 'auth/google/revoke', [ 'token' => base64_encode( $token ) ] );
		}

		return $revoke_url;
	}


	/**
	 * Gets the Google API callback URL.
	 *
	 * @since 3.0.0
	 *
	 * @return string url
	 */
	public function get_callback_url(): string {

		return WC()->api_request_url( 'wc-google-analytics-pro/auth' );
	}


	/**
	 * Gets the API secret for Measurement Protocol for GA4.
	 *
	 * @since 3.0.0
	 *
	 * @return string|null the measurement ID
	 */
	public function get_mp_api_secret() : ?string {

		return get_option( 'wc_google_analytics_pro_mp_api_secret', null );
	}


	/**
	 * Gets the permission scopes the current access token has for the Google Analytics API.
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */
	public function get_scopes() : array {

		return explode( ' ', $this->token['scope'] ?? '' );
	}


}
