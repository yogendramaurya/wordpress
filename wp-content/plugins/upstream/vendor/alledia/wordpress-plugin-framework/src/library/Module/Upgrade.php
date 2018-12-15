<?php

namespace Allex\Module;

use Allex\Container;

class Upgrade extends Abstract_Module
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $plugin_basename;

    /**
     * @var string
     */
    protected $plugin_name;

    /**
     * @var string
     */
    protected $plugin_title;

    /**
     * @var string
     */
    protected $subscription_ad_url;

    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * @var int
     */
    protected $subscription_discount = 20;

    /**
     * Upgrade constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->plugin_basename     = $this->container['PLUGIN_BASENAME'];
        $this->plugin_name         = $this->container['PLUGIN_NAME'];
        $this->plugin_title        = $this->container['PLUGIN_TITLE'];
        $this->subscription_ad_url = $this->container['SUBSCRIPTION_AD_URL'];
        $this->twig                = $this->container['twig'];
        $this->assets_base_url     = $this->container['ASSETS_BASE_URL'];
    }

    /**
     * Add an Upgrade link to the action links in the plugin list.
     *
     * @param string $addons_page_url
     */
    public function init($addons_page_url)
    {
        $this->url = $addons_page_url;

        $this->add_hooks();
    }

    /**
     * Add the hooks.
     */
    protected function add_hooks()
    {
        add_action('plugin_action_links_' . $this->plugin_basename, [$this, 'plugin_action_links'],
            999);
        add_action('allex_upgrade_sidebar_ad', [$this, 'render_sidebar_ad']);
        add_filter('allex_upgrade_show_sidebar_ad', [$this, 'filter_allex_upgrade_show_sidebar_ad'], 10, 2);
    }

    /**
     * @param array $links
     *
     * @return array
     */
    public function plugin_action_links($links)
    {
        $context = [
            'url'   => $this->url,
            'label' => __('Upgrade', 'allex'),
            'class' => $this->plugin_name,
        ];

        $link = $this->twig->render('action_link_upgrade.twig', $context);

        $links = array_merge($links, [$link]);

        return $links;
    }

    /**
     * Echo the sidebar with a form to subscribe for 20% discount.
     *
     * @param string $plugin_name
     */
    public function render_sidebar_ad($plugin_name = null)
    {
        /*
         * ---------------------------------------------------------------------
         * Backward compatibility for users using PublishPress and UpStream with
         * an older version of this library where the $plugin_name param is not
         * sent. We force its value, so the add-ons page keeps working until
         * they update the plugin.
         *
         * @todo: Remove this after a few releases
         *
         * @since 1.16.3
         */
        if (is_null($plugin_name)) {
            $plugin_name = $this->plugin_name;
        }
        /*
         * ---------------------------------------------------------------------
         */

        // If not related to this plugin, we skip it.
        if ($plugin_name !== $this->plugin_name) {
            return;
        }

        // @todo: The path have to be relative to plugin, not to the file. Having multiple plugins using this, only the same image will be used.
        $img_url = $this->assets_base_url . '/img/subscription-ad.jpg';

        /**
         * Get the mailchimp config for the plugin.
         *
         * @param array  $mailchimp_config
         * @param string $plugin_name
         *
         * @return array
         */
        $mailchimp_config = apply_filters('allex_upgrade_mailchimp_config', [], $this->plugin_name);

        echo $this->twig->render(
            'subscription_ad.twig',
            [
                'image_src'        => $img_url,
                'action_url'       => $this->subscription_ad_url,
                'mailchimp_config' => $mailchimp_config,
                'text'             => [
                    'title'         => sprintf(__('Get %d%% off the %s extensions', 'allex'),
                        $this->subscription_discount,
                        $this->plugin_title),
                    'thanks'        => sprintf(__('Thanks for using %1$s! Enter your details and we\'ll send you a coupon for %2$d%% off the %1$s extensions.',
                        'allex'), $this->plugin_title, $this->subscription_discount),
                    'email_address' => __('Email Address', 'allex'),
                    'first_name'    => __('First Name', 'allex'),
                    'last_name'     => __('Last Name', 'allex'),
                    'yes_send_me'   => __('Yes! Send me the coupon', 'allex'),
                ],
            ]
        );
    }

    /**
     * @param bool   $show_sidebar
     * @param string $plugin_name
     *
     * @return bool
     */
    public function filter_allex_upgrade_show_sidebar_ad($show_sidebar, $plugin_name = null)
    {
        if ((defined('DOING_AJAX') && DOING_AJAX)
            || (defined('DOING_CRON') && DOING_CRON)
            || ! is_admin()) {

            return false;
        }

        if ($plugin_name !== $this->plugin_name) {
            return $show_sidebar;
        }

        // Check if we have all add-ons installed. If so, we do not show the sidebar.
        $addons_installed = apply_filters('allex_installed_addons', [], $this->plugin_name);

        $show_sidebar = count($addons_installed) === 0;


        return $show_sidebar;
    }
}
