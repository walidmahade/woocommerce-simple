<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );
// get product summary
// $order = wc_get_order( $order_id ); // optional (to test without it)
$product_summary = [];
foreach ($order->get_items() as $item_id => $item) {
    $product_summary[] = $item['name']; // product name
}
?>

<p>
	<?php printf( 
		__('Great News %s, your order for the <b>%s</b> has just been placed!', 'woocommerce'),
		esc_html( $order->get_billing_first_name() ),
		esc_html( wp_strip_all_tags(implode(',', $product_summary)) )
		) ?>
</p>

<div style="margin-bottom: 16px;font-size: 16px;">You will receive a shipment notification email as soon as we send your order. We may also send you additional updates regarding your order status.</div>  
<div style="margin-bottom: 16px;font-size: 16px;">If we may be of further assistance, please email <a href="mailto:support@goodwellness.ca" style="color:#697659;">support@goodwellness.ca</a> or call <a href="tel:613-617-7781" style="color:#697659;">613-617-7781</a>.</div>
<div style="margin-bottom: 16px;font-size: 16px;">
Sincerely,<br>
GoodWellness.ca Customer Service 
</div>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
