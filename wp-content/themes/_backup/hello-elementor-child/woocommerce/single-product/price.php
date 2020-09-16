<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$id = $product->get_id();

$manufacture = get_field('manufacturer', $id);

$manufacture_name = $manufacture['manufacture_name'];
$manufacture_url = $manufacture['manufacture_url'];

$users_manual = get_field('users_manual', $id);
$users_manual_url = $users_manual['url'] ? $users_manual['url'] : "empty";
$users_manual_size = round(($users_manual['filesize'] / 1000000), 2);

//    $product_stock_status = $product->get_stock_status();

if (!empty($manufacture_url)) {
    $manufacture_name_checked = empty($manufacture_name) ?  'InBody ltd' : $manufacture_name;
    printf("
            <div class='woocommerce-loop-product__manufacturer'>
                <span class='cls'>Manufacturer: <a href='%s'>%s</a></span>
                <a class='user-manual' href='%s' target='_blank'>
                    <span class='icon'><svg width='20' height='16' viewBox='0 0 20 16' fill='none' xmlns='http://www.w3.org/2000/svg'> <path d='M10 12L14 7H11V0H9V7H6L10 12Z' fill='#9CAF86'/> <path d='M18 14H2V7H0V14C0 15.103 0.897 16 2 16H18C19.103 16 20 15.103 20 14V7H18V14Z' fill='#9CAF86'/> </svg></span>
                    <span class='text'>User's Manual (%sMB)</span>
                </a>
            </div>",
        $manufacture_url, $manufacture_name_checked, $users_manual_url, $users_manual_size
    );
}
?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
