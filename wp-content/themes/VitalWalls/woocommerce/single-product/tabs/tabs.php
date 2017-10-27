<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		<ul class="tabs wc-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab">
					<a href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>

<div class="art-info">
	<div class="art-details">
		<h3>
			Product Key Features
		</h3>
		<ul>
			<li>Material: Canvas</li>
			<li>Color: Multi-Color</li>
			<li>Finish: Colorfast Ink on Canvas</li>
			<li>Wipeable &amp; Dustable, Easy to maintain </li>
			<li>Package Contents: 1 Digital Art Print on Premium Canvas</li>
			<li>Painting Available with Frame and Without Frame</li>
			<li>Frame as per buyer choice </li>
			<li>Frame Material: Pure Wooden and PVC </li>
		</ul>
	</div>

	<div class="frame-types">

    	<div class="type-wrapper">
    		<div class="type-info desc">
				<h3 class="text-left">
					Product Description
				</h3>
    			<p>
					Premium Canvas Art Print, Ready to Frame. This Art Print is a Best Seller. This Painting is a exquisite Painting
					by the Famous Artist. The canvas print is sure to add beauty and aesthetics to your space. This Art print
					offers beautiful color accuracy on a high-quality canvas that is ready for framing. Giclée (French for “to
					spray”) is a printing process where millions of ink droplets are sprayed onto the canvas surface creating
					natural color transitions
				</p>
    		</div>

    		<div class="type-image desc">
    			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(  ), 'single-post-thumbnail' );?>
	    		<img src="<?php  echo $image[0]; ?>">
    		</div>
    	</div>
	</div>

	<div class="frame-sizes">
		<h3>
			Frame Size Guide
		</h3>
		<p>
			Refer to the below image to understand the difference in canvas sizes.
		</p>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/frame-size-guide.jpg">
	</div>

	<div class="frame-types">
		<h3>
			Frame Types
		</h3>
		<div class="type-wrapper">
			<div class="type-image frame-1"></div>
			<div class="type-info">
				<h5>Wooden Frame</h5>
				<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
				</p>
			</div>
		</div>
		<div class="type-wrapper">
			<div class="type-info text-right">
				<h5>PVC Frame</h5>
				<p>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
				</p>
			</div>
			<div class="type-image frame-2"></div>
		</div>

		<div class="back-wrapper">
			<div class="back-text">
				<h6>But what about the back?</h6>
				<p>Here's a sample view of the backside of a painting with a frame so you know what to expect. </p>
			</div>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/frame_back.jpg">
		</div>
	</div>

	<div class="art-desc">
		<h3>
			Return Policy
		</h3>
		<p>
			Seller will accept returns within 7 days from date of delivery of the item only in case of damaged, defective, wrong products and in wrong size received.
		</p>
	</div>

	<div class="art-desc">
		<h3>
			Important Note
		</h3>
		<p>
			The images represent actual product though color of the image and product may slightly differ.
		</p>
	</div>

	<!-- <ul class="benefits">
		<li class="free_delivery">
			<div class="element">
				<div class="fa fa-truck"></div>
				<div class="content">
					Free Home Delivery
				</div>
				<div class="separator"></div>
				<div class="msg">
					<div>
						Whatever you order, our products ship free. Always.
					</div>
				</div>
			</div>
		</li>
		<li class="returns">
			<div class="element">
				<div class="fa fa-retweet"></div>
				<div class="content">
					On-The-Spot Returns
				</div>
				<div class="separator"></div>
				<div class="msg">
					<div>
						Didn't like it? No problem. Return it on the spot at the time of delivery.
					</div>
				</div>
			</div>
		</li>
		<li class="cod">
			<div class="element">
				<div class="fa fa-money"></div>
				<div class="content">
					C.O.D
				</div>
				<div class="separator"></div>
				<div class="msg">
					<div>
						You can pay by Cash or Card at the time of delivery.
					</div>
				</div>
			</div>
		</li>
		<li class="emi">
			<div class="element">
				<div class="fa fa-inr"></div>
				<div class="content">
					Easy Finance
				</div>
				<div class="separator"></div>
				<div class="msg">
					<div>
						Pay via EMIs on credit cards or avail interest-free loans.
					</div>
				</div>
			</div>
		</li>
	</ul> -->

</div>
