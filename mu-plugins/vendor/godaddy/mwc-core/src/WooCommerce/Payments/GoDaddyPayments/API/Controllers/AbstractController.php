<?php

namespace GoDaddy\WordPress\MWC\Core\WooCommerce\Payments\GoDaddyPayments\API\Controllers;

use GoDaddy\WordPress\MWC\Common\API\Controllers\AbstractController as BaseAbstractController;

abstract class AbstractController extends BaseAbstractController
{
    protected $route = 'godaddy-payments';
}
