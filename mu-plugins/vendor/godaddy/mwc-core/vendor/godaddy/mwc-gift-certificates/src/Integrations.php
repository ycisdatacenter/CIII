<?php
/**
 * MWC Gift Certificates
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
 * Do not edit or add to this file if you wish to upgrade MWC Gift Certificates to newer
 * versions in the future. If you wish to customize MWC Gift Certificates for your
 * needs please refer to https://docs.woocommerce.com/document/woocommerce-pdf-product-vouchers/ for more information.
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2012-2024, SkyVerge, Inc. (info@skyverge.com)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

namespace GoDaddy\WordPress\MWC\GiftCertificates;

use GoDaddy\WordPress\MWC\GiftCertificates\Integrations\Elementor;
use GoDaddy\WordPress\MWC\GiftCertificates\Integrations\Paytrail;
use GoDaddy\WordPress\MWC\GiftCertificates\Integrations\UltimateMember;

defined( 'ABSPATH' ) or exit;

 /**
  * PDF Product Vouchers integrations class.
  *
  * @since 3.7.1
  */
class Integrations {


	/** @var Elementor instance */
	protected $elementor;

	/** @var Paytrail instance */
	protected $paytrail;

	/** @var UltimateMember instance */
	protected $ultimateMember;


	/**
	 * Constructor.
	 *
	 * @since 3.7.1
	 */
	public function __construct() {

		$plugin = wc_pdf_product_vouchers();

		$this->elementor = $plugin->load_class( '/src/Integrations/Elementor.php', Elementor::class );

		if ( $plugin->is_plugin_active( 'woocommerce-gateway-paytrail.php' ) ) {
			$this->paytrail = $plugin->load_class( '/src/Integrations/Paytrail.php', Paytrail::class );
		}

		if ( $plugin->is_plugin_active( 'ultimate-member.php' ) ) {
			$this->ultimateMember = $plugin->load_class( '/src/Integrations/UltimateMember.php', UltimateMember::class );
		}
	}


}
