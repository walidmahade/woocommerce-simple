<?php
/**
 * Plugin Name: Custom WooCommerce Email
 * Description: On Cancelled order, send email to customer. Default behaviour is, woocommerce only notifies admin, when an order gets cancelled.
 * Author: Mahade Walid
 * Author URI: https://mahade.dev
 */

if ( ! defined( 'ABSPATH' ) ) {
    return;
}

/**
 * Class Custom_WC_Email
 */
class Custom_WC_Email {

    /**
     * Custom_WC_Email constructor.
     */
    public function __construct() {
        // Filtering the emails and adding our own email.
        add_filter( 'woocommerce_email_classes', array( $this, 'register_email' ), 90, 1 );
        // Absolute path to the plugin folder.
        define( 'CUSTOM_WC_EMAIL_PATH', plugin_dir_path( __FILE__ ) );
    }

    /**
     * @param array $emails
     *
     * @return array
     */
    public function register_email( $emails ) {
        require_once 'templates/emails/class-wc-customer-cancel-order.php';

        $emails['WC_Customer_Cancel_Order'] = new WC_Customer_Cancel_Order();

        return $emails;
    }
}

new Custom_WC_Email();