<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              catchplugins.com
 * @since             1.0.0
 * @package           Catch_Instagram_Feed_Gallery_Widget
 *
 * @wordpress-plugin
 * Plugin Name:       Catch Instagram Feed Gallery Widget
 * Plugin URI:        wordpress.org/plugins/catch-instagram-feed-gallery-widget
 * Description:       Catch Instagram Feed Gallery & Widget Plugin is a simple solution to display your Instagram feed directly onto your website either using a widget or shortcode. You can also show your Instagram feeds in a post or page as well.
 * Version:           1.6
 * Author:            Catch Plugins
 * Author URI:        catchplugins.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       catch-instagram-feed-gallery-widget
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// The URL of the directory that contains the plugin
if ( !defined( 'CIFGW_URL' ) ) {
	define( 'CIFGW_URL', plugin_dir_url( __FILE__ ) );
}


// The absolute path of the directory that contains the file
if ( !defined( 'CIFGW_PATH' ) ) {
	define( 'CIFGW_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-catch-instagram-feed-gallery-widget-activator.php
 */
function activate_catch_instagram_feed_gallery_widget() {
	$required = 'catch-instagram-feed-gallery-widget-pro/catch-instagram-feed-gallery-widget-pro.php';
	if ( is_plugin_active( $required ) ) {
		$message = esc_html__( 'Sorry, Pro plugin is already active. No need to activate Free version. %1$s&laquo; Return to Plugins%2$s.', 'catch-instagram-feed-gallery-widget' );
		$message = sprintf( $message, '<br><a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">', '</a>' );
		wp_die( $message );
	}
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-catch-instagram-feed-gallery-widget-activator.php';
	Catch_Instagram_Feed_Gallery_Widget_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-catch-instagram-feed-gallery-widget-deactivator.php
 */
function deactivate_catch_instagram_feed_gallery_widget() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-catch-instagram-feed-gallery-widget-deactivator.php';
	Catch_Instagram_Feed_Gallery_Widget_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_catch_instagram_feed_gallery_widget' );
register_deactivation_hook( __FILE__, 'deactivate_catch_instagram_feed_gallery_widget' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-catch-instagram-feed-gallery-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_catch_instagram_feed_gallery_widget() {
	$plugin = new Catch_Instagram_Feed_Gallery_Widget();
	$plugin->run();
}
run_catch_instagram_feed_gallery_widget();

/**
 * Returns the options array for Top options
 *
 *  @since    1.0.0
 */
function catch_instagram_feed_gallery_widget_get_options() {
	$defaults = catch_instagram_feed_gallery_widget_default_options();
	$options  = get_option( 'catch_instagram_feed_gallery_widget_options', $defaults );

	return wp_parse_args( $options, $defaults );
}

/**
 * Return array of default options
 *
 * @since     1.0.0
 * @return    array    default options.
 */
function catch_instagram_feed_gallery_widget_default_options( $option = null ) {
	$default_options = array(
		'username'     => '',
		'user_id'      => '',
		'access_token' => '',
	);

	if ( null == $option ) {
		return apply_filters( 'catch_instagram_feed_gallery_widget_options', $default_options );
	} else {
		return $default_options[ $option ];
	}
}

function catch_instagram_feed_gallery_widget_sanitize_number_range( $number ) {
	// Number range check. Max is 20.
	$number = absint( $number );
	return ( isset( $number ) && $number <= 30 ) ? $number : 6;
}

/**
 * Returns an array of image size registered for Catch Instagram Feed Gallery Widget.
 *
 * @since Catch Instagram Feed Gallery Widget 1.0.0
 */
function catch_instagram_feed_gallery_widget_image_size_option() {
	$options = array(
		'thumbnail'           => esc_html__( 'Thumbnail', 'catch-instagram-feed-gallery-widget' ),
		'low_resolution'      => esc_html__( 'Small', 'catch-instagram-feed-gallery-widget' ),
		'standard_resolution' => esc_html__( 'Large', 'catch-instagram-feed-gallery-widget' ),
	);

	return apply_filters( 'catch_instagram_feed_gallery_widget_image_size_option', $options );
}

function insta_blocks_loader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/instagram-block/index.php';
}
add_action( 'plugins_loaded', 'insta_blocks_loader' );

/* Adds Catch Themes tab in Add theme page and Themes by Catch Themes in Customizer's change theme option. */
require_once CIFGW_PATH . '/admin/partials/our-themes.php';

/* Adds Catch Plugins tab in Add theme page.  */
require_once CIFGW_PATH . '/admin/partials/our-plugins.php';