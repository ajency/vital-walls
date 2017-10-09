<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="clear"></div>
<div class="hb-separator"></div>
<div class="product_meta clearfix">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>
	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>

	<div class="bottom-meta-section hb-woo-meta">
	<?php if ( hb_options('hb_woo_enable_likes') ){ ?>
	<div class="float-right">	
		<?php echo hb_print_likes(get_the_ID()); ?>
	</div>
	<?php }
	?>

	<?php if (hb_options('hb_woo_enable_share')) { ?>
	<div class="float-right">
		<div class="hb-woo-like-share">
			<?php get_template_part ( 'includes/hb' , 'share' ); ?>
		</div>
	</div>
	<?php } ?>
	</div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>