<?php
/**
 * Cancelled Order sent to Customer.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<!-- <p><?php //printf( __( 'The order #%d has been cancelled. Order Details:', 'woocommerce' ), $order->get_order_number() ); ?></p> -->

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>

<p>
<?php printf(__( 'This is confirmation that your order #%d placed on %s from GoodWellness.ca has been cancelled.', 
'woocommerce' ), 
$order->get_order_number(), $order->get_date_created()->format ('Y-m-d'));
?>
</p>
<div style="margin-bottom: 16px;font-size: 16px;">If you do not want your order to be cancelled, or you have other questions please email <a href="mailto:support@goodwellness.ca" style="color:#697659;">support@goodwellness.ca</a> or call <a href="tel:613-617-7781" style="color:#697659;">613-617-7781</a>.</div>
<div style="margin-bottom: 16px;font-size: 16px;">
Sincerely,<br>
GoodWellness.ca Customer Service
</div>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );