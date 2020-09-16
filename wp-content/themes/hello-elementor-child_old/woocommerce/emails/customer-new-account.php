<?php
/**
 * Customer new account email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-new-account.php.
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

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer username */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $user_login ) ); ?></p>

<p>
Thank you for creating a new account at GoodWellness.ca, we are thrilled to have you! This account will keep you in the loop on the latest product news and will also make your future checkout process for much faster.
</p>

<?php /* translators: %1$s: Site title, %2$s: Username, %3$s: My account link */ ?>

<p><?php printf( esc_html__( 'Your username is %1$s.', 'woocommerce' ), '<strong>' . esc_html( $user_login ) . '</strong>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

<p><?php printf( esc_html__( 'Want to look over your account details or view orders, change your password, and more at: %1$s', 'woocommerce' ), make_clickable( esc_url( wc_get_page_permalink( 'myaccount' ) ) ) ); ?></p>

<?php if ( 'yes' === get_option( 'woocommerce_registration_generate_password' ) && $password_generated ) : ?>
	<?php /* translators: %s: Auto generated password */ ?>
	<p><?php printf( esc_html__( 'Your password has been automatically generated: %s', 'woocommerce' ), '<strong>' . esc_html( $user_pass ) . '</strong>' ); ?></p>
<?php endif; ?>

<p>
If we may be of further assistance, please email <a href="mailto:support@goodwellness.ca" style="color:#697659;">support@goodwellness.ca</a> or call <a href="tel:613-617-7781" style="color:#697659;">613-617-7781</a>.
</p>
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
