<?php
/**
* The plugin bootstrap file
*
* This file is read by WordPress to generate the plugin information in the plugin
* admin area. This file also includes all of the dependencies used by the plugin,
* registers the activation and deactivation functions, and defines a function
* that starts the plugin.
*
* @link              https://mahade.dev
* @since             1.0.0
* @package           Custom_Products_Slider_Mw
*
* @wordpress-plugin
* Plugin Name:       mw-product-slider
* Plugin URI:        https://mahade.dev
* Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
* Version:           1.0.0
* Author:            Mahade Walid
* Author URI:        https://mahade.dev
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       custom-products-slider-mw
*/

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Add main widget class file
 */
require plugin_dir_path( __FILE__ ) . 'slider.php';

/**
 * add scripts and styles
 */
function mw_product_slider_styles() {
//	wp_enqueue_style( 'mw-product-slider-style', plugin_dir_url( __FILE__ ) . 'assets/swiper.min.css', array(), '1.0', 'all' );
	wp_enqueue_style( 'mw-product-slider-style-custom', plugin_dir_url( __FILE__ ) . 'assets/custom.css', array(), '1.0', 'all' );
}
function mw_product_slider_scritps() {
//	wp_enqueue_script( 'mw-product-slider-script', plugin_dir_url( __FILE__ ) . 'assets/swiper.min.js', array( 'jquery' ), '1.0', false );
//	wp_enqueue_script( 'mw-product-slider-script', 'https://unpkg.com/swiper/js/swiper.min.js', array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'mw-product-slider-script-custom', plugin_dir_url( __FILE__ ) . 'assets/custom.js', array( 'jquery' ), '1.0', true );
}
add_action( 'elementor/frontend/after_enqueue_styles', 'mw_product_slider_styles' );
add_action( 'admin_enqueue_scripts', 'mw_product_slider_styles' );
add_action( 'elementor/frontend/after_enqueue_scripts', 'mw_product_slider_scritps', 99 );
add_action( 'admin_enqueue_scripts', 'mw_product_slider_scritps', 99);

