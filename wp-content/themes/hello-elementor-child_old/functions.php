<?php
/**
 * Theme functions and definitions
 *
 * @package HelloElementorChild
 */

/**
 * Load child theme css and optional scripts
 *
 * @return void
 * -------- this adds the child theme stylesheet before parent theme stylesheet
 */

function hello_elementor_child_enqueue_scripts() {
    wp_enqueue_style(
        'hello-elementor-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        [
            'hello-elementor-theme-style',
        ],
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_scripts', 99 );

/**
 * ADD customizer options
 */
function gwn_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'cd_button' , array(
        'title'      => 'GWN Custom Settings',
        'priority'   => 20,
    ));

    // START setting -> show demo product
    $wp_customize->add_setting( 'cd_button_display' , array(
        'default'     => true,
        'transport'   => 'refresh',
    ));

    $wp_customize->add_control( 'cd_button_display', array(
        'label' => 'Show demo product?',
        'section' => 'cd_button',
        'settings' => 'cd_button_display',
        'type' => 'radio',
        'choices' => array(
            'show' => 'Show',
            'hide' => 'Hide',
        ),
    ));
    // END setting -> show demo product
    // START demo - product image
    $wp_customize->add_setting( 'product_demo_image' , array(
        'default'     => true,
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control(
        $wp_customize, 'image_control_2', array(
            'label' => __( 'Product Demo Image' ),
            'section' => 'cd_button',
            'mime_type' => 'image',
            'settings'  => 'product_demo_image'
        )
    ));
    // END demo - product image
    // START watermark image
    $wp_customize->add_setting( 'cd_button_watermark' , array(
        'default'     => true,
        'transport'   => 'refresh',
    ));
    $wp_customize->add_control( new WP_Customize_Media_Control(
        $wp_customize, 'image_control', array(
            'label' => __( 'Product Watermark Image' ),
            'section' => 'cd_button',
            'mime_type' => 'image',
            'settings'  => 'cd_button_watermark'
        )
    ));
    // END watermark image
}
add_action( 'customize_register', 'gwn_customize_register' );

/**
 * Woo-commerce product loop customization
 */
add_action( 'woocommerce_after_shop_loop_item_title', 'mw_show_subtitle_after_prod_title', 5 );

function mw_show_subtitle_after_prod_title() {
    global $product;
    $id = $product->get_id();
//    $slug = $product->get_slug();
    $prod_subtitile = get_field('product_subtitle', $id);
    $manufacture = get_field('manufacturer', $id);
    $manufacture_name = $manufacture['manufacture_name'];
    $manufacture_url = $manufacture['manufacture_url'];
    $product_custom_color = get_field('shop_page_color', $id);
    $prod_attrs = $product->get_attribute( 'pa_color' );

    echo "<div class='custom-woo-data'>";
    // echo "slug: " . $slug;

    if (!empty($prod_subtitile)) {
        printf("<div class='woocommerce-loop-product__subtitle'>%s</div>", $prod_subtitile);
    }
    if (!empty($manufacture_url)) {
        $manufacture_name_checked = empty($manufacture_name) ?  'InBody ltd' : $manufacture_name;
        printf(
            "<div class='woocommerce-loop-product__manufacturer'><span class='cls'>Manufacturer: <a href='%s'>%s</a></span></div>",
            $manufacture_url, $manufacture_name_checked
        );
    }
    if (!empty($product_custom_color)) {
        printf("<div class='woocommerce-loop-product__color'>Color: %s</div>", $product_custom_color);
    } else if (!empty($prod_attrs)) {
        printf("<div class='woocommerce-loop-product__color'>Color: %s</div>", $prod_attrs);
    }
    echo "</div>";
}
/**
 * Remove rating from archive page
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    $defaults['delimiter'] = '<span class="seperator"><svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.03564 13.071L12.0712 7.03552L6.03564 0.999985" stroke="#434343"/>
        </svg></span>';
    return $defaults;
}

/**
 * Add wrapper around product thumbnail
 */
add_action('woocommerce_before_shop_loop_item_title', 'gwn_add_wrapper_before_product_thumabnail', 5);
function gwn_add_wrapper_before_product_thumabnail () {
    echo "<div class='woocommerce-loop-product__img__wrap'>";
}
add_action('woocommerce_shop_loop_item_title', 'gwn_add_wrapper_after_product_thumabnail', 5);
function gwn_add_wrapper_after_product_thumabnail () {
    $product_watermark_id = get_theme_mod('cd_button_watermark');
    $watermark_img_url = wp_get_attachment_image_src($product_watermark_id, 'large');
    echo "<img height='auto' width='61px' src='$watermark_img_url[0]' alt='product watermark' class='watermark__img'>";
    echo "</div>";
}


/**
 * Remove product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'gwn_woo_remove_product_tabs', 98 );

function gwn_woo_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}

/**
 * Rename product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'gwn_woo_rename_tabs', 98 );
function gwn_woo_rename_tabs( $tabs ) {
    $tabs['description']['title'] = __( 'Overview' );		// Rename the description tab
    $tabs['reviews']['title'] = __( 'Ratings & Reviews' );				// Rename the reviews tab

    // $tabs['description']['callback'] = 'woo_custom_description_tab_content';	// Custom description callback

    $tabs['technical_specs'] = array(
        'title' 	=> __( 'Technical Specs', 'woocommerce' ),
        'priority' 	=> 10,
        'callback' 	=> 'gwn_technical_specs_tab_content'
    );

    $tabs['inthebox'] = array(
        'title' 	=> __( 'In the Box', 'woocommerce' ),
        'priority' 	=> 15,
        'callback' 	=> 'gwn_inthebox_tab_content'
    );

    $tabs['about_the_brand'] = array(
        'title' 	=> __( 'About the Brand', 'woocommerce' ),
        'priority' 	=> 25,
        'callback' 	=> 'gwn_about_the_brand_tab_content'
    );

    return $tabs;
}

//function woo_custom_description_tab_content() {
//    global $product;
//    echo ( $product->get_description());
//}
/**
 * Add TECHNICAL_SPECS product data tab
 */
function gwn_technical_specs_tab_content() {
    global $product;
    $content = get_field('custom_product_tabs', $product->get_id());
    echo "{$content['technical_specs']}";
}
/**
 * Add TECHNICAL_SPECS product data tab
 */
function gwn_inthebox_tab_content() {
    global $product;
    $content = get_field('custom_product_tabs', $product->get_id());
    echo "{$content['inthebox']}";
}

/**
 * Add TECHNICAL_SPECS product data tab
 */
function gwn_about_the_brand_tab_content() {
    global $product;
    $content = get_field('custom_product_tabs', $product->get_id());
    echo "{$content['about_the_brand']}";
}
/**
 * Reorder product data tabs
 */
add_filter( 'woocommerce_product_tabs', 'gwn_woo_reorder_tabs', 98 );
function gwn_woo_reorder_tabs( $tabs ) {
    $tabs['reviews']['priority'] = 20;			// Reviews first
    $tabs['description']['priority'] = 5;		// Description second
    return $tabs;
}

/**
 * Filer WooCommerce Flexslider options - Add Navigation Arrows
 */
function wpb_hook_javascript_footer() {
    if (is_front_page()) {
        ?>
        
        <script>
            let widthOutput = window.innerWidth;
            let discoverBtn = document.getElementById('discover-btn')

            // function reportWindowSize() {
            //     widthOutput = window.innerWidth;
            // }

            // window.onresize = reportWindowSize;

            window.addEventListener('scroll', function() {
                let scrolTOP = window.scrollY
                console.log(scrolTOP)
                console.log(widthOutput)

                if (scrolTOP > 700 && widthOutput <= 768) {
                    discoverBtn.classList.add("mobile-sticky")
                } else {
                    discoverBtn.classList.remove("mobile-sticky")
                }
            })
        </script>
    <?php
    }
    if ( is_product() ) {
    ?>
        <script src="<?php echo get_stylesheet_directory_uri() . '/assets/siema.min.js' ?>"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function(){
                let parent = document.querySelector('.woocommerce-product-gallery')
                let rightArrow = document.createElement("div")
                rightArrow.classList.add("thumbnav")
                rightArrow.classList.add("thumbnav--right")
                let leftArrow = document.createElement("div")
                leftArrow.classList.add("thumbnav")
                leftArrow.classList.add("thumbnav--left")
                parent.append(leftArrow)
                parent.append(rightArrow)

                if(document.getElementsByClassName('flex-control-nav').length) {
                    const wooProdThumbSlider = new Siema({
                        selector: '.flex-control-nav',
                        duration: 200,
                        easing: 'ease-out',
                        perPage: 3,
                        startIndex: 0,
                        draggable: false,
                        multipleDrag: false,
                        loop: false,
                        rtl: false,
                        onInit: () => {},
                        onChange: () => {},
                    });
                    rightArrow.addEventListener('click', function () {
                        wooProdThumbSlider.next()
                    })
                    leftArrow.addEventListener('click', function () {
                        wooProdThumbSlider.prev()
                    })
                }

                let commentAuthor = document.getElementById('author')
                let commentEmail = document.getElementById('email')
                if (commentAuthor) {
                    commentAuthor.setAttribute('placeholder', 'Name')
                    commentEmail.setAttribute('placeholder', 'Email')
                }
            });
        </script>
    <?php
    } // if product

    // quantity increment and decrement
    ?>
    <script type="text/javascript">
        let decrementBtn = document.getElementsByClassName('decrement-qty')
        let incrementBtn = document.getElementsByClassName('increment-qty')
        let updateBtn = document.querySelector('.actions .button[name="update_cart"]')

        let enableUpdateBtn = function () {
            updateBtn.setAttribute("aria-disabled", true)
            updateBtn.removeAttribute("disabled")
        }

        if(decrementBtn && decrementBtn.length) {
            let do_action_decrement = function (e) {
                e.preventDefault()
                let targetElem = this.nextElementSibling
                let currentQty = parseInt(targetElem.value)
                if (currentQty !== 1)
                    this.nextElementSibling.value = currentQty - 1
                    enableUpdateBtn()
            }

            let do_action_increment = function (e) {
                e.preventDefault()
                let targetElem = this.previousElementSibling
                let currentQty = parseInt(targetElem.value)
                this.previousElementSibling.value = currentQty + 1
                enableUpdateBtn()
            }

            for (let i = 0; i < decrementBtn.length; i++) {
                decrementBtn[i].addEventListener('click', do_action_decrement, false);
            }

            for (let i = 0; i < incrementBtn.length; i++) {
                incrementBtn[i].addEventListener('click', do_action_increment, false);
            }
        }
    </script>
    <?php
}
add_action('wp_footer', 'wpb_hook_javascript_footer', 999);

/**
 * Woocommerce - allow empty ratings
 */
function gwn_preprocess_comment($comment_data) {
    if ($comment_data['comment_content'] == '%dummy-text%') {
        $comment_data['comment_content'] = ''; // replace dummy text.
    }
    return $comment_data;
}
add_filter('preprocess_comment', 'gwn_preprocess_comment');
function gwn_wp_footer() {
    ?>
    <script>
    jQuery(function($){
        var comment = $('textarea#comment');
        comment.removeAttr('required'); // remove required attribute of textarea.
        $('#commentform').on('submit',function(){
            if (comment.val() == '') {
                comment.css('text-indent','-9999px').val('%dummy-text%'); // change to dummy text.
            }
        });
    });
    </script>
    <?php
}
add_action( 'wp_footer', 'gwn_wp_footer' );

/**
 * Woocommerce show buy now for variable products as well
 */

function filter_woocommerce_loop_add_to_cart_link( $args, $product ) {

    if ( is_shop() || is_product_taxonomy() ) {
        $product_id = $product->get_id();
        $product_sku = $product->get_sku();
        $product_url = $product->add_to_cart_url();
        $quantity = isset( $args['quantity'] ) ? $args['quantity'] : 1;
        $text = "Buy Now";

        $children_ids = $product->get_children();
        
        if (!empty($children_ids)) {

            $children_id = $children_ids[0];
            $variation = wc_get_product($children_id);
            $x = $variation->get_attributes();
            // echo "<pre>";
            // var_dump($x);
            // echo "</pre>";
            // $product_url .= "?attribute_". $x->array_key_first()  ."=". reset($x);
            foreach(array_slice($x, 0, 1, true) as $key => $value) {
                $product_url .= "?attribute_". $key  ."=". $value;
            };
            $args = '<a rel="nofollow" href="' . $product_url . '" data-quantity="' . $quantity . '" data-product_id="' . $children_id . '" data-product_sku="' . $product_sku . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" aria-label="Add to cart">' . $text . '</a>';
        } else {
            $args = '<a rel="nofollow" href="' . $product_url . '" data-quantity="' . $quantity . '" data-product_id="' . $product_id . '" data-product_sku="' . $product_sku . '" class="button product_type_simple add_to_cart_button ajax_add_to_cart add-to-cart" aria-label="Add to cart">' . $text . '</a>';
        }
    }

    return $args;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'filter_woocommerce_loop_add_to_cart_link', 10, 2 );

/**
 * Woocommerce registration
 * ADD Password confirm field
 */
function woocommerce_registration_errors_validation($reg_errors, $sanitized_user_login, $user_email) {
    global $woocommerce;
    extract( $_POST );
    if ( strcmp( $password, $password2 ) !== 0 ) {
        return new WP_Error( 'registration-error', __( 'Passwords do not match.', 'woocommerce' ) );
    }
    return $reg_errors;
}
add_filter('woocommerce_registration_errors', 'woocommerce_registration_errors_validation', 10, 3);

function woocommerce_register_form_password_repeat() {
    ?>
    <p class="form-row form-row-wide">
        <label for="reg_password2"><?php _e( 'Confirm password', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
    </p>
    <?php
}
add_action( 'woocommerce_register_form', 'woocommerce_register_form_password_repeat' );

/**
* Woo-commerce account page, remove daashboard
*/
add_filter( 'woocommerce_account_menu_items', 'gwn_remove_my_account_dashboard' );
function gwn_remove_my_account_dashboard( $menu_links ){
    $menu_links = array(
        'edit-account'       => __( 'Account Details', 'woocommerce' ),
        'orders'             => __( 'Orders', 'woocommerce' ),
        // 'downloads'          => __( 'Downloads', 'woocommerce' ),
        'edit-address'       => __( 'Edit Addresses', 'woocommerce' ),
        'payment-methods'    => __( 'Payment Methods', 'woocommerce' ),
        'customer-logout'    => __( 'Logout', 'woocommerce' ),
    );
    unset( $menu_links['dashboard'] );
    return $menu_links;
}
// when dashboard page is requested, goto account details
add_action('template_redirect', 'gwn_redirect_to_orders_from_dashboard' );
function gwn_redirect_to_orders_from_dashboard(){
    if( is_account_page() && empty( WC()->query->get_current_endpoint() ) ){
        wp_safe_redirect( wc_get_account_endpoint_url( 'edit-account' ) );
        exit;
    }
}

// change woocommerce thumbnail image size
add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'override_woocommerce_image_size_gallery_thumbnail' );
function override_woocommerce_image_size_gallery_thumbnail( $size ) {
    // Gallery thumbnails: proportional, max width 200px
    return array(
        'width'  => 'auto',
        'height' => 'auto',
        'crop'   => 0,
    );
}

// Change shop page title
//add_filter( 'get_the_archive_title', function ( $title ) {
//    if (is_post_type_archive()) {
//        $title = post_type_archive_title( "Shop Our Tech Wellness Products ", false );
//    }
//    return $title;
//}, 10);

/**
 * Remove default email header
 */
// function so_27400044_remove_email_header(){
//     remove_action( 'woocommerce_email_header', array( WC()->mailer(), 'email_header' ) );
// }
// add_action( 'init', 'so_27400044_remove_email_header' );
// replace default WC header action with a custom one
add_action( 'init', 'ml_replace_email_header_hook' );    
function ml_replace_email_header_hook(){
    remove_action( 'woocommerce_email_header', array( WC()->mailer(), 'email_header' ) );
    add_action( 'woocommerce_email_header', 'ml_woocommerce_email_header', 10, 2 );
}

// new function that will switch template based on email type
function ml_woocommerce_email_header( $email_heading, $email ) {
    //var_dump($email->id); die;// see what variables you have, $email->id contains type
    $template = 'emails/email-header.php';
    wc_get_template( $template, array( 'email_heading' => $email_heading, 'email_id' => $email->id ) );
}