<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_demo_product = get_theme_mod('cd_button_display', 'show');

$product_demo_image_id = get_theme_mod('product_demo_image');
$demo_img_url = wp_get_attachment_image_src($product_demo_image_id, 'large');

$product_watermark_id = get_theme_mod('cd_button_watermark');
$watermark_img_url = wp_get_attachment_image_src($product_watermark_id, 'large');

if ($show_demo_product === 'show') {
    echo '<li class="product product--demo">
        <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
        <div class="woocommerce-loop-product__img__wrap">
            <img width="350" height="350" src="'. $demo_img_url[0] .'" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" >
            <img height="auto" width="61px" src="' . $watermark_img_url[0].'" alt="product watermark" class="watermark__img">
        </div>
        <h2 class="woocommerce-loop-product__title" style="margin-bottom: 0 !important;">Coming Soon!</h2>
        </a>
    </li>';
}
?>
</ul>
