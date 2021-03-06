<?php

use Allex\Core;

class Container extends \Pimple\Container
{
    /**
     * Instance of the Pimple container
     */
    protected static $instance;

    public static function get_instance()
    {
        if (empty(static::$instance)) {
            $instance = new self;

            // Define the services
            $instance['PLUGIN_BASENAME'] = function ($c) {
                return plugin_basename('upstream/upstream.php');
            };

            $instance['EDD_API_URL'] = function ($c) {
                return 'https://upstreamplugin.com';
            };

            $instance['PLUGIN_AUTHOR'] = function ($c) {
                return 'UpStream';
            };

            $instance['SUBSCRIPTION_AD_URL'] = function ($c) {
                return 'https://upstreamplugin.us4.list-manage.com/subscribe/post?u=a42978bc16dd60d0ce3cac4d4&amp;id=83b571c8f0';
            };

            $instance['UPDATES_DOC_URL'] = function ($c) {
                //@todo: Update this link adding an specific page for this subject.
                return 'http://upstreamplugin.com/docs/';
            };

            $instance['framework'] = function ($c) {
                return new Core($c['PLUGIN_BASENAME'], $c['EDD_API_URL'], $c['PLUGIN_AUTHOR'],
                    $c['SUBSCRIPTION_AD_URL'], $c['UPDATES_DOC_URL']);
            };

            if (is_admin()) {
                $instance['reviews'] = function ($c) {
                    return new UpStream_Admin_Reviews();
                };
            }

            static::$instance = $instance;
        }

        return static::$instance;
    }
}
