<?php
/**
 * Email Header
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-header.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php echo get_bloginfo( 'name', 'display' ); ?></title>
		<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
		<style>
			* {
				font-family: 'Poppins', sans-serif;
			}
			p {
				font-size: 16px;
				line-height: 24px;
			}
			h1, h2, h3 {
				font-family: 'Bodoni MT', sans-serif;
			}
		</style>
	</head>
	<body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		<div id="wrapper" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
				<tr>
					<td align="center" valign="bottom">
						<!-- <div id="template_header_image"> -->
							<?php
							// if ( $img = get_option( 'woocommerce_email_header_image' ) ) {
								//echo '<p style="margin:0;">' . the_custom_logo() . '</p>';
							// }
							?>  
						<!-- </div> -->
						<table border="0" cellpadding="0" cellspacing="0" width="612" id="template_container">
							<tr>
								<td align="center" valign="top"> 
									<!-- Brand -->
									<div class="brand" style="text-align: left;margin: 32px auto 7px 63px;max-width: 91px;">
										<?php echo the_custom_logo(); ?>
									</div>
									<!-- END Brand -->
									<!-- Header -->
									<?php if($email_id == 'new_order' || $email_id == 'cancelled_order' || $email_id == 'failed_order'): ?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
									<?php else : ?>
										<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header" class="has_bg">
									<?php endif ?>
										<tr>
											<td id="header_wrapper">
												<?php 
												if ($email_heading) {
													printf('<h1 style="font-size: 43.5px;">%s</h1>', $email_heading);
												} else {
													echo '<h1 style="font-size: 43.5px;">THANK YOU</h1>
													<p style="font-size: 16.5px; margin:0;font-weight: 400;color: #434343;">for shopping at <a href="https://goodwellness.ca/" target="_blank" style="text-decoration: none;">GoodWellness.ca</a></p>';
												}
												?>
											</td>
										</tr>
									</table>
									<!-- End Header -->
								</td>
							</tr>
							<tr>
								<td align="center" valign="top">
									<!-- Body -->
									<table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body">
										<tr>
											<td valign="top" id="body_content">
												<!-- Content -->
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tr>
														<td valign="top">
															<div id="body_content_inner">
