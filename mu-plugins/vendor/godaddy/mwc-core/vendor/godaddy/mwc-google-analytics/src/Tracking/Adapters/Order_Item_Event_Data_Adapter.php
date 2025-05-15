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
use GoDaddy\WordPress\MWC\GoogleAnalytics\Helpers\Order_Helper;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Helpers\Product_Helper;
use WC_Abstract_Order;
use WC_Order_Item;

defined( 'ABSPATH' ) or exit;

/**
 * The Order Item Event Data Adapter class.
 *
 * @since 3.0.0
 */
class Order_Item_Event_Data_Adapter extends Event_Data_Adapter {


	/** @var WC_Abstract_Order the source order or refund */
	protected WC_Abstract_Order $order;

	/** @var WC_Order_Item the source order item */
	protected WC_Order_Item $item;


	/**
	 * Constructor.
	 *
	 * @since 3.0.0
	 *
	 * @param WC_Abstract_Order $order order or refund
	 * @param WC_Order_Item $item
	 */
	public function __construct( WC_Abstract_Order $order, WC_Order_Item $item ) {

		$this->order = $order;
		$this->item  = $item;
	}


	/**
	 * Converts the source into an array.
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */
	public function convert_from_source() : array {

		$product = wc_get_product( $this->item['variation_id'] ?: $this->item['product_id'] );

		$data = [
			'item_id'      => Product_Helper::get_product_identifier( $product ),
			'item_name'    => $this->item['name'],
			'item_variant' => Order_Helper::get_order_item_variant( $this->item ),
			'price'        => abs( NumberUtil::round( $this->order->get_item_subtotal( $this->item ), wc_get_price_decimals() ) ),
			'discount'     => abs( NumberUtil::round( $this->order->get_item_subtotal( $this->item ) - $this->order->get_item_total( $this->item ), wc_get_price_decimals() ) ),
			'quantity'     => abs( $this->item['qty'] ),
		];

		$index = '';

		/** @link https://developers.google.com/analytics/devguides/collection/protocol/ga4/reference/events#purchase_item */
		foreach ( Product_Helper::get_hierarchical_categories( $product ) as $category ) {

			$data[ 'item_category' . $index ] = $category->name;

			$index ? $index++ : $index = 2; // index only appended starting from 2nd category

			// GA supports up to 5 categories
			if ( $index > 5 ) {
				break;
			}
		}

		return $data;
	}


}
