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

namespace GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Adapters;

use Automattic\WooCommerce\Utilities\NumberUtil;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Helpers\Product_Helper;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking;
use WC_Cart;
use WC_Product;

defined( 'ABSPATH' ) or exit;

/**
 * The Cart Event Data Adapter class.
 *
 * @since 3.0.0
 */
class Cart_Event_Data_Adapter extends Event_Data_Adapter {


	/** @var WC_Cart the source cart */
	protected WC_Cart $cart;


	/**
	 * Constructor.
	 *
	 * @since 3.0.0
	 *
	 * @param WC_Cart $cart the cart instance
	 */
	public function __construct( WC_Cart $cart ) {

		$this->cart = $cart;
	}


	/**
	 * Converts the source into an array.
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */
	public function convert_from_source() : array {

		return [
			'currency' => get_woocommerce_currency(),
			'value'    => $this->get_cart_value(),
			'coupon'   => implode( ',', $this->cart->get_applied_coupons() ),
			'shipping' => NumberUtil::round( $this->cart->get_shipping_total(), wc_get_price_decimals() ),
			'tax'      => NumberUtil::round( $this->cart->get_total_tax(), wc_get_price_decimals() ),
			'items'    => array_values( array_map( static function( $item ) {

				return ( new Cart_Item_Event_Data_Adapter( $item ) )->convert_from_source();

			}, $this->cart->get_cart() ) ),
		];
	}


	/**
	 * Gets the cart value, either with or without tax and shipping.
	 *
	 * @since 3.0.5
	 *
	 * @return float
	 */
	protected function get_cart_value() : float {

		$cart_value = Tracking::revenue_should_include_tax_and_shipping()
			? $this->cart->get_cart_total()
			: $this->cart->get_cart_contents_total();

		return abs( NumberUtil::round( $cart_value, wc_get_price_decimals() ) );
	}


}
