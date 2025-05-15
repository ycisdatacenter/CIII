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

namespace GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Events\Universal_Analytics;

use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Events\Universal_Analytics_Event;

defined( 'ABSPATH' ) or exit;

/**
 * The "viewed product" event.
 *
 * @since 3.0.0
 */
class Viewed_Product_Event extends Universal_Analytics_Event {


	/** @var string the event ID */
	public const ID = 'viewed_product';


	/**
	 * @inheritdoc
	 */
	public function get_form_field_title(): string {

		return __( 'Viewed Product', 'woocommerce-google-analytics-pro' );
	}


	/**
	 * @inheritdoc
	 */
	public function get_form_field_description(): string {

		return __( 'Triggered when a customer views a single product.', 'woocommerce-google-analytics-pro' );
	}


	/**
	 * @inheritdoc
	 */
	public function get_default_name(): string {

		return 'viewed product';
	}


	/**
	 * @inheritdoc
	 */
	public function register_hooks() : void {

		add_action( 'woocommerce_after_single_product_summary', [ $this, 'track' ], 1 );
	}


	/**
	 * @inheritdoc
	 */
	public function track() : void {

		// bail if tracking is disabled
		if ( Tracking::do_not_track() ) {
			return;
		}

		if ( Tracking::not_page_reload() ) {

			// add Enhanced Ecommerce tracking
			$product_id = get_the_ID();

			$frontend = $this->get_frontend_handler_instance();

			// JS add product
			$js = $frontend->get_ec_add_product_js( $product_id );

			// JS add action
			$js .= $frontend->get_ec_action_js( 'detail' );

			// enqueue JS
			$frontend->enqueue_js( 'event', $js );

			// set event properties - EC data will be sent with the event
			$properties = [
				'eventCategory'  => 'Products',
				'eventLabel'     => esc_js( get_the_title() ),
				'nonInteraction' => true,
			];

			$frontend->js_record_event( $this->get_name(), $properties );
		}
	}


}
