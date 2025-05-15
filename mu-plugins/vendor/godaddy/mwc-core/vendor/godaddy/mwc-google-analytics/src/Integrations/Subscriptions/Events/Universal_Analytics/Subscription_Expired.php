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

namespace GoDaddy\WordPress\MWC\GoogleAnalytics\Integrations\Subscriptions\Events\Universal_Analytics;

use GoDaddy\WordPress\MWC\GoogleAnalytics\Integrations\Subscriptions\Events\Contracts\Subscription_Event;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Integrations\Subscriptions\Events\Traits\Tracks_Subscription_Events;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Events\Universal_Analytics_Event;

defined( 'ABSPATH' ) or exit;

/**
 * The "subscription expired" event.
 *
 * @since 3.0.0
 */
class Subscription_Expired extends Universal_Analytics_Event implements Subscription_Event {

	use Tracks_Subscription_Events;


	/** @var string the event ID */
	public const ID = 'subscription_expired';

	/** @var string the event trigger action hook  */
	protected string $trigger_hook = 'woocommerce_scheduled_subscription_expiration';


	/**
	 * @inheritdoc
	 */
	public function get_form_field_title(): string {

		return __( 'Subscription Expired', 'woocommerce-google-analytics-pro' );
	}


	/**
	 * @inheritdoc
	 */
	public function get_form_field_description(): string {

		return __( 'Triggered when a subscription expires.', 'woocommerce-google-analytics-pro' );
	}


	/**
	 * @inheritdoc
	 */
	public function get_default_name(): string {

		return 'subscription expired';
	}


	/**
	 * @inheritdoc
	 *
	 * @param int|string $subscription_id
	 */
	public function track( $subscription_id = null ): void {

		$this->track_subscription_event_in_ua( wcs_get_subscription( $subscription_id ) );
	}


}
