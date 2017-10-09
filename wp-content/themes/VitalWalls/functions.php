<?php

function highend_child_theme_enqueue_styles() {

    $parent_style = 'highend-parent-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'highend-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}

// add_action( 'wp_enqueue_scripts', 'highend_child_theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'highend_parent_theme_enqueue_styles' );
add_action('wp_enqueue_scripts', 'theme_js');
function highend_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css');
}
function theme_js() {
    $current_user=wp_get_current_user();

    wp_enqueue_script( 'scroll', get_stylesheet_directory_uri() . '/jquery.easeScroll.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'readmore', get_stylesheet_directory_uri() . '/readmore.min.js', array( 'jquery' ), '1.0', true );
    // wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ), '1.0', true );
    wp_register_script( 'theme_js', get_stylesheet_directory_uri() . '/custom.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'theme_js', 'users', array( 'email' =>  $current_user->user_email));
    wp_enqueue_script( 'theme_js' );

}

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'left menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );


function wpb_custom_new_menuu() {
  register_nav_menu('my-custom-menuu',__( 'right menu' ));
}
add_action( 'init', 'wpb_custom_new_menuu' );



//* Make Font Awesome available
add_action( 'wp_enqueue_scripts', 'enqueue_font_awesome' );
function enqueue_font_awesome() {

    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );

}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 *
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */

// add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
// function sk_wcmenucart($menu, $args) {

//     // Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
//     if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'my-custom-menuu' !== $args->theme_location || !is_user_logged_in())
//         return $menu;

//         ob_start();
//         global $woocommerce;
//         $viewing_cart = __('View your shopping cart', 'your-theme-slug');
//         $start_shopping = __('Start shopping', 'your-theme-slug');
//         $cart_url = $woocommerce->cart->get_cart_url();
//         $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
//         $cart_contents_count = $woocommerce->cart->cart_contents_count;
//         $cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
//         $cart_total = $woocommerce->cart->get_cart_total();
//         // Uncomment the line below to hide nav menu cart item when there are no items in the cart
//         // if ( $cart_contents_count > 0 ) {
//             if ($cart_contents_count == 0) {
//                 $menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
//             } else {
//                 $menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
//             }

//             $menu_item .= '<i class="fa fa-shopping-cart"></i> ';

//             // $menu_item .= $cart_contents.' - '. $cart_total;
//             $menu_item .= $cart_contents;
//             $menu_item .= '</a></li>';
//         // Uncomment the line below to hide nav menu cart item when there are no items in the cart
//         // }
//         echo $menu_item;
//     $social = ob_get_clean();
//     return $menu . $social;

// }


/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function my_header_add_to_cart_fragment( $fragments ) {

    ob_start();
    $count = WC()->cart->cart_contents_count;
     // if ($count == 0) {
     //    $r_page_url = filter_woocommerce_return_to_shop_redirect($parameter);
     // }
     // else{
     //      $r_page_url =  WC()->cart->get_cart_url();
     // }
    $r_page_url =  WC()->cart->get_cart_url();
    ?>
    <a class="wcmenucart-contents" href="<?php echo $r_page_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">

    <?php

       $menu_item="";

   // if ( $count > 0 ) {

        $cart_contents = sprintf(_n('%d item', '%d items', $count, 'indigo-wine'), $count);
        $menu_item .= '<i class="fa fa-shopping-cart"></i> ';

        $menu_item .= $cart_contents;

        echo $menu_item;
    //}
        ?></a><?php

    $fragments['a.wcmenucart-contents'] = ob_get_clean();

    return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );


add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);
function sk_wcmenucart($menu, $args) {

    // Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
    if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'my-custom-menuu' !== $args->theme_location || !is_user_logged_in())
        return $menu;

        ob_start();
        global $woocommerce;
        $viewing_cart = __('View your shopping cart', 'your-theme-slug');
        $start_shopping = __('Start shopping', 'your-theme-slug');
        $cart_url = $woocommerce->cart->get_cart_url();
        // $shop_page_url = filter_woocommerce_return_to_shop_redirect($parameter);
        $cart_contents_count = $woocommerce->cart->cart_contents_count;
        //if($cart_contents_count>0){
            $cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'indigo-wine'), $cart_contents_count);
            $cart_total = $woocommerce->cart->get_cart_total();
            // Uncomment the line below to hide nav menu cart item when there are no items in the cart
            // if ( $cart_contents_count > 0 ) {
                if ($cart_contents_count == 0) {
                    $menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $start_shopping .'">';
                } else {
                    $menu_item = '<li class="right"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';
                }

                $menu_item .= '<i class="fa fa-shopping-cart"></i> ';

                // $menu_item .= $cart_contents.' - '. $cart_total;
                $menu_item .= $cart_contents;
                $menu_item .= '</a></li>';
            // Uncomment the line below to hide nav menu cart item when there are no items in the cart
            // }
            echo $menu_item;
       // }
    $social = ob_get_clean();
    return $menu . $social;

}




//Enqueue Ajax Scripts
function enqueue_cart_qty_ajax() {
    wp_register_script( 'cart-qty-ajax-js', get_template_directory_uri() . '/subscription/js/cart-qty-ajax.js', array( 'jquery' ), '', true );
    wp_localize_script( 'cart-qty-ajax-js', 'cart_qty_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ,'siteapiurl' => get_option('siteurl').'/wp-json/wp/v2/','homeurl' => home_url() ));
    wp_enqueue_script( 'cart-qty-ajax-js' );

}
// add_action('wp_enqueue_scripts', 'enqueue_cart_qty_ajax');

function ajax_qty_cart() {

    // Set item key as the hash found in input.qty's name
    $cart_item_key = $_POST['hash'];

    // Get the array of values owned by the product we're updating
    $threeball_product_values = WC()->cart->get_cart_item( $cart_item_key );

    // Get the quantity of the item in the cart
    $threeball_product_quantity = apply_filters( 'woocommerce_stock_amount_cart_item', apply_filters( 'woocommerce_stock_amount', preg_replace( "/[^0-9\.]/", '', filter_var($_POST['quantity'], FILTER_SANITIZE_NUMBER_INT)) ), $cart_item_key );

    // Update cart validation
    $passed_validation  = apply_filters( 'woocommerce_update_cart_validation', true, $cart_item_key, $threeball_product_values, $threeball_product_quantity );




    if(isset($_POST['subscription']))
    {

        $term_list = wp_get_post_terms($threeball_product_values['product_id'],'product_cat',array('fields'=>'ids'));

        $category_object = get_term_by('slug', 'wine', 'product_cat');

        $categories=get_term_children( $category_object->term_id, 'product_cat' );
        array_push($categories, $category_object->term_id);


        $totals = array_intersect($categories, $term_list);

        // if(in_array('wine', $term_list) )
        if(count($totals) > 0 )
        {
            if ( $passed_validation ) {
                WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
            }
        }

        $_SESSION['subscription_type'] = $_POST['subscription'];

    }
    else{
          // Update the quantity of the item in the cart
        if ( $passed_validation ) {
            WC()->cart->set_quantity( $cart_item_key, $threeball_product_quantity, true );
        }

    }

    echo do_shortcode( '[woocommerce_cart]' );
    die();

}

add_action('wp_ajax_qty_cart', 'ajax_qty_cart');
add_action('wp_ajax_nopriv_qty_cart', 'ajax_qty_cart');

add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 3 related products
	$args['columns'] = 3; // arranged in 3 columns
	return $args;
}


// add_filter( 'woocommerce_get_price_html', 'custom_price_html', 100, 2 );
// function custom_price_html( $price, $product ){
//     return $price;
// }













