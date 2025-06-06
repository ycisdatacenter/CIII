<?php

namespace GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\WooCommerce\Admin;

use Exception;
use GoDaddy\WordPress\MWC\Common\Admin\Notices\Notice;
use GoDaddy\WordPress\MWC\Common\Admin\Notices\Notices;
use GoDaddy\WordPress\MWC\Common\Components\Contracts\ComponentContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\BaseException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Platforms\Exceptions\PlatformRepositoryException;
use GoDaddy\WordPress\MWC\Common\Platforms\PlatformRepositoryFactory;
use GoDaddy\WordPress\MWC\Common\Register\Register;
use GoDaddy\WordPress\MWC\Common\Traits\CanGetNewInstanceTrait;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\DataSources\WooCommerce\EmailNotificationAdapter;
use GoDaddy\WordPress\MWC\Core\Features\EmailNotifications\EmailsPage;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Views\Components\GoDaddyBranding;
use GoDaddy\WordPress\MWC\Dashboard\Menu\GetHelpMenu;
use WC_Email;

/**
 * Email Settings handler.
 */
class EmailSettings implements ComponentContract
{
    use CanGetNewInstanceTrait;

    /** @var string redirect notice ID */
    const NOTICE_REDIRECT = 'mwc-email-notifications-redirect';

    /** @var string[] */
    protected $standardSettingsIds = [
        'email_notification_settings',
        'email_recipient_options',
        'woocommerce_email_from_name',
        'woocommerce_email_from_address',
        'email_options',
        'woocommerce_email_header_image',
        'woocommerce_email_footer_text',
        'woocommerce_email_footer_text_color',
        'woocommerce_email_base_color',
        'woocommerce_email_background_color',
        'woocommerce_email_body_background_color',
        'woocommerce_email_text_color',
        'email_template_options',
        'email_merchant_notes',
        'woocommerce_merchant_email_notifications',
    ];

    /**
     * Loads the component.
     *
     * @throws Exception
     */
    public function load()
    {
        $this->registerHooks();

        $this->renderRedirectNotice();
    }

    /**
     * @throws Exception
     */
    protected function registerHooks()
    {
        Register::filter()
            ->setGroup('woocommerce_email_settings')
            ->setHandler([$this, 'deregisterStandardSettings'])
            ->setPriority(PHP_INT_MAX)
            ->execute();

        Register::action()
            ->setGroup('woocommerce_email_settings_before')
            ->setHandler([$this, 'enqueueBackLinkJS'])
            ->execute();
    }

    /**
     * Enqueues JS to replace back link URL.
     *
     * @param WC_Email $wcEmail
     */
    public function enqueueBackLinkJS($wcEmail)
    {
        if (! $wcEmail instanceof WC_Email) {
            return;
        }

        $backLinkUrl = $this->getBackLinkUrl($wcEmail);

        wc_enqueue_js("jQuery('h2:first-of-type').find('.wc-admin-breadcrumb a').attr('href', '{$backLinkUrl}');");
    }

    /**
     * Gets the back link URL for the WooCommerce email.
     *
     * @param WC_Email $wcEmail
     * @return string
     */
    protected function getBackLinkUrl(WC_Email $wcEmail) : string
    {
        try {
            $categories = EmailNotificationAdapter::from($wcEmail)->convertFromSource()->getCategories();
        } catch (BaseException $exception) {
            $categories = [];
        }

        return add_query_arg([
            'tab'      => 'emails',
            'category' => $categories ? reset($categories) : '',
        ], admin_url('admin.php?page='.EmailsPage::SLUG));
    }

    /**
     * Renders a notice with button redirecting to Marketing > Emails.
     *
     * @internal
     * @throws Exception
     */
    public function renderRedirectNotice()
    {
        ob_start(); ?>
        <p><?php esc_html_e('Customize your emails to reflect your brand and increase customer loyalty. Manage them from Marketing > Emails.', 'mwc-core'); ?></p>
        <p><a href="<?php echo esc_url(admin_url('admin.php?page='.EmailsPage::SLUG)); ?>" class="button button-primary"><?php esc_html_e('Manage emails', 'mwc-core'); ?></a></p>

        <?php $this->maybeRenderGoDaddyBranding(); ?>
        <?php

        $content = ob_get_clean();

        $notice = (new Notice())
            ->setId(static::NOTICE_REDIRECT)
            ->setType(Notice::TYPE_SUCCESS)
            ->setDismissible(false)
            ->setTitle(esc_html__('Your hosting plan now offers editable WooCommerce emails, no plugin required!', 'mwc-core'))
            ->setContent(TypeHelper::ensureString($content))
            ->setRenderCondition([$this, 'isWooCommerceEmailSettingsPage']);

        Notices::enqueueAdminNotice($notice);
    }

    /**
     * May render GoDaddy branding for non-reseller customers.
     *
     * @throws PlatformRepositoryException
     */
    protected function maybeRenderGoDaddyBranding()
    {
        // bail if customer is a reseller type
        if (PlatformRepositoryFactory::getNewInstance()->getPlatformRepository()->isReseller()) {
            return;
        }

        ob_start(); ?>
        <style>
            .notice[data-message-id="<?php echo esc_attr(static::NOTICE_REDIRECT); ?>"] .mwc-gd-branding {
                margin-top: 1rem;
            }
        </style>
        <?php

        (new GoDaddyBranding())->addStyle(ob_get_clean())->render();
    }

    /**
     * De-registers WooCommerce email standard settings.
     *
     * @internal
     *
     * @param $settings
     * @return array
     */
    public function deregisterStandardSettings($settings) : array
    {
        $standardSettingsIds = $this->standardSettingsIds;

        $settings = ArrayHelper::where((array) $settings, function ($setting) use ($standardSettingsIds) {
            if ('email_notification' === ArrayHelper::get($setting, 'type')) {
                return false;
            }

            return ! in_array(ArrayHelper::get($setting, 'id'), $standardSettingsIds, true);
        }, false);

        $this->mayHideSaveSettingsButton($settings);
        $this->maybeAddThirdPartyPluginsNotice($settings);

        return $settings;
    }

    /**
     * May add CSS to hide the save settings button.
     *
     * @param array $settings
     */
    protected function mayHideSaveSettingsButton(array $settings)
    {
        // bail is current page is not WC Emails settings page or has custom settings
        if ($this->hasCustomSettings($settings) || ! $this->isWooCommerceEmailSettingsPage()) {
            return;
        } ?>
        <style>
            button.button-primary.woocommerce-save-button {
                display: none;
            }
        </style>
        <?php
    }

    /**
     * Checks if settings has any custom ones.
     *
     * @param array $settings
     * @return bool
     */
    protected function hasCustomSettings(array $settings) : bool
    {
        return ! empty($settings);
    }

    /**
     * Checks if the current page is WooCommerce > Settings > Emails page.
     *
     * @internal
     *
     * @return bool
     */
    public function isWooCommerceEmailSettingsPage() : bool
    {
        return 'wc-settings' === ArrayHelper::get($_GET, 'page') &&
            'email' === ArrayHelper::get($_GET, 'tab');
    }

    /**
     * Adds a notice if a 3rd party added custom settings.
     *
     * @param array $settings
     */
    protected function maybeAddThirdPartyPluginsNotice(array $settings)
    {
        if ($this->hasCustomSettings($settings)) {
            $this->renderThirdPartyPluginsNotice();
        }
    }

    /**
     * Renders 3rd party plugins notice.
     */
    public function renderThirdPartyPluginsNotice()
    {
        ob_start(); ?>
        <p><?php esc_html_e('Please use either your hosting plan\'s email editing feature or your 3rd-party email editor.', 'mwc-core'); ?></p>
        <p>
            <a href="<?php echo esc_url(admin_url('admin.php?page='.EmailsPage::SLUG)); ?>" class="button button-primary"><?php esc_html_e('Edit emails', 'mwc-core'); ?></a>&nbsp;<a href="<?php echo esc_url(admin_url('admin.php?page='.GetHelpMenu::MENU_SLUG)); ?>" class="button"><?php esc_html_e('Contact support', 'mwc-core'); ?></a>
        </p>
        <?php

        $content = ob_get_clean();

        $notice = (new Notice())
            ->setId('mwc-email-notifications-3rd-party-plugins-detected')
            ->setType(Notice::TYPE_INFO)
            ->setDismissible(true)
            ->setTitle(esc_html__('A 3rd-party email editing plugin has been detected on your store.', 'mwc-core'))
            ->setContent(TypeHelper::ensureString($content));

        Notices::enqueueAdminNotice($notice);
    }
}
