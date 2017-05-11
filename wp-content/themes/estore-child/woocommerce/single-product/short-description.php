<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

$current_language = pll_current_language();
if ($current_language == 'en') {
    $title_short_description_custom_trans = get_field('title_short_description_custom_trans_en', 'option');
}
else {
    $title_short_description_custom_trans = get_field('title_short_description_custom_trans', 'option');
}
?>
<div class="woocommerce-product-details__short-description">
    <h6 class="title-short-description-custom"><?php echo $title_short_description_custom_trans; ?>: </h6>
    <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
</div>
