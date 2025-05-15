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

namespace GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Events;

use GoDaddy\WordPress\MWC\GoogleAnalytics\Tracking\Frontend_Handler;
use function GoDaddy\WordPress\MWC\GoogleAnalytics\wc_google_analytics_pro;

defined( 'ABSPATH' ) or exit;

/**
 * The base Universal Analytics Event class.
 *
 * @since 3.0.0
 */
abstract class Universal_Analytics_Event extends Event {


	/**
	 * Records the event via API.
	 *
	 * @since 3.0.0
	 *
	 * @param array $properties
	 * @param array $ec
	 * @param array|null $identities
	 * @param bool $admin_event
	 * @return bool
	 */
	protected function record_via_api(array $properties = [], array $ec = [], ?array $identities = null, bool $admin_event = false ): bool {

		return wc_google_analytics_pro()->get_tracking_instance()->get_event_tracking_instance()->api_record_event(
			$this->get_name(),
			$properties,
			$ec,
			$identities,
			$admin_event,
		);
	}


	/**
	 * Gets the frontend handler instance.
	 *
	 * @since 3.0.0
	 *
	 * @return Frontend_Handler
	 */
	protected function get_frontend_handler_instance() : Frontend_Handler {
		return wc_google_analytics_pro()->get_tracking_instance()->get_frontend_handler_instance();
	}


}
