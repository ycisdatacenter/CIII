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

namespace GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Events\GA4;

use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking;
use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Events\GA4_Event;

defined( 'ABSPATH' ) or exit;

/**
 * The "view signup" event.
 *
 * @since 3.0.0
 */
class View_Sign_Up_Event extends GA4_Event {


	/** @var string the event ID */
	public const ID = 'view_sign_up';


	/**
	 * @inheritdoc
	 */
	public function get_form_field_title(): string {

		return __( 'View Sign Up', 'woocommerce-google-analytics-pro' );
	}


	/**
	 * @inheritdoc
	 */
	public function get_form_field_description(): string {

		return __( 'Triggered when a customer views the registration form.', 'woocommerce-google-analytics-pro' );
	}


	/**
	 * @inheritdoc
	 */
	public function get_default_name(): string {

		return 'view_sign_up';
	}


	/**
	 * @inheritdoc
	 */
	public function register_hooks() : void {

		add_action( 'register_form', [ $this, 'track' ] );
		add_action( 'woocommerce_register_form', [ $this, 'track' ] );
	}


	/**
	 * @inheritdoc
	 */
	public function track(): void {

		if ( Tracking::not_page_reload() ) {

			$this->record_via_js( [ 'category' => 'My Account'] );
		}
	}


}
