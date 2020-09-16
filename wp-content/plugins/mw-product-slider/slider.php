<?php
/**
 * Adds Product_slider widget.
 */
class Product_slider extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'product_slider', // Base ID
            'Product_slider', // Name
            array( 'description' => __( 'Simple Woocommerce product slider', 'text_domain' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        // 22,23,24,25,26,27,28,29,30,31,32,33,34,35 product_ids
//	    5508,5512,5514,5515,5516,5517,5518
        extract( $args );
        $button_text = $instance[ 'button_text' ];
        $product_ids = explode(',', $instance[ 'product_ids' ]);
        $product_content = "";

        echo $before_widget;

        if ( ! empty( $product_ids ) )
	        echo '<div class="swiper-container" id="cpsmw-container">
            <div class="swiper-wrapper">';

            // assuming the list of product IDs is are stored in an array called IDs;
            $_pf = new WC_Product_Factory();

            foreach ($product_ids as $key=>$id) {

                $_product = $_pf->get_product($id);
                $_prod_img = $_product->get_image();
                $_prod_title = $_product->get_title();
                $_prod_link = $_product->get_permalink();
                $_prod_description = $_product->get_short_description();
                $_is_first_slide = $key == 0 ? 'active' : '';

                // from here $_product will be a fully functional WC Product object,
                // you can use all functions as listed in their api
                echo "<div class='swiper-slide' data-content-id='content-$key'>$_prod_img</div>";

                // append to $product_content
                $product_content .= "<div id='content-$key' class='cpsmw-slide-content $_is_first_slide'>
                        <h2 class='prod-title'>$_prod_title</h2>
                        <div class='prod-description'><p>" . strip_tags($_prod_description) . " </p></div>
                        <div class='cta'><a href='$_prod_link' class='elementor-button-link elementor-button elementor-size-md prod-link'>
                        <span class='elementor-button-content-wrapper'>
						<span class='elementor-button-text'>$button_text</span></span>
                        </a></div>
                    </div>";
            }

            echo '</div></div>'; // swiper container + wrapper

            // echo product content
            echo "<div id='cpsmw-content'>$product_content</div>";
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['button_text'] = strip_tags( $new_instance['button_text'] );
        $instance['product_ids'] = strip_tags( $new_instance['product_ids'] );

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'button_text' ] ) ) {
            $button_text = $instance[ 'button_text' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'button_text' ); ?>">Button text</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $product_ids ); ?>" placeholder="Enter Slider title" />
        </p>
        <?php
        if ( isset( $instance[ 'product_ids' ] ) ) {
            $product_ids = $instance[ 'product_ids' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'product_ids' ); ?>">Product IDS</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'product_ids' ); ?>" name="<?php echo $this->get_field_name( 'product_ids' ); ?>" type="text" value="<?php echo esc_attr( $product_ids ); ?>" placeholder="seperated by comma" />
        </p>
        <?php
    }

} // class Product_slider

// Register the widget
function my_register_custom_widget() {
	register_widget( 'Product_slider' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );